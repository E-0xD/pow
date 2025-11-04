<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = [
            // --- Core contact channels ---
            ['Email', 'mail'],
            ['Phone', 'call'],
            ['SMS', 'sms'],
            ['Website', 'public'],
            ['Location', 'location_on'],

            // --- Social media ---
            ['Facebook', 'facebook'],
            ['Twitter', 'alternate_email'],
            ['Instagram', 'photo_camera'],
            ['LinkedIn', 'work'],
            ['YouTube', 'play_circle'],
            ['TikTok', 'music_note'],
            ['Snapchat', 'bolt'],
            ['Pinterest', 'push_pin'],
            ['Reddit', 'chat'],

            // --- Messaging & chat apps ---
            ['WhatsApp', 'chat_bubble'],
            ['Telegram', 'send'],
            ['Messenger', 'forum'],
            ['Slack', 'forum'],
            ['Discord', 'headphones'],

            // --- Developer / Professional platforms ---
            ['GitHub', 'code'],
            ['GitLab', 'code_blocks'],
            ['Bitbucket', 'integration_instructions'],
            ['Dribbble', 'sports_basketball'],
            ['Behance', 'brush'],
            ['Figma', 'design_services'],
            ['Stack Overflow', 'question_answer'],

            // --- Freelance / business platforms ---
            ['Upwork', 'work_history'],
            ['Fiverr', 'paid'],
            ['Freelancer', 'work_outline'],
            ['Medium', 'article'],
            ['Substack', 'description'],
            ['Patreon', 'favorite'],
            ['Ko-fi', 'local_cafe'],

            // --- Miscellaneous ---
            ['Calendly', 'event'],
            ['Zoom', 'videocam'],
            ['Skype', 'phone_in_talk'],
            ['Signal', 'security'],
            ['Threads', 'alternate_email'],
        ];

        $data = [];
        foreach ($methods as [$title, $icon]) {
            $data[] = [
                'title' => $title,
                'logo'  => '<span class="material-symbols-outlined">' . $icon . '</span>',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('contact_methods')->insert($data);
    }
}
