<?php

namespace App\Http\Controllers\Auth;

use App\Enums\BillingCycle;
use App\Enums\NotificationType;
use App\Enums\UserStatus;
use App\Enums\UserSubscriptionStatus;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\NotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserSubscription;
use App\Services\SubscriptionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class RegisterController extends Controller
{

    protected EmailService $emailService;
    protected NotificationService $notificationService;
    protected MessageService $messageService;
    protected Agent $agent;
    protected $subscriptionService;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->agent = new Agent();
        $this->emailService = new EmailService();
        $this->messageService = new MessageService($this->agent);
        $this->subscriptionService = new SubscriptionService();
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {

            $user = User::create(array_merge(
                $request->only(['email', 'name', 'password']),
                [
                    'status' => config('app.status') === 'waitlist'
                        ? UserStatus::WAITLIST
                        : UserStatus::ACTIVE,
                ]
            ));

            $plan = Plan::where('price', null)->where('billing_cycle', BillingCycle::YEARLY)->first();

            UserSubscription::create([
                'plan_id' => $plan->id,
                'user_id' => $user->id,
                'billing_cycle' => BillingCycle::YEARLY,
                'purchased_at' => now(),
                'expires_at' => now()->addDays(BillingCycle::YEARLY->durationInDays()),
                'status' => UserSubscriptionStatus::ACTIVE,
                'processor_subscription_code' => null,
                'processor_email_token' => null,
            ]);

            Auth::login($user);
        } catch (\Throwable $th) {
            Log::error($th);
            alert('error', 'An error occurred while signing you up, try again soon');
            return back()->withInput();
        }



        try {
            $this->notificationService->sendToUser(
                NotificationType::SIGNUP,
                Auth::user(),
                'Welcome to ' . config('app.name'),
                $this->messageService->getRegisterNotification()
            );

            $message = $this->messageService->getRegisterMessage();

            $this->emailService->send(
                Auth::user()->email,
                $message['subject'],
                $message['payload']
            );
        } catch (\Throwable $th) {
            Log::error($th);
        }

        alert('success', 'Welcome to ' . config('app.name'));
        return redirect()->intended(route('user.dashboard'));
    }
}
