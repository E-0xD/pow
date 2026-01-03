<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Template;

class TemplateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Template $template)
    {
       return view($template->file_path.'.preview');
    }
}
