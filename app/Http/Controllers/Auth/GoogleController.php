<?php

namespace App\Http\Controllers\Auth;

use App\Enums\NotificationType;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Laravel\Socialite\Socialite;

class GoogleController extends Controller
{

    public $emailService;
    public $notificationService;
    public $messageService;
    public $agent;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->agent = new Agent();
        $this->emailService = new EmailService();
        $this->messageService = new MessageService($this->agent);
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
                    'status' => config('app.status') == 'waitlist' ? UserStatus::WAITLIST : UserStatus::ACTIVE
                ]);

                $isNewUser = true;
            }


            Auth::login($user);

            if ($isNewUser) {

                $this->notificationService->sendToUser(
                    NotificationType::SIGNUP,
                    Auth::user(),
                    'Welcome to ' . config('app.name'),
                    $this->messageService->getRegisterNotification()
                );
                $message = $this->messageService->getRegisterMessage();

            } else {

                $this->notificationService->sendToUser(
                    NotificationType::LOGIN,
                    Auth::user(),
                    'Login Attempt',
                    $this->messageService->getLoginNotification()
                );
                $message = $this->messageService->getLoginMessage();

            }

            $this->emailService->send(
                Auth::user()->email,
                $message['subject'],
                $message['payload']
            );

            return redirect()->intended(route('user.dashboard'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.dashboard');
        }
    }
}
