<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::truncate();

        // Lấy categories để sử dụng
        $kienThucXayDung = Category::where('slug', 'kien-thuc-xay-dung')->first();
        $khuyenMai = Category::where('slug', 'khuyen-mai')->first();
        $camNhanKhachHang = Category::where('slug', 'cam-nhan-khach-hang')->first();
        $khoanhKhacCongTrinh = Category::where('slug', 'khoanh-khac-cong-trinh')->first();

        $articles = [
            [
                'name' => 'Dự án 3 miền',
                'slug' => 'du-an-3-mien',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/articles/upload_1756449358_68b14a4e6f9e1.jpg',
                'description' => 'Giám sát thi công biệt thự 3 tầng tân cổ điển tại Hà Nội',
                'content' => '<p>Nội dung bài viết về dự án 3 miền với những hình ảnh đẹp và chi tiết về quá trình thi công.</p>',
                'category_id' => $khoanhKhacCongTrinh->id,
                'type' => 'article',
            ],
            [
                'name' => 'Cảm nhận mới của khách hàng sau khi cải tạo mái ấm',
                'slug' => 'cam-nhan-moi',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/articles/upload_1756438830_68b1212ed58a7.jpg',
                'description' => 'Chia sẻ cảm nhận của khách hàng về dịch vụ cải tạo nhà',
                'content' => '<p>Khách hàng chia sẻ về trải nghiệm tuyệt vời khi sử dụng dịch vụ cải tạo nhà của An Phú Build.</p>',
                'category_id' => $camNhanKhachHang->id,
                'type' => 'article',
            ],
            [
                'name' => 'THÔNG BÁO NGHỈ LỄ QUỐC KHÁNH 2/9/2025✨',
                'slug' => 'thong-bao-nghi-le-quoc-khanh-292025',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/articles/upload_1756450955_68b1508b3c116.jpg',
                'description' => 'THÔNG BÁO NGHỈ LỄ QUỐC KHÁNH 2/9/2025✨ An Phú Build xin trân trọng thông báo đến Quý Khách hàng & Quý Đối tác lịch nghỉ lễ Quốc khánh 2/9 năm 2025',
                'content' => '<p>Thông báo chi tiết về lịch nghỉ lễ Quốc khánh và thời gian làm việc trở lại của công ty.</p>',
                'category_id' => $khuyenMai->id,
                'type' => 'article',
            ],
            [
                'name' => '80% Sự cố xây dựng bắt nguồn từ việc thiếu bản thiết kế chi tiết!!!',
                'slug' => '80-su-co-xay-dung-bat-nguon-tu-viec-thieu-ban-thiet-ke-chi-tiet',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/articles/upload_1756451176_68b15168ee40a.jpg',
                'description' => 'Tầm quan trọng của bản thiết kế chi tiết trong xây dựng',
                'content' => '<p>Bài viết phân tích về tầm quan trọng của việc có bản thiết kế chi tiết trong quá trình xây dựng.</p>',
                'category_id' => $kienThucXayDung->id,
                'type' => 'article',
            ],
            [
                'name' => 'Kiến thức mới về xây dựng',
                'slug' => 'kien-thuc-moi',
                'thumbnail' => null,
                'description' => 'Chia sẻ kiến thức mới trong lĩnh vực xây dựng',
                'content' => '<p>Video và hình ảnh chia sẻ những kiến thức mới nhất trong lĩnh vực xây dựng và thiết kế.</p>',
                'category_id' => $kienThucXayDung->id,
                'type' => 'article',
            ],
            [
                'name' => '7+ Lợi Ích Đặc Biệt Khi Thiết Kế Nhà Ở An Phú',
                'slug' => '7-loi-ich-dac-biet-khi-thiet-ke-nha-o-an-phu',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/articles/upload_1758378584_68ceba581589e.jpg',
                'description' => 'Bạn băn khoăn về lợi ích thực sự của bản vẽ thiết kế? Cùng An Phú khám phá ngay 7 LỢI ÍCH VÀNG: tiết kiệm chi phí, an toàn kết cấu & tối ưu công năng.',
                'content' => '<p>Bài viết chi tiết về 7 lợi ích đặc biệt khi thiết kế nhà cùng An Phú Build và các dịch vụ hậu mãi tuyệt vời.</p>',
                'category_id' => $kienThucXayDung->id,
                'type' => 'article',
            ],
            [
                'name' => 'Xây Nhà Trọn Gói hay Tự Túc? Phân Tích Toàn Diện',
                'slug' => 'xay-nha-tron-goi-hay-tu-tuc-phan-tich-toan-dien',
                'thumbnail' => 'https://res.cloudinary.com/dxajdttox/image/upload/q_auto,f_auto/articles/upload_1758721771_68d3f6eb79440.jpg',
                'description' => 'So sánh chi tiết xây nhà trọn gói và tự xây nhà tại Việt Nam. Ưu nhược điểm về chi phí, thời gian, chất lượng & quản lý rủi ro.',
                'content' => '<p>Phân tích toàn diện về hai phương án xây nhà: trọn gói và tự túc, giúp bạn đưa ra lựa chọn tối ưu nhất.</p>',
                'category_id' => $kienThucXayDung->id,
                'type' => 'article',
            ],
        ];

        foreach ($articles as $articleData) {
            Article::create([
                'name' => $articleData['name'],
                'slug' => $articleData['slug'],
                'thumbnail' => $articleData['thumbnail'],
                'description' => $articleData['description'],
                'content' => $articleData['content'],
                'category_id' => $articleData['category_id'],
                'type' => $articleData['type'],
            ]);
        }
    }
}
