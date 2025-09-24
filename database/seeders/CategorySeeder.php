<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\CategoryType;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    public function run(): void
    {   
        Category::truncate();

        // PORTFOLIO Categories (Parent categories)
        $xayNhaTronGoi = Category::create([
            'name' => $name = 'Xây nhà trọn gói',
            'slug' => Str::slug($name),
            'type' => CategoryType::PORTFOLIO,
        ]);

        $caiTaoNhaCu = Category::create([
            'name' => $name = 'Cải tạo Nhà cũ',
            'slug' => Str::slug($name),
            'type' => CategoryType::PORTFOLIO,
        ]);

        $thietKeKienTruc = Category::create([
            'name' => $name = 'Thiết kế kiến trúc',
            'slug' => Str::slug($name),
            'type' => CategoryType::PORTFOLIO,
        ]);

        $thietKeNoiThat = Category::create([
            'name' => $name = 'Thiết kế Nội thất',
            'slug' => Str::slug($name),
            'type' => CategoryType::PORTFOLIO,
        ]);

        // Child categories for Thiết kế kiến trúc
        Category::insert([
            [
                'name' => $name = 'Thiết kế Kiến trúc Hiện đại',
                'slug' => Str::slug($name),
                'type' => CategoryType::PORTFOLIO,
                'parent_id' => $thietKeKienTruc->id,
            ],
            [
                'name' => $name = 'Thiết kế kiến trúc Tân cổ điển',
                'slug' => Str::slug($name),
                'type' => CategoryType::PORTFOLIO,
                'parent_id' => $thietKeKienTruc->id,
            ],
            [
                'name' => $name = 'Thiết kế kiến trúc Khác',
                'slug' => Str::slug($name),
                'type' => CategoryType::PORTFOLIO,
                'parent_id' => $thietKeKienTruc->id,
            ],
            [
                'name' => $name = 'Thiết kế nội thất Hiện đại',
                'slug' => Str::slug($name),
                'type' => CategoryType::PORTFOLIO,
                'parent_id' => $thietKeNoiThat->id,
            ],
            [
                'name' => $name = 'Thiết kế Nội thất Tân cổ điển',
                'slug' => Str::slug($name),
                'type' => CategoryType::PORTFOLIO,
                'parent_id' => $thietKeNoiThat->id,
            ],
            [
                'name' => $name = 'Thiết kế Nội thất khác',
                'slug' => Str::slug($name),
                'type' => CategoryType::PORTFOLIO,
                'parent_id' => $thietKeNoiThat->id,
            ],
        ]);

        // ARTICLE Categories
        Category::insert([
            [
                'name' => $name = 'Kiến thức Xây dựng',
                'slug' => Str::slug($name),
                'type' => CategoryType::ARTICLE,
                'parent_id' => null,
            ],
            [
                'name' => $name = 'Khuyến mại',
                'slug' => Str::slug($name),
                'type' => CategoryType::ARTICLE,
                'parent_id' => null,
            ],
            [
                'name' => $name = 'Cảm nhận Khách hàng',
                'slug' => Str::slug($name),
                'type' => CategoryType::ARTICLE,
                'parent_id' => null,
            ],
            [
                'name' => $name = 'Khoảnh khắc công trình',
                'slug' => Str::slug($name),
                'type' => CategoryType::ARTICLE,
                'parent_id' => null,
            ],
        ]);
    }
}
