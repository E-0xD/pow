<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'uid' => '3dfb57ab-91c9-46e8-b1fd-fe76d9208a82',
                'price' => 50.00,
                'name' => 'Yearly',
                'description' => 'Access all premium features for a full year.',
                'benefits' => json_encode([
                    'Unlimited portfolio templates',
                    'Priority support',
                    'Advanced analytics',
                    'Custom domain connection'
                ]),
                'duration' => 365,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'uid' => '45edfe7b-7ad8-4578-9b6c-2be022b8bc4b',
                'price' => 5.00,
                'name' => 'Monthly',
                'description' => 'Access all premium features for a month.',
                'benefits' => json_encode([
                    'Unlimited portfolio templates',
                    'Priority support',
                    'Basic analytics'
                ]),
                'duration' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
