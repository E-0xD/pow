<?php

namespace App\Http\Responses;

use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public $notificationService;
    public $agent;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->agent = new Agent();
    }

    /**
     * Handle response after successful login.
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // if ($user->role === 'admin') {
        //     return redirect()->intended('/admin/dashboard');
        // }

        $this->notificationService->sendToUser(
            Auth::user(),
            'Login Attempt',
            'A login was detected on ' . now()->format('Y-m-d H:i:s') .
                'UTC 0 using ' . $this->agent->browser() . ' on ' . $this->agent->platform()
        );

        return redirect()->intended(route('user.dashboard'));
    }
}
