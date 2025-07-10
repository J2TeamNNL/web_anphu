<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Portfolio;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Portfolio::factory()->count(6)->create();
    }
}
