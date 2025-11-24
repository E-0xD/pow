<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    protected MessageService $messageService;
    protected EmailService $emailService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
        $this->emailService = new EmailService();
    }

    public function index()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            $token = Password::createToken($user);

            $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);


            $message = $this->messageService->getPasswordResetMessage($user, $resetLink);
            $this->emailService->send(
                $user->email,
                $message['subject'],
                $message['payload']
            );

            return back()->with('status', 'Password reset link has been sent to your email.');
        } catch (\Throwable $th) {
            Log::error($th);
            back()->with('status', 'Failed to send password reset link');
        }
    }
}
