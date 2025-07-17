<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'noi-that' => [ // Nội thất
                'name' => 'Nội thất',
                'children' => [
                    'nha-o' => 'Nội thất nhà ở',
                    'van-phong' => 'Nội thất văn phòng',
                ],
            ],
            'biet-thu' => [ // Biệt thự
                'name' => 'Biệt thự',
                'children' => [
                    'hien-dai' => 'Hiện đại',
                    'tan-co-dien' => 'Tân cổ điển',
                ],
            ],
            'nha-ong' => [ // Nhà ống
                'name' => 'Nhà ống',
                'children' => [
                    '2-tang' => 'Nhà 2 tầng',
                    '3-tang' => 'Nhà 3 tầng',
                    '4-8-tang' => 'Nhà 4-8 tầng',
                    '5-tang' => 'Nhà 5 tầng',
                    'cap-4' => 'Nhà cấp 4',
                ],
            ],
            'thuong-mai' => [ // Thương mại
                'name' => 'Thương mại',
                'children' => [
                    'homestay' => 'Homestay',
                    'chung-cu' => 'Chung cư',
                ],
            ],
        ];
        

        foreach ($categories as $parentSlug => $parentData) {
            $parent = Category::create([
                'name' => $parentData['name'],
                'slug' => $parentSlug,
                'parent_id' => null,
            ]);
        
            foreach ($parentData['children'] as $childSlug => $childName) {
                Category::create([
                    'name' => $childName,
                    'slug' => $childSlug,
                    'parent_id' => $parent->id,
                ]);
            }
        }
        
    }
}
