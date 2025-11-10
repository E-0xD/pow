<?php

namespace App\Http\Responses;

use App\Enums\NotificationType;
use App\Services\EmailService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
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
     * Handle response after successful login.
     */
    public function toResponse($request)
    {
        try {

            $this->notificationService->sendToUser(
                NotificationType::LOGIN,
                Auth::user(),
                'Login Attempt',
                'A login was detected on ' . now()->format('Y-m-d H:i:s') .
                    ' UTC 0 using ' . $this->agent->browser() . ' on ' . $this->agent->platform()
            );

            $payload = [
                'title'       => 'Login Attempt',
                'name'        => Auth::user()->name,
                'greeting'    => 'Welcome back, ' . Auth::user()->name,
                'introLines'  => [
                    'A login was detected on ' . now()->format('Y-m-d H:i:s') .
                        ' UTC 0 using ' . $this->agent->browser() . ' on ' . $this->agent->platform()
                ],
                'actionText'  => 'Go to Dashboard',
                'actionUrl'   =>  route('user.dashboard'),
                'outroLines'  => ['If you need help, reply to this email.'],
                'signature'   => '— The ' . config('app.name') . ' Team',
                'company'     => config('app.name'),
            ];

            $this->emailService->send(Auth::user()->email, 'Login Attempt', $payload, true);
            return redirect()->intended(route('user.dashboard'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.dashboard');
        }
    }
}
