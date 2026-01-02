<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\EmailService;
use App\Services\MessageService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    protected EmailService $emailService;
    protected MessageService $messageService;

    public function __construct(EmailService $emailService, MessageService $messageService)
    {
        $this->emailService = $emailService;
        $this->messageService = $messageService;
    }

    public function createUser(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $apiKey = $request->bearerToken();
            if (!$apiKey) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'API key required',
                ], 401);
            }

            $partner = Partner::where('api_key', $apiKey)->first();
            if (!$partner) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid API key',
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $partner->users()->attach($user);

            $message = $this->messageService->getPartnerRegisterMessage($user, $partner);

            $this->emailService->send(
                to: $user,
                subject: $message['subject'],
                payload: $message['payload'],
                queue: false
            );

            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => [
                    'name' =>  $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at
                ],
            ], 201);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong on our end. Please try again shortly.',
            ], 422);
        }
    }
}
