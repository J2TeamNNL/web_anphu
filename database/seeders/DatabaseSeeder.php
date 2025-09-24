<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AboutPageSeeder::class,
            CompanySettingSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            ServiceSeeder::class,
            PortfolioSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
