<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUpdateUserAccess;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index(Request $request)
    {

        $query = User::query();

        if ($search = $request->query('q')) {
            $query->where(fn($q) => $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    public function show(User $user)
    {
        $portfolios = $user->portfolios()
            ->with(['activeSubscription.plan', 'template'])
            ->latest()
            ->get();
            
        return view('admin.user.show', compact('user', 'portfolios'));
    }


    public function update(AdminUpdateUserAccess $request, User $user)
    {
        $data = $request->validated();

        try {
            $user->role = $data['role'];
            $user->status = $data['status'];
            $user->save();

            return redirect()->route('admin.user.show', $user)->with(['type' => 'success', 'message' => 'User updated.']);
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->withInput()->with(['type' => 'error', 'message' => 'Failed to update user.']);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.user.index')->with(['type' => 'success', 'message' => 'User deleted.']);
        } catch (\Throwable $e) {
            Log::error($e);
            return back()->with(['type' => 'error', 'message' => 'Failed to delete user.']);
        }
    }
}
