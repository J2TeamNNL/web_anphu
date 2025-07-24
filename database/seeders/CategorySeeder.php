<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\CategoryType;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Biệt thự',
                'slug' => 'villa',
                'type' => CategoryType::PORTFOLIO->value,
            ],
            [
                'name' => 'Nhà phố',
                'slug' => 'town',
                'type' => CategoryType::PORTFOLIO->value,
            ],
            [
                'name' => 'Nhà thương mại',
                'slug' => 'commercial',
                'type' => CategoryType::PORTFOLIO->value,
            ],
            [
                'name' => 'Dự án nổi bật',
                'slug' => 'featured',
                'type' => CategoryType::PORTFOLIO->value,
            ],
            [
                'name' => 'Dự án mới',
                'slug' => 'new',
                'type' => CategoryType::PORTFOLIO->value,
            ],
        ]);
    }
}
