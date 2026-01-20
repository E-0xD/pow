<?php

namespace App\Http\Controllers\Auth;

use App\Enums\BillingCycle;
use App\Enums\NotificationType;
use App\Enums\UserSubscriptionStatus;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\NotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Plan;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected EmailService $emailService;
    protected NotificationService $notificationService;
    protected MessageService $messageService;
    protected Agent $agent;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->agent = new Agent();
        $this->emailService = new EmailService();
        $this->messageService = new MessageService($this->agent);
    }


    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        // attempt login 
        try {

            if (Auth::attempt($request->only(['email', 'password']), $request->remember)) {
                $request->session()->regenerate();
            } else {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->withErrors([
                'email' => 'An error occurred while logging you in, try again soon',
            ])->onlyInput('email');
        }


        // send notification 
        try {
            $this->notificationService->sendToUser(
                NotificationType::LOGIN,
                Auth::user(),
                'Login Attempt',
                $this->messageService->getLoginNotification()
            );

            $message = $this->messageService->getLoginMessage();

            if (!Auth::user()->subscriptions->where('status', UserSubscriptionStatus::ACTIVE)->first()) {

                $plan = Plan::where('price', null)->where('billing_cycle', BillingCycle::YEARLY)->first();

                UserSubscription::create([
                    'plan_id' => $plan->id,
                    'user_id' => Auth::user()->id,
                    'billing_cycle' => BillingCycle::YEARLY,
                    'purchased_at' => now(),
                    'expires_at' => now()->addDays(BillingCycle::YEARLY->durationInDays()),
                    'status' => UserSubscriptionStatus::ACTIVE,
                    'processor_subscription_code' => null,
                    'processor_email_token' => null,
                ]);
            }
            
            $this->emailService->send(
                Auth::user()->email,
                $message['subject'],
                $message['payload']
            );
        } catch (\Throwable $th) {
            Log::error($th);
        }

        return redirect()->intended(route('user.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
