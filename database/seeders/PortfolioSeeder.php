<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portfolio::truncate();

        // Lấy categories để sử dụng
        $xayNhaTronGoi = Category::where('slug', 'xay-nha-tron-goi')->first();
        $caiTaoNhaCu = Category::where('slug', 'cai-tao-nha-cu')->first();
        $thietKeKienTrucHienDai = Category::where('slug', 'thiet-ke-kien-truc-hien-dai')->first();
        $thietKeKienTrucTanCoDien = Category::where('slug', 'thiet-ke-kien-truc-tan-co-dien')->first();
        $thietKeKienTrucKhac = Category::where('slug', 'thiet-ke-kien-truc-khac')->first();
        $thietKeNoiThatHienDai = Category::where('slug', 'thiet-ke-noi-that-hien-dai')->first();
        $thietKeNoiThatTanCoDien = Category::where('slug', 'thiet-ke-noi-that-tan-co-dien')->first();
        $thietKeNoiThatKhac = Category::where('slug', 'thiet-ke-noi-that-khac')->first();

        $portfolios = [
            [
                'name' => 'Biệt thự 2 tầng hiện đại',
                'slug' => 'biet-thu-2-tang-hien-dai',
                'location' => 'Hà Nội',
                'area' => '200m2',
                'story' => '2',
                'client' => 'Anh Minh',
                'description' => 'Biệt thự 2 tầng thiết kế hiện đại, tối ưu không gian sống',
                'category_id' => $thietKeKienTrucTanCoDien->id,
                'type' => 'portfolio',
                'year' => '2023',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754546765_6894424d09fff.jpg',
                'content' => '<p>Dự án biệt thự 2 tầng với thiết kế hiện đại, tối ưu hóa không gian sống cho gia đình trẻ.</p>',
            ],
            [
                'name' => 'Biệt thự hiện đại Sóc Sơn',
                'slug' => 'biet-thu-hien-dai-soc-son',
                'location' => 'Sóc Sơn, Hà Nội',
                'area' => '250m2',
                'story' => '3',
                'client' => 'Anh Đức',
                'description' => 'Biệt thử 3 tầng phong cách hiện đại tại Sóc Sơn',
                'category_id' => $thietKeKienTrucHienDai->id,
                'type' => 'portfolio',
                'year' => '2023',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754548227_68944803f020e.jpg',
                'content' => '<p>Thiết kế biệt thự hiện đại với không gian mở, tận dụng ánh sáng tự nhiên.</p>',
            ],
            [
                'name' => 'Nhà cấp 4 truyền thống',
                'slug' => 'nha-cap-4-truyen-thong',
                'location' => 'Hà Nội',
                'area' => '120m2',
                'story' => '1',
                'client' => 'Bác Hùng',
                'description' => 'Nhà cấp 4 mang đậm nét truyền thống Việt Nam',
                'category_id' => $thietKeKienTrucKhac->id,
                'type' => 'portfolio',
                'year' => '2022',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1755273775_689f5a2f3de72.jpg',
                'content' => '<p>Thiết kế nhà cấp 4 với kiến trúc truyền thống nhưng tiện nghi hiện đại.</p>',
            ],
            [
                'name' => 'Nhà phố hiện đại 3 tầng',
                'slug' => 'nha-pho-hien-dai-3-tang',
                'location' => 'Hà Nội',
                'area' => '80m2',
                'story' => '3',
                'client' => 'Chị Lan',
                'description' => 'Nhà phố 3 tầng thiết kế hiện đại, tối ưu diện tích',
                'category_id' => $thietKeKienTrucHienDai->id,
                'type' => 'portfolio',
                'year' => '2023',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754548604_6894497c28808.jpg',
                'content' => '<p>Nhà phố 3 tầng với thiết kế thông minh, tận dụng tối đa không gian.</p>',
            ],
            [
                'name' => 'Homestay Sóc Sơn',
                'slug' => 'homestay-soc-son-hien-dai',
                'location' => 'Sóc Sơn, Hà Nội',
                'area' => '300m2',
                'story' => '2',
                'client' => 'Anh Tuấn',
                'description' => 'Homestay du lịch hiện đại, tối ưu cho kinh doanh',
                'category_id' => $thietKeKienTrucHienDai->id,
                'type' => 'portfolio',
                'year' => '2023',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754548807_68944a473b776.jpg',
                'content' => '<p>Thiết kế homestay hiện đại, phù hợp cho kinh doanh du lịch.</p>',
            ],
            [
                'name' => 'Nhà phố tân cổ điển',
                'slug' => 'nha-pho-tan-co-dien-ha-noi',
                'location' => 'Hà Nội',
                'area' => '90m2',
                'story' => '3',
                'client' => 'Chị Mai',
                'description' => 'Nhà phố 3 tầng phong cách tân cổ điển sang trọng',
                'category_id' => $thietKeKienTrucHienDai->id,
                'type' => 'portfolio',
                'year' => '2024',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754548910_68944aaebcc78.jpg',
                'content' => '<p>Nhà phố tân cổ điển với thiết kế sang trọng, đẳng cấp.</p>',
            ],
            [
                'name' => 'Biệt thự tân cổ điển Hưng Yên',
                'slug' => 'biet-thu-tan-co-dien-hung-yen',
                'location' => 'Hưng Yên',
                'area' => '350m2',
                'story' => '2',
                'client' => 'Chị Hoa',
                'description' => 'Biệt thự tân cổ điển tại vùng nông thôn',
                'category_id' => $thietKeKienTrucTanCoDien->id,
                'type' => 'portfolio',
                'year' => '2023',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754549026_68944b22f0eae.jpg',
                'content' => '<p>Biệt thự tân cổ điển hòa hợp với cảnh quan nông thôn.</p>',
            ],
            [
                'name' => 'Nội thất Scandinavian',
                'slug' => 'noi-that-scandinavian-ha-noi',
                'location' => 'Hà Nội',
                'area' => '100m2',
                'story' => null,
                'client' => 'Anh Nam',
                'description' => 'Thiết kế nội thất phong cách Scandinavian tối giản',
                'category_id' => $thietKeNoiThatKhac->id,
                'type' => 'portfolio',
                'year' => '2023',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754549517_68944d0d025a2.jpg',
                'content' => '<p>Nội thất Scandinavian với tông màu sáng, tạo cảm giác rộng rãi.</p>',
            ],
            [
                'name' => 'Nội thất tân cổ điển',
                'slug' => 'noi-that-tan-co-dien-dong-duong',
                'location' => 'Hà Nội',
                'area' => '150m2',
                'story' => null,
                'client' => 'Chị Linh',
                'description' => 'Nội thất phong cách Đông Dương tân cổ điển',
                'category_id' => $thietKeNoiThatTanCoDien->id,
                'type' => 'portfolio',
                'year' => '2022',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1754550329_689450391ba9a.jpg',
                'content' => '<p>Nội thất tân cổ điển mang đậm nét truyền thống Đông Dương.</p>',
            ],
            [
                'name' => 'Xây nhà trọn gói 4 tầng',
                'slug' => 'xay-nha-tron-goi-4-tang',
                'location' => 'Hà Nội',
                'area' => '100m2',
                'story' => '4',
                'client' => 'Anh Việt',
                'description' => 'Xây nhà trọn gói 4 tầng 1 tum, thiết kế tân cổ điển',
                'category_id' => $xayNhaTronGoi->id,
                'type' => 'portfolio',
                'year' => '2024',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1755331753_68a03ca929769.jpg',
                'content' => '<p>Dự án xây nhà trọn gói 4 tầng với thiết kế hiện đại.</p>',
            ],
            [
                'name' => 'Cải tạo căn hộ Duplex',
                'slug' => 'cai-tao-can-ho-duplex',
                'location' => 'Hà Nội',
                'area' => '130m2',
                'story' => '2',
                'client' => 'Anh Khoa',
                'description' => 'Cải tạo căn hộ Duplex phong cách Neo Classic',
                'category_id' => $caiTaoNhaCu->id,
                'type' => 'portfolio',
                'year' => '2024',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1755332018_68a03db2b7b38.jpg',
                'content' => '<p>Cải tạo căn hộ Duplex với phong cách tân cổ điển sang trọng.</p>',
            ],
            [
                'name' => 'Nội thất hiện đại 48m2',
                'slug' => 'noi-that-hien-dai-48m2',
                'location' => 'Hà Nội',
                'area' => '48m2',
                'story' => null,
                'client' => 'Chị Thu',
                'description' => 'Thiết kế nội thất hiện đại cho căn hộ nhỏ',
                'category_id' => $thietKeNoiThatHienDai->id,
                'type' => 'portfolio',
                'year' => '2024',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1755332847_68a040ef51da8.jpg',
                'content' => '<p>Thiết kế nội thất hiện đại tối ưu cho không gian nhỏ.</p>',
            ],
            [
                'name' => 'Cải tạo nhà cho thuê sinh viên',
                'slug' => 'cai-tao-nha-cho-thue-sinh-vien',
                'location' => 'Hà Nội',
                'area' => '200m2',
                'story' => '3',
                'client' => 'Anh Hải',
                'description' => 'Cải tạo nhà ở kết hợp phòng cho thuê sinh viên',
                'category_id' => $caiTaoNhaCu->id,
                'type' => 'portfolio',
                'year' => '2024',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/portfolios/upload_1755333528_68a043984dfed.jpg',
                'content' => '<p>Cải tạo nhà để tối ưu hóa không gian cho thuê sinh viên.</p>',
            ],
        ];

        foreach ($portfolios as $portfolioData) {
            Portfolio::create([
                'name' => $portfolioData['name'],
                'slug' => $portfolioData['slug'],
                'location' => $portfolioData['location'],
                'area' => $portfolioData['area'],
                'story' => $portfolioData['story'],
                'client' => $portfolioData['client'],
                'description' => $portfolioData['description'],
                'category_id' => $portfolioData['category_id'],
                'type' => $portfolioData['type'],
                'year' => $portfolioData['year'],
                'thumbnail' => $portfolioData['thumbnail'],
                'content' => $portfolioData['content'],
            ]);
        }
    }
}
