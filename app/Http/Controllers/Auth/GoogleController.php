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
            $payload = [
                'title'      => 'Welcome to ' . config('app.name'),
                'name'       => Auth::user()->name,
                'greeting'   => 'Hey ' . Auth::user()->name . ', welcome to ' . config('app.name'),
                'introLines' => [
                    'You just took the first step to owning your digital proof of work.',
                    'Here, you can build, share, and grow a portfolio that truly speaks for you.',
                    'We’re building this for professionals like you, so feel free to message us anytime with a feature you\'ll love to see.',
                    'We’re rooting for you; hoping you land your next big gig that’s truly life-changing.',
                    'Let’s build something great together.'
                ],
                'actionText' => 'Go to Dashboard',
                'actionUrl'  => route('user.dashboard'),
                'outroLines' => ['If you need help, reply to this email.'],
                'signature'  => '— The ' . config('app.name') . ' Team',
                'company'    => config('app.name'),
            ];
            $subject = 'Your Work, Your Badge. let’s make it count.';
        } else {
            $payload = [
                'title'      => 'Welcome Back to ' . config('app.name'),
                'name'       => Auth::user()->name,
                'greeting'   => 'Hey ' . Auth::user()->name . ', welcome back',
                'introLines' => [
                    'We noticed a new login on ' . now()->format('Y-m-d H:i:s') . ' UTC using ' . $this->agent->browser() . ' on ' . $this->agent->platform() . '.',
                    'Glad to see you again! Keep building your digital proof of work.',
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
