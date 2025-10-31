<?php

namespace App\Enums;

enum PortfolioVisibility: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';
    case PASSWORDPROTECTED = 'password_protected';
}