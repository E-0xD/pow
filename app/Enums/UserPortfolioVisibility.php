<?php

namespace App\Enums;

enum UserPortfolioVisibility: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';
    case PASSWORDPROTECTED = 'password_protected';
}