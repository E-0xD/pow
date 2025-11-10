<?php

namespace App\Http\Controllers\Auth;

use App\Enums\NotificationType;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Laravel\Socialite\Socialite;

class GoogleController extends Controller
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
    public function initialize()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();


            $user = User::where('email', $googleUser->email)->first();

            if ($user) {

                if (empty($user->google_id)) {
                    $user->google_id = $googleUser->id;
                    $user->google_refresh_token = $googleUser->refreshToken ?? null;
                    $user->save();
                }

                $isNewUser = false;
            } else {

                $user = User::create([
                    'google_id'            => $googleUser->id,
                    'name'                 => $googleUser->name,
                    'email'                => $googleUser->email,
                    'password'             => bcrypt(str()->random(16)),
                    'google_refresh_token' => $googleUser->refreshToken ?? null,
                ]);

                $isNewUser = true;
            }


            Auth::login($user);


            $this->notificationService->sendToUser(
                NotificationType::LOGIN,
                Auth::user(),
                'Login Attempt',
                'A login was detected on ' . now()->format('Y-m-d H:i:s') .
                    ' UTC using ' . $this->agent->browser() . ' on ' . $this->agent->platform()
            );


            if ($isNewUser) {
                $this->emailService->send(Auth::user()->email, config('messages.register.subject'), config('messages.register.payload'), true);
            } else {
                $this->emailService->send(Auth::user()->email, config('messages.login.subject'), config('messages.login.payload'), true);
            }

            return redirect()->intended(route('user.dashboard'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.dashboard');
        }
    }
}
