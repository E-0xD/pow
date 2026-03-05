<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterviewApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class InterviewController extends Controller
{
    public function index()
    {
        $applicants = InterviewApplicant::orderBy('scheduled_at')->get();

        $stats = [
            'total' => $applicants->count(),
            'invitations_sent' => $applicants->whereNotNull('invitation_sent_at')->count(),
            'reminders_6h' => $applicants->whereNotNull('reminder_6h_sent_at')->count(),
            'reminders_1h' => $applicants->whereNotNull('reminder_1h_sent_at')->count(),
            'upcoming' => $applicants->where('scheduled_at', '>', now())->count(),
        ];

        return view('admin.interviews.index', compact('applicants', 'stats'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

    
        $request->file('file')->storeAs('interviews', 'applicants.xlsx', 'public');

        alert('success', 'File uploaded successfully! Processing will begin shortly.');

        return redirect()->back();
    }

    public function process()
    {
        Artisan::call('interviews:process');
        $output = Artisan::output();

        alert('success', 'Processing complete!');

        return redirect()->back();
    }
}
