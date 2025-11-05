<?php

namespace App\Http\Responses;

use App\Enums\NotificationType;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Laravel\Fortify\Contracts\RegisterResponse as ContractsRegisterResponse;

class RegisterResponse implements ContractsRegisterResponse
{

    public $notificationService;
    public $agent;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->agent = new Agent();
    }

    /**
     * Handle response after successful registration.
     */
    public function toResponse($request)
    {
        $this->notificationService->sendToUser(
            NotificationType::SIGNUP,
            Auth::user(),
            'Welcome' ,
            'Your Work, Your Badge. let’s make it count.'
        );

        return redirect()->intended(route('user.dashboard'));
    }
}
