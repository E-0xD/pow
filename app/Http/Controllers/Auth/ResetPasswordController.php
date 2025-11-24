<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ResetPasswordController extends Controller
{
    protected MessageService $messageService;
    protected EmailService $emailService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
        $this->emailService = new EmailService();
    }

    public function index(Request $request, $token = null)
    {
        // pass the incoming request so the blade can access old email if provided
        return view('auth.reset-password', ['request' => $request, 'token' => $token]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        try {
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),

                function ($user, $password) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                $user = User::where('email', $request->email)->first();
                if ($user) {


                    $message = $this->messageService->getPasswordResetSuccessMessage($user);

                    $this->emailService->send(
                        $user->email,
                        $message['subject'],
                        $message['payload']
                    );

                    Auth::login($user);
                }

                return redirect()->intended(route('user.dashboard'))->with('status', 'Password reset successfully. Welcome back!');
            }

            return back()->withErrors(['email' => [__($status)]]);
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->withErrors(['email' => "An error occurred while changing your password"]);
        }
    }
}
