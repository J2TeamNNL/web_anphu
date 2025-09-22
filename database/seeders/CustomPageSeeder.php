<?php

namespace Database\Seeders;

use App\Models\CustomPage;
use Illuminate\Database\Seeder;

class CustomPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomPage::truncate();

        // Trang chủ
        CustomPage::create([
            'name' => 'Trang chủ',
            'slug' => 'index',
            'title_1' => 'CÔNG TY THIẾT KẾ XÂY DỰNG AN PHÚ',
            'title_2' => 'Kiến tạo không gian sống hoàn hảo',
            'title_3' => 'Dịch vụ chuyên nghiệp',
            'title_4' => 'Cam kết chất lượng',
            'custom_content_1' => 'Với hơn 10 năm kinh nghiệm trong lĩnh vực thiết kế và xây dựng, An Phú tự hào là đối tác tin cậy của hàng nghìn gia đình Việt Nam.',
            'custom_content_2' => 'Chúng tôi chuyên thiết kế và thi công các công trình dân dụng, biệt thự, nhà phố với phong cách hiện đại, sang trọng.',
            'custom_content_3' => 'Thiết kế kiến trúc',
            'custom_content_4' => 'Đảm bảo tiến độ, chất lượng và giá thành hợp lý cho mọi dự án.',
        ]);

        // Về An Phú
        CustomPage::create([
            'name' => 'Về An Phú',
            'slug' => 'about-anphu',
            'title_1' => 'VỀ CÔNG TY AN PHÚ',
            'title_2' => 'Lịch sử hình thành',
            'title_3' => 'Sứ mệnh và tầm nhìn',
            'title_4' => 'Thành tựu đạt được',
            'custom_content_1' => '<p>Công ty Thiết kế Xây dựng An Phú được thành lập năm 2014 với khát vọng mang đến những công trình kiến trúc chất lượng cao cho người Việt.</p>',
            'custom_content_2' => '<p>Từ một công ty nhỏ với 5 nhân viên, An Phú đã phát triển thành một tập đoàn với hơn 200 cán bộ nhân viên chuyên nghiệp.</p><p>Trải qua gần 10 năm hoạt động, chúng tôi đã tích lũy được kinh nghiệm quý báu và xây dựng được uy tín vững chắc trên thị trường.</p>',
            'custom_content_3' => '<p><strong>Sứ mệnh:</strong> Kiến tạo không gian sống hoàn hảo, mang lại hạnh phúc cho mọi gia đình Việt.</p><p><strong>Tầm nhìn:</strong> Trở thành công ty thiết kế xây dựng hàng đầu Việt Nam, được khách hàng tin tưởng và lựa chọn.</p>',
            'custom_content_4' => '<ul><li>Hơn 1000 công trình đã hoàn thành</li><li>98% khách hàng hài lòng</li><li>50+ giải thưởng kiến trúc</li><li>Chứng nhận ISO 9001:2015</li></ul>',
        ]);

        // Giá trị văn hóa
        CustomPage::create([
            'name' => 'Giá trị văn hóa',
            'slug' => 'gia-tri-van-hoa',
            'title_1' => 'GIÁ TRỊ VĂN HÓA AN PHÚ',
            'title_2' => '5 Giá trị cốt lõi',
            'title_3' => 'Triết lý kinh doanh',
            'title_4' => 'Cam kết với khách hàng',
            'custom_content_1' => '<p>Văn hóa doanh nghiệp An Phú được xây dựng trên nền tảng 5 giá trị cốt lõi, tạo nên sức mạnh và bản sắc riêng của công ty.</p>',
            'custom_content_2' => '<ol><li><strong>Chất lượng:</strong> Luôn đặt chất lượng lên hàng đầu trong mọi sản phẩm và dịch vụ</li><li><strong>Uy tín:</strong> Xây dựng niềm tin bằng sự chân thành và minh bạch</li><li><strong>Sáng tạo:</strong> Không ngừng đổi mới và sáng tạo trong thiết kế</li><li><strong>Tận tâm:</strong> Phục vụ khách hàng với tất cả sự tận tâm và nhiệt huyết</li><li><strong>Phát triển bền vững:</strong> Hướng tới sự phát triển bền vững cho cộng đồng</li></ol>',
            'custom_content_3' => '<p>Chúng tôi tin rằng kiến trúc không chỉ là nghệ thuật mà còn là khoa học. Mỗi công trình của An Phú đều mang trong mình tâm hồn và câu chuyện riêng.</p><p>Triết lý "Kiến tạo từ trái tim" là kim chỉ nam cho mọi hoạt động của chúng tôi.</p>',
            'custom_content_4' => '<ul><li>Cam kết tiến độ đúng hẹn</li><li>Bảo hành trọn đời kết cấu</li><li>Hỗ trợ 24/7 sau bàn giao</li><li>Giá cả minh bạch, không phát sinh</li></ul>',
        ]);

        // Thư ngỏ
        CustomPage::create([
            'name' => 'Thư ngỏ',
            'slug' => 'thu-ngo',
            'title_1' => 'THƯ NGỎ TỪ BAN LÃNH ĐẠO',
            'title_2' => 'Lời chào từ Tổng Giám đốc',
            'title_3' => 'Cam kết của chúng tôi',
            'title_4' => 'Lời cảm ơn',
            'custom_content_1' => '<p>Kính chào Quý khách hàng và Đối tác!</p><p>Thay mặt Ban lãnh đạo và toàn thể cán bộ nhân viên Công ty An Phú, tôi xin gửi lời chào trân trọng nhất đến Quý khách hàng và các Đối tác.</p>',
            'custom_content_2' => '<p>Với gần 10 năm kinh nghiệm trong lĩnh vực thiết kế và xây dựng, An Phú đã không ngừng nỗ lực để mang đến những sản phẩm và dịch vụ tốt nhất cho khách hàng.</p><p>Chúng tôi hiểu rằng, ngôi nhà không chỉ là nơi ở mà còn là tổ ấm, là nơi gắn kết các thành viên trong gia đình. Vì vậy, mỗi công trình của An Phú đều được đầu tư tâm huyết và chăm chút tỉ mỉ.</p>',
            'custom_content_3' => '<p>An Phú cam kết:</p><ul><li>Luôn lắng nghe và thấu hiểu nhu cầu của khách hàng</li><li>Mang đến những giải pháp thiết kế tối ưu và sáng tạo</li><li>Đảm bảo chất lượng thi công đạt tiêu chuẩn cao nhất</li><li>Hỗ trợ khách hàng trong suốt quá trình sử dụng công trình</li></ul>',
            'custom_content_4' => '<p>Xin chân thành cảm ơn Quý khách hàng đã tin tưởng và đồng hành cùng An Phú trong suốt thời gian qua. Sự tin tưởng của Quý khách chính là động lực để chúng tôi không ngừng hoàn thiện và phát triển.</p><p>Trân trọng!</p><p><strong>Nguyễn Văn A</strong><br>Tổng Giám đốc Công ty An Phú</p>',
        ]);
    }
}
