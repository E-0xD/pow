<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function index(Request $request, $token = null)
    {
        // pass the incoming request so the blade can access old email if provided
        return view('auth.reset-password', ['request' => $request, 'token' => $token]);
    }

    public function reset(ResetPasswordRequest $request)
    {
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
            // log the user in after successful reset
            $user = \App\Models\User::where('email', $request->email)->first();
            if ($user) {
                Auth::login($user);
            }

            return redirect()->intended('/');
        }

        return back()->withErrors(['email' => [__($status)]]);
    }
}
