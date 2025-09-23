<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutPage;

class AboutPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutPage::truncate();
        $aboutPages = [
            [
                'title' => 'Giới thiệu về An Phú',
                'description' => 'Tìm hiểu về lịch sử hình thành và phát triển của Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú',
                'content' => '<p class="ql-align-center"><strong>Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú</strong></p>
<p class="ql-align-center">Tên quốc tế: An Phu Architecture and Interior Design Consulting Company Limited</p>
<p class="ql-align-center">Ngày thành lập: 15/01/2019</p>
<p class="ql-align-center">Mã số thuế: 0108588362</p>
<p class="ql-align-center">Người đại diện: Phạm Đăng Thu</p>

<h3>Về chúng tôi</h3>
<p>Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú được thành lập với sứ mệnh mang đến những giải pháp thiết kế kiến trúc và nội thất chuyên nghiệp, sáng tạo và phù hợp với nhu cầu của từng khách hàng.</p>

<p>Với đội ngũ kiến trúc sư và nhà thiết kế giàu kinh nghiệm, chúng tôi cam kết cung cấp những dịch vụ tư vấn thiết kế chất lượng cao, từ khâu ý tưởng ban đầu đến việc hoàn thiện công trình.</p>

<h3>Tầm nhìn</h3>
<p>Trở thành công ty hàng đầu trong lĩnh vực tư vấn thiết kế kiến trúc và nội thất tại Việt Nam, góp phần tạo nên những không gian sống và làm việc đẹp, tiện nghi và bền vững.</p>

<h3>Sứ mệnh</h3>
<p>Mang đến những giải pháp thiết kế tối ưu, sáng tạo và phù hợp với văn hóa Việt Nam, đồng thời ứng dụng những xu hướng thiết kế hiện đại nhất trên thế giới.</p>'
            ],
            [
                'title' => 'Giá trị văn hóa',
                'description' => 'Những giá trị cốt lõi và văn hóa doanh nghiệp của An Phú trong việc phục vụ khách hàng và phát triển bền vững',
                'content' => '<h3>Giá trị cốt lõi của An Phú</h3>

<h4>1. Chất lượng là ưu tiên hàng đầu</h4>
<p>Chúng tôi luôn đặt chất lượng lên hàng đầu trong mọi dự án, từ khâu tư vấn, thiết kế đến thi công và bàn giao. Mỗi sản phẩm của An Phú đều được kiểm tra kỹ lưỡng và đảm bảo đáp ứng các tiêu chuẩn cao nhất.</p>

<h4>2. Sáng tạo và đổi mới</h4>
<p>Chúng tôi không ngừng học hỏi và cập nhật những xu hướng thiết kế mới nhất, kết hợp với sự sáng tạo để mang đến những giải pháp độc đáo và phù hợp với từng khách hàng.</p>

<h4>3. Tôn trọng và lắng nghe khách hàng</h4>
<p>Mỗi khách hàng đều có những nhu cầu và mong muốn riêng. Chúng tôi luôn lắng nghe, tôn trọng và tư vấn một cách chân thành để mang đến giải pháp tối ưu nhất.</p>

<h4>4. Trách nhiệm với cộng đồng</h4>
<p>An Phú cam kết sử dụng các vật liệu thân thiện với môi trường, thiết kế bền vững và góp phần xây dựng một cộng đồng phát triển.</p>

<h4>5. Tinh thần đồng đội</h4>
<p>Chúng tôi xây dựng một môi trường làm việc tích cực, khuyến khích sự hợp tác và phát triển cá nhân của từng thành viên trong đội ngũ.</p>

<h3>Văn hóa doanh nghiệp</h3>
<p>Văn hóa An Phú được xây dựng trên nền tảng của sự chuyên nghiệp, sáng tạo và trách nhiệm. Chúng tôi tin rằng một môi trường làm việc tích cực sẽ tạo ra những sản phẩm chất lượng và mang lại giá trị bền vững cho khách hàng.</p>'
            ],
            [
                'title' => 'Thư ngỏ',
                'description' => 'Lời chào và cam kết của Ban lãnh đạo An Phú gửi đến quý khách hàng và đối tác',
                'content' => '<p class="ql-align-center"><strong>THƯ NGỎ TỪ BAN LÃNH ĐẠO AN PHÚ</strong></p>

<p>Kính gửi Quý khách hàng và Đối tác,</p>

<p>Thay mặt toàn thể cán bộ nhân viên Công ty TNHH Tư vấn Thiết kế Kiến trúc và Nội thất An Phú, tôi xin gửi lời chào trân trọng và lời cảm ơn sâu sắc đến Quý khách hàng và các đối tác đã tin tưởng, ủng hộ và đồng hành cùng chúng tôi trong suốt thời gian qua.</p>

<p>Từ khi thành lập vào năm 2019, An Phú đã không ngừng nỗ lực để trở thành một trong những công ty hàng đầu trong lĩnh vực tư vấn thiết kế kiến trúc và nội thất. Chúng tôi tự hào đã hoàn thành hàng trăm dự án với chất lượng cao, từ những ngôi nhà nhỏ đến các công trình lớn, từ thiết kế nội thất đến quy hoạch kiến trúc.</p>

<h3>Cam kết của chúng tôi</h3>
<p>Trong hành trình phát triển, An Phú luôn cam kết:</p>
<ul>
<li><strong>Chất lượng dịch vụ:</strong> Cung cấp những giải pháp thiết kế tối ưu, sáng tạo và phù hợp với nhu cầu thực tế của từng khách hàng.</li>
<li><strong>Tiến độ thực hiện:</strong> Đảm bảo tiến độ dự án theo đúng cam kết, không để khách hàng phải chờ đợi.</li>
<li><strong>Giá cả hợp lý:</strong> Mang đến những dịch vụ chất lượng cao với mức giá cạnh tranh và minh bạch.</li>
<li><strong>Hỗ trợ tận tình:</strong> Đồng hành cùng khách hàng từ khâu tư vấn ban đầu đến khi hoàn thiện dự án.</li>
</ul>

<h3>Hướng tới tương lai</h3>
<p>Trong thời gian tới, An Phú sẽ tiếp tục đầu tư vào công nghệ, nâng cao trình độ chuyên môn của đội ngũ và mở rộng quy mô hoạt động để phục vụ tốt hơn nhu cầu ngày càng đa dạng của thị trường.</p>

<p>Chúng tôi tin rằng với sự ủng hộ của Quý khách hàng và đối tác, An Phú sẽ tiếp tục phát triển mạnh mẽ và góp phần tạo nên những không gian sống đẹp, tiện nghi cho cộng đồng.</p>

<p>Một lần nữa, xin chân thành cảm ơn Quý khách hàng và đối tác. Chúng tôi mong muốn được tiếp tục hợp tác và phục vụ Quý vị trong thời gian tới.</p>

<p class="ql-align-right">Trân trọng,<br>
<strong>Phạm Đăng Thu</strong><br>
Giám đốc Công ty TNHH Tư vấn Thiết kế<br>
Kiến trúc và Nội thất An Phú</p>'
            ]
        ];

        foreach ($aboutPages as $page) {
            AboutPage::create($page);
        }
    }
}
