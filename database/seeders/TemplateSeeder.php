<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('templates')->insert([
            'uid' => 'd5b332f9-6665-4deb-88c8-da021591cfc8',
            'title' => 'Green beret',
            'status' => 'published',
            'thumbnail_path' => 'templates/KX7oOHm7yHHYXAXRBGQqI6diJ28IzuUxtpEucsHO.jpg',
            'file_path' => 'template.test.index',
            'tags' => json_encode(["minimal", 'green']),
            'created_at' => '2025-10-30 00:20:40',
            'updated_at' => '2025-10-30 00:20:40',
        ]);
    }
}
