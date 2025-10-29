<?php

namespace App\Enums;

enum PortfolioStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
}