<?php

namespace App\Enums;

enum TemplateStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
}