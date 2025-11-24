<?php

namespace App\Http\Controllers\Auth;

use App\Enums\NotificationType;
use App\Services\EmailService;
use App\Services\MessageService;
use App\Services\NotificationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class RegisterController extends Controller
{

    protected EmailService $emailService;
    protected NotificationService $notificationService;
    protected MessageService $messageService;
    protected Agent $agent;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->agent = new Agent();
        $this->emailService = new EmailService();
        $this->messageService = new MessageService($this->agent);
    }
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            throw "Error Processing Request";

            $user = User::create($request->only(['email', 'name', 'password']));

            Auth::login($user);
        } catch (\Throwable $th) {
            Log::error($th);
            return back()
                ->withErrors([
                    'email' => 'An error occurred while logging you in, try again soon',
                ])
                ->withInput();
        }



        try {
            $this->notificationService->sendToUser(
                NotificationType::SIGNUP,
                Auth::user(),
                'Welcome to ' . config('app.name'),
                $this->messageService->getRegisterNotification()
            );

            $message = $this->messageService->getRegisterMessage();

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
}
