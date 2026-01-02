<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;

class SandboxController extends Controller
{
    /**
     * Get list of all available API endpoints
     */
    public function getEndpoints()
    {
        return response()->json([
            'status' => 'success',
            'endpoints' => [
                [
                    'id' => 'create-user',
                    'name' => 'Create User',
                    'method' => 'POST',
                    'path' => '/api/partners/users',
                    'description' => 'Creates a new user account through a partner account',
                    'authentication' => 'Bearer Token (API Key)',
                    'parameters' => [
                        [
                            'name' => 'name',
                            'type' => 'string',
                            'required' => true,
                            'description' => 'User\'s full name (max 255 characters)',
                            'example' => 'John Doe'
                        ],
                        [
                            'name' => 'email',
                            'type' => 'string',
                            'required' => true,
                            'description' => 'User\'s email address (must be unique)',
                            'example' => 'john@example.com'
                        ],
                        [
                            'name' => 'password',
                            'type' => 'string',
                            'required' => true,
                            'description' => 'User\'s password (minimum 8 characters)',
                            'example' => 'securepassword123'
                        ]
                    ],
                    'responses' => [
                        [
                            'status' => 201,
                            'description' => 'User created successfully',
                            'example' => [
                                'status' => 'success',
                                'message' => 'User created successfully',
                                'user' => [
                                    'name' => 'John Doe',
                                    'email' => 'john@example.com',
                                    'created_at' => '2026-01-02T10:30:00.000000Z'
                                ]
                            ]
                        ],
                        [
                            'status' => 422,
                            'description' => 'Validation failed',
                            'example' => [
                                'status' => 'error',
                                'message' => 'Validation failed',
                                'errors' => [
                                    'email' => ['The email has already been taken.']
                                ]
                            ]
                        ],
                        [
                            'status' => 401,
                            'description' => 'API key missing or invalid',
                            'example' => [
                                'status' => 'error',
                                'message' => 'Invalid API key'
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    /**
     * Sandbox endpoint for testing (doesn't create real users)
     */
    public function testCreateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
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

        // Sandbox mode - just validate and return mock response
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'sandbox' => true,
            'user' => [
                'name' => $request->name,
                'email' => $request->email,
                'created_at' => now()->toIso8601String()
            ],
        ], 201);
    }
}
