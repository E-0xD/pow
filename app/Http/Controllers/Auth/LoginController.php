<?php

namespace App\Http\Controllers\Auth;


use App\Enums\NotificationType;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\NotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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


    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {

        // attempt login 
        try {

            if (Auth::attempt($request->only(['email', 'password']), $request->remember)) {
                $request->session()->regenerate();
            } else {    
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ])->onlyInput('email');
            }

        } catch (\Throwable $th) {
            Log::error($th);
            return back()->withErrors([
                'email' => 'An error occurred while logging you in, try again soon',
            ])->onlyInput('email');
        }


        // send notification 
        try {
            $this->notificationService->sendToUser(
                NotificationType::LOGIN,
                Auth::user(),
                'Login Attempt',
                $this->messageService->getLoginNotification()
            );

            $message = $this->messageService->getLoginMessage();

            $this->emailService->send(
                Auth::user()->email,
                $message['subject'],
                $message['payload']
            );
        } catch (\Throwable $th) {
            Log::error($th);
        }

         return redirect()->intended(route('user.dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
