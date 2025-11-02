<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PortfolioMessage;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public $notificationService;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();


        $visitsData = $user->portfolioVisitsCountLastDays(30);

        $totalPortfolio = $user->portfolios()->count();
        $notifications = (new NotificationService())->getUserNotifications($user);

        $unreadMessagesCount = PortfolioMessage::whereHas('portfolio', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('read', false)->count();


        foreach ($notifications as $notification) {
            (new NotificationService())->markAsRead($user, $notification->id);
        }

        return view('user.dashboard.index', compact('totalPortfolio', 'notifications', 'unreadMessagesCount', 'visitsData'));
    }
}
