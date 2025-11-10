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

            $user = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'google_id' => $user->id,
            ], [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->token,
                'google_refresh_token' => $user->refreshToken,
            ]);

            // determine if this was a newly created user
            $isNewUser = $user->wasRecentlyCreated;

            Auth::login($user);

            $this->notificationService->sendToUser(
                NotificationType::LOGIN,
                Auth::user(),
                'Login Attempt',
                'A login was detected on ' . now()->format('Y-m-d H:i:s') .
                    ' UTC 0 using ' . $this->agent->browser() . ' on ' . $this->agent->platform()
            );

            if ($isNewUser) {
                // payload for newly registered users
                $payload = [
                    'title'      => 'Welcome to ' . config('app.name'),
                    'name'       => Auth::user()->name,
                    'greeting'   => 'Hey ' . Auth::user()->name . ', welcome to ' . config('app.name'),
                    'introLines' => [
                        'You just took the first step to owning your digital proof of work. Remember, your work is your badge.',
                        'Here, you can build, share, and grow a portfolio that truly speaks for you.',
                        'We’re building this for creators like you, so feel free to message us anytime with a feature you’d love to see, or an idea you think could make ' . config('app.name') . ' better.',
                        'And above all, we’re rooting for you — hoping you land your next big gig that’s truly life-changing.',
                        'Let’s build something great together.'
                    ],
                    'actionText' => 'Go to Dashboard',
                    'actionUrl'  => route('user.dashboard'),
                    'outroLines' => ['If you need help, reply to this email.'],
                    'signature'  => '— The ' . config('app.name') . ' Team',
                    'company'    => config('app.name'),
                ];

                $subject = 'Welcome to ' . config('app.name');
            } else {
                // payload for returning / login users
                $payload = [
                    'title'      => 'Welcome Back to ' . config('app.name'),
                    'name'       => Auth::user()->name,
                    'greeting'   => 'Hey ' . Auth::user()->name . ', welcome back',
                    'introLines' => [
                        'We noticed a new login on ' . now()->format('Y-m-d H:i:s') . ' UTC using ' . $this->agent->browser() . ' on ' . $this->agent->platform() . '.',
                        'Glad to see you again! Keep building your digital proof of work and showing the world what you can do.',
                        'If this wasn’t you, you can secure your account immediately in your settings.'
                    ],
                    'actionText' => 'Go to Dashboard',
                    'actionUrl'  => route('user.dashboard'),
                    'outroLines' => ['If you need help, reply to this email.'],
                    'signature'  => '— The ' . config('app.name') . ' Team',
                    'company'    => config('app.name'),
                ];

                $subject = 'Login Attempt';
            }

            $this->emailService->send(Auth::user()->email, $subject, $payload, true);
            return redirect()->intended(route('user.dashboard'));
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('user.dashboard');
        }
    }
}
