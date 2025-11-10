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
            $this->emailService->send(Auth::user()->email, config('messages.register.subject'), config('messages.register.payload'), true);
            return redirect()->intended(route('user.dashboard'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.dashboard');
        }
    }
}
