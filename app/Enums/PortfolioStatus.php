<?php

namespace App\Enums;

enum PortfolioStatus: string
{
    case PUBLIC = 'draft';
    case DISABLED = 'disabled';
    case ACTIVE = 'active';
}