<?php

namespace App\Enums;

enum UserPortfolioStatus: string
{
    case PUBLIC = 'draft';
    case DISABLED = 'disabled';
    case ACTIVE = 'active';
}