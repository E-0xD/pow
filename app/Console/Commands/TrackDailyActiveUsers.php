<?php

namespace App\Console\Commands;

use App\Models\UserDailyActivity;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class TrackDailyActiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:track-daily-activity';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Track daily active users from session data';

    protected Agent $agent;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->agent = new Agent();

        // Get all active sessions from the last 24 hours
        $sessions = DB::table('sessions')->where('user_id', '!=', null)
            ->where('last_activity', '>=', now()->subDay()->timestamp)
            ->get();

        if ($sessions->isEmpty()) {
            Log::error('No active sessions found.');
            $this->info('No active sessions found.');
            return Command::SUCCESS;
        }

        $trackedCount = 0;
        $today = now()->toDateString();

        foreach ($sessions as $session) {
            try {
            
                // Parse user agent
                $this->agent->setUserAgent($session->user_agent);

                // Check if record already exists for today
                $exists = UserDailyActivity::where('user_id', $session->user_id)
                    ->where('date', $today)
                    ->exists();

                if (!$exists) {
                    $location = $this->getUserLocation($session->ip_address);
                    
                    UserDailyActivity::create([
                        'user_id' => $session->user_id,
                        'date' => $today,
                        'country' => $location['country'],
                        'city' => $location['city'],
                        'ip_address' => $session->ip_address,
                        'user_agent' => $session->user_agent,
                        'device_type' => $this->getDeviceType(),
                    ]);

                    $trackedCount++;
                }
            } catch (\Exception $e) {
                Log::error($e);
                $this->warn("Error processing session: {$e->getMessage()}");
            }
        }

        Log::info("Successfully tracked ".$trackedCount ." daily active users.");
        $this->info("Successfully tracked {$trackedCount} daily active users.");

        return Command::SUCCESS;
    }

    /**
     * Get user location from IP address (returns country and city)
     */
    protected function getUserLocation($ipAddress): array
    {
        try {
            $response = @file_get_contents("http://ip-api.com/json/{$ipAddress}");
            
            if ($response) {
                $data = json_decode($response, true);
                return [
                    'country' => $data['country'] ?? 'Unknown',
                    'city' => $data['city'] ?? 'Unknown',
                ];
            }
        } catch (\Exception $e) {
            Log::error($e);
            // Silent fail for IP geolocation
        }

        return [
            'country' => 'Unknown',
            'city' => 'Unknown',
        ];
    }

    /**
     * Get device type from user agent
     */
    protected function getDeviceType(): string
    {
        if ($this->agent->isMobile()) {
            return 'mobile';
        } elseif ($this->agent->isTablet()) {
            return 'tablet';
        }
        return 'desktop';
    }
}
