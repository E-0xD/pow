<?php

namespace App\Http\Responses;

use App\Enums\NotificationType;
use App\Services\EmailService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Laravel\Fortify\Contracts\RegisterResponse as ContractsRegisterResponse;

class RegisterResponse implements ContractsRegisterResponse
{

    public $emailService;
    public $notificationService;
    public $agent;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->agent = new Agent();
        $this->emailService = new EmailService();
    }


    /**
     * Handle response after successful registration.
     */
    public function toResponse($request)
    {
        try {
            $this->notificationService->sendToUser(
                NotificationType::SIGNUP,
                Auth::user(),
                'Welcome to ' . config('app.name'),
                'Your Work, Your Badge. let’s make it count.'
            );
            $payload = [
                'title' => 'Welcome to ' . config('app.name'),
                'name' => Auth::user()->name,
                'greeting' => 'Hey ' . Auth::user()->name . ', welcome to ' . config('app.name'),
                'introLines' => [
                    'You just took the first step to owning your digital proof of work.',
                    'Here, you can build, share, and grow a portfolio that truly speaks for you.',
                    'We’re building this for professionals like you, so feel free to message us anytime with a feature you\'ll love to see.',
                    'We’re rooting for you; hoping you land your next big gig that’s truly life-changing.',
                    'Let’s build something great together.'
                ],
                'actionText'  => 'Go to Dashboard',
                'actionUrl'   =>  route('user.dashboard'),
                'outroLines'  => ['If you need help, reply to this email.'],
                'signature'   => '— The ' . config('app.name') . ' Team',
                'company'     => config('app.name'),
            ];

            $this->emailService->send(Auth::user()->email, 'Your Work, Your Badge. let’s make it count.' , $payload, true);
            return redirect()->intended(route('user.dashboard'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.dashboard');
        }
    }
}
