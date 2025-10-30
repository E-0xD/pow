<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserPortfolio;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPortfolioPolicy
{
    use HandlesAuthorization;

    public function view(User $user, UserPortfolio $userPortfolio): bool
    {
        return $user->id === $userPortfolio->user_id;
    }

    public function update(User $user, UserPortfolio $userPortfolio): bool
    {
        return $user->id === $userPortfolio->user_id;
    }

    public function delete(User $user, UserPortfolio $userPortfolio): bool
    {
        return $user->id === $userPortfolio->user_id;
    }
}