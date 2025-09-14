<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::truncate();

        $services = [
            [
                'name' => 'Thi công xây dựng',
                'slug' => 'thi-cong-xay-dung',
                'slogan' => 'Xây dựng ước mơ - Kiến tạo tương lai',
                'description' => 'Dịch vụ thi công xây dựng chuyên nghiệp từ móng đến hoàn thiện, đảm bảo chất lượng và tiến độ.',
                'image' => '/assets/img/services/xay-dung.jpg',
                'title_1' => 'Tư vấn thiết kế',
                'content_1' => 'Đội ngũ kiến trúc sư giàu kinh nghiệm tư vấn thiết kế phù hợp với nhu cầu và ngân sách.',
                'title_2' => 'Thi công chuyên nghiệp',
                'content_2' => 'Sử dụng công nghệ hiện đại và vật liệu chất lượng cao trong quá trình thi công.',
                'title_3' => 'Giám sát chất lượng',
                'content_3' => 'Kiểm tra chất lượng nghiêm ngặt ở từng công đoạn để đảm bảo tiêu chuẩn cao nhất.',
                'title_4' => 'Bảo hành dài hạn',
                'content_4' => 'Cam kết bảo hành 5 năm cho kết cấu chính và 2 năm cho hoàn thiện.',
                'content_service' => '<h3>Quy trình thi công xây dựng</h3>
                    <ol>
                        <li><strong>Khảo sát địa chất:</strong> Xác định tính chất đất đai và điều kiện địa chất</li>
                        <li><strong>Thiết kế bản vẽ:</strong> Lập bản vẽ chi tiết theo yêu cầu khách hàng</li>
                        <li><strong>Xin phép xây dựng:</strong> Hỗ trợ làm thủ tục pháp lý cần thiết</li>
                        <li><strong>Thi công móng:</strong> Đào móng và đổ bê tông móng theo thiết kế</li>
                        <li><strong>Xây dựng kết cấu:</strong> Thi công cột, dầm, sàn theo đúng kỹ thuật</li>
                        <li><strong>Hoàn thiện:</strong> Thi công các hạng mục hoàn thiện nội ngoại thất</li>
                        <li><strong>Bàn giao:</strong> Kiểm tra tổng thể và bàn giao công trình</li>
                    </ol>',
                'content_price' => '<h3>Bảng giá thi công xây dựng</h3>
                    <table class="table table-bordered">
                        <tr><th>Hạng mục</th><th>Đơn giá (VNĐ/m²)</th><th>Ghi chú</th></tr>
                        <tr><td>Móng băng</td><td>800.000 - 1.200.000</td><td>Tùy độ sâu và loại đất</td></tr>
                        <tr><td>Kết cấu bê tông</td><td>1.500.000 - 2.000.000</td><td>Bao gồm cốt thép và ván khuôn</td></tr>
                        <tr><td>Xây tường gạch</td><td>350.000 - 450.000</td><td>Gạch đỏ hoặc gạch block</td></tr>
                        <tr><td>Mái ngói</td><td>400.000 - 600.000</td><td>Tùy loại ngói và độ dốc</td></tr>
                        <tr><td>Hoàn thiện cơ bản</td><td>800.000 - 1.200.000</td><td>Sơn, lát gạch, trần thạch cao</td></tr>
                    </table>
                    <p><em>*Giá trên đã bao gồm vật liệu và nhân công. Liên hệ để được báo giá chi tiết.</em></p>'
            ],
            [
                'name' => 'Thiết kế kiến trúc',
                'slug' => 'thiet-ke-kien-truc',
                'slogan' => 'Sáng tạo không gian - Kiến tạo phong cách',
                'description' => 'Dịch vụ thiết kế kiến trúc chuyên nghiệp, sáng tạo và phù hợp với xu hướng hiện đại.',
                'image' => '/assets/img/services/thiet-ke.jpg',
                'title_1' => 'Thiết kế 3D',
                'content_1' => 'Mô phỏng 3D chân thực giúp khách hàng hình dung rõ ràng về công trình tương lai.',
                'title_2' => 'Tư vấn phong thủy',
                'content_2' => 'Kết hợp yếu tố phong thủy trong thiết kế để mang lại may mắn và thịnh vượng.',
                'title_3' => 'Thiết kế xanh',
                'content_3' => 'Ứng dụng công nghệ xanh, tiết kiệm năng lượng và thân thiện môi trường.',
                'title_4' => 'Thiết kế đa dạng',
                'content_4' => 'Từ nhà phố, biệt thự đến công trình công cộng với nhiều phong cách khác nhau.',
                'content_service' => '<h3>Quy trình thiết kế kiến trúc</h3>
                    <ol>
                        <li><strong>Tiếp nhận yêu cầu:</strong> Trao đổi ý tưởng và nhu cầu của khách hàng</li>
                        <li><strong>Khảo sát thực địa:</strong> Đo đạc và khảo sát điều kiện thực tế</li>
                        <li><strong>Lập ý tưởng:</strong> Phác thảo các ý tưởng thiết kế ban đầu</li>
                        <li><strong>Thiết kế sơ bộ:</strong> Hoàn thiện bản vẽ phối cảnh và mặt bằng</li>
                        <li><strong>Thiết kế kỹ thuật:</strong> Lập bản vẽ thi công chi tiết</li>
                        <li><strong>Thuyết minh dự án:</strong> Lập thuyết minh kỹ thuật và dự toán</li>
                        <li><strong>Bàn giao hồ sơ:</strong> Chuyển giao đầy đủ hồ sơ thiết kế</li>
                    </ol>',
                'content_price' => '<h3>Bảng giá thiết kế kiến trúc</h3>
                    <table class="table table-bordered">
                        <tr><th>Loại thiết kế</th><th>Đơn giá (VNĐ/m²)</th><th>Thời gian</th></tr>
                        <tr><td>Thiết kế sơ bộ</td><td>80.000 - 120.000</td><td>7-10 ngày</td></tr>
                        <tr><td>Thiết kế kỹ thuật</td><td>150.000 - 200.000</td><td>15-20 ngày</td></tr>
                        <tr><td>Thiết kế 3D render</td><td>50.000 - 80.000</td><td>3-5 ngày</td></tr>
                        <tr><td>Thiết kế nội thất</td><td>100.000 - 150.000</td><td>10-15 ngày</td></tr>
                        <tr><td>Gói thiết kế hoàn chỉnh</td><td>300.000 - 450.000</td><td>25-30 ngày</td></tr>
                    </table>
                    <p><strong>Ưu đãi:</strong> Giảm 20% khi thiết kế + thi công cùng An Phú</p>'
            ],
            [
                'name' => 'Sửa chữa cải tạo',
                'slug' => 'sua-chua-cai-tao',
                'slogan' => 'Làm mới không gian - Nâng tầm giá trị',
                'description' => 'Dịch vụ sửa chữa, cải tạo nhà cũ thành không gian hiện đại, tiện nghi và đẹp mắt.',
                'image' => '/assets/img/services/sua-chua.jpg',
                'title_1' => 'Đánh giá hiện trạng',
                'content_1' => 'Khảo sát kỹ lưỡng tình trạng công trình để đưa ra phương án cải tạo phù hợp.',
                'title_2' => 'Cải tạo từng phần',
                'content_2' => 'Linh hoạt cải tạo theo từng giai đoạn, không ảnh hưởng đến sinh hoạt gia đình.',
                'title_3' => 'Nâng cấp tiện nghi',
                'content_3' => 'Cập nhật hệ thống điện nước, điều hòa và các tiện nghi hiện đại.',
                'title_4' => 'Tối ưu không gian',
                'content_4' => 'Sắp xếp lại bố cục để tận dụng tối đa diện tích và ánh sáng tự nhiên.',
                'content_service' => '<h3>Quy trình sửa chữa cải tạo</h3>
                    <ol>
                        <li><strong>Khảo sát hiện trạng:</strong> Đánh giá tình trạng kết cấu và hạ tầng</li>
                        <li><strong>Lập phương án:</strong> Đề xuất giải pháp cải tạo tối ưu</li>
                        <li><strong>Báo giá chi tiết:</strong> Lập dự toán cho từng hạng mục</li>
                        <li><strong>Tháo dỡ cũ:</strong> Tháo dỡ các phần cần thay thế</li>
                        <li><strong>Thi công mới:</strong> Xây dựng theo thiết kế mới</li>
                        <li><strong>Hoàn thiện:</strong> Lắp đặt và hoàn thiện các hạng mục</li>
                        <li><strong>Vệ sinh bàn giao:</strong> Dọn dẹp và bàn giao công trình</li>
                    </ol>',
                'content_price' => '<h3>Bảng giá sửa chữa cải tạo</h3>
                    <table class="table table-bordered">
                        <tr><th>Hạng mục</th><th>Đơn giá (VNĐ/m²)</th><th>Ghi chú</th></tr>
                        <tr><td>Sửa chữa mái</td><td>200.000 - 400.000</td><td>Tùy mức độ hư hỏng</td></tr>
                        <tr><td>Cải tạo phòng tắm</td><td>3.000.000 - 5.000.000</td><td>Bao gồm thiết bị vệ sinh</td></tr>
                        <tr><td>Cải tạo bếp</td><td>5.000.000 - 8.000.000</td><td>Tủ bếp và thiết bị</td></tr>
                        <tr><td>Sơn lại toàn bộ</td><td>80.000 - 120.000</td><td>Sơn nước cao cấp</td></tr>
                        <tr><td>Thay hệ thống điện</td><td>150.000 - 200.000</td><td>Dây và thiết bị mới</td></tr>
                    </table>
                    <p><strong>Khuyến mãi:</strong> Miễn phí khảo sát và tư vấn cho dự án trên 50 triệu</p>'
            ],
            [
                'name' => 'Thi công nội thất',
                'slug' => 'thi-cong-noi-that',
                'slogan' => 'Nội thất đẹp - Cuộc sống chất',
                'description' => 'Dịch vụ thiết kế và thi công nội thất cao cấp, tạo không gian sống hoàn hảo cho gia đình.',
                'image' => '/assets/img/services/noi-that.jpg',
                'title_1' => 'Thiết kế độc đáo',
                'content_1' => 'Thiết kế nội thất theo phong cách riêng, phù hợp với sở thích và cá tính gia chủ.',
                'title_2' => 'Vật liệu cao cấp',
                'content_2' => 'Sử dụng gỗ tự nhiên, đá marble và các vật liệu cao cấp nhập khẩu.',
                'title_3' => 'Thi công tỉ mỉ',
                'content_3' => 'Đội ngũ thợ lành nghề với nhiều năm kinh nghiệm trong thi công nội thất.',
                'title_4' => 'Bảo hành uy tín',
                'content_4' => 'Bảo hành 3 năm cho toàn bộ hạng mục nội thất và hỗ trợ bảo trì định kỳ.',
                'content_service' => '<h3>Quy trình thi công nội thất</h3>
                    <ol>
                        <li><strong>Tư vấn phong cách:</strong> Xác định phong cách và màu sắc phù hợp</li>
                        <li><strong>Thiết kế 3D:</strong> Tạo mô hình 3D để khách hàng dễ hình dung</li>
                        <li><strong>Chọn vật liệu:</strong> Tư vấn và lựa chọn vật liệu phù hợp</li>
                        <li><strong>Gia công sản xuất:</strong> Sản xuất đồ nội thất theo thiết kế</li>
                        <li><strong>Thi công lắp đặt:</strong> Lắp đặt và hoàn thiện tại công trình</li>
                        <li><strong>Trang trí hoàn thiện:</strong> Bố trí phụ kiện và trang trí</li>
                        <li><strong>Bàn giao sử dụng:</strong> Hướng dẫn sử dụng và bảo quản</li>
                    </ol>',
                'content_price' => '<h3>Bảng giá thi công nội thất</h3>
                    <table class="table table-bordered">
                        <tr><th>Hạng mục</th><th>Đơn giá (VNĐ/m²)</th><th>Chất liệu</th></tr>
                        <tr><td>Tủ bếp gỗ công nghiệp</td><td>8.000.000 - 12.000.000</td><td>MDF phủ Melamine</td></tr>
                        <tr><td>Tủ bếp gỗ tự nhiên</td><td>15.000.000 - 25.000.000</td><td>Gỗ sồi, gỗ xoan</td></tr>
                        <tr><td>Tủ quần áo</td><td>6.000.000 - 10.000.000</td><td>Tùy kích thước</td></tr>
                        <tr><td>Giường ngủ + tủ đầu giường</td><td>8.000.000 - 15.000.000</td><td>Bộ phòng ngủ</td></tr>
                        <tr><td>Bàn ghế phòng khách</td><td>10.000.000 - 20.000.000</td><td>Sofa + bàn trà</td></tr>
                    </table>
                    <p><strong>Gói combo:</strong> Giảm 15% khi làm trọn gói nội thất cả nhà</p>'
            ],
            [
                'name' => 'Tư vấn giám sát',
                'slug' => 'tu-van-giam-sat',
                'slogan' => 'Chuyên gia đồng hành - An tâm xây dựng',
                'description' => 'Dịch vụ tư vấn và giám sát thi công chuyên nghiệp, đảm bảo chất lượng và tiến độ công trình.',
                'image' => '/assets/img/services/giam-sat.jpg',
                'title_1' => 'Tư vấn kỹ thuật',
                'content_1' => 'Đội ngũ kỹ sư giàu kinh nghiệm tư vấn giải pháp kỹ thuật tối ưu.',
                'title_2' => 'Giám sát chất lượng',
                'content_2' => 'Kiểm tra chất lượng vật liệu và thi công theo đúng tiêu chuẩn kỹ thuật.',
                'title_3' => 'Quản lý tiến độ',
                'content_3' => 'Theo dõi và điều phối tiến độ thi công đảm bảo đúng kế hoạch.',
                'title_4' => 'Báo cáo định kỳ',
                'content_4' => 'Cung cấp báo cáo tiến độ và chất lượng định kỳ cho chủ đầu tư.',
                'content_service' => '<h3>Quy trình tư vấn giám sát</h3>
                    <ol>
                        <li><strong>Nghiên cứu hồ sơ:</strong> Tìm hiểu thiết kế và yêu cầu kỹ thuật</li>
                        <li><strong>Lập kế hoạch:</strong> Xây dựng kế hoạch giám sát chi tiết</li>
                        <li><strong>Giám sát thi công:</strong> Có mặt thường xuyên tại công trình</li>
                        <li><strong>Kiểm tra chất lượng:</strong> Kiểm tra từng công đoạn thi công</li>
                        <li><strong>Xử lý sự cố:</strong> Phát hiện và xử lý kịp thời các vấn đề</li>
                        <li><strong>Báo cáo tiến độ:</strong> Cập nhật tình hình thi công</li>
                        <li><strong>Nghiệm thu công trình:</strong> Tham gia nghiệm thu cuối cùng</li>
                    </ol>',
                'content_price' => '<h3>Bảng giá tư vấn giám sát</h3>
                    <table class="table table-bordered">
                        <tr><th>Dịch vụ</th><th>Đơn giá</th><th>Thời gian</th></tr>
                        <tr><td>Tư vấn thiết kế</td><td>2-3% tổng giá trị</td><td>Theo dự án</td></tr>
                        <tr><td>Giám sát thi công</td><td>3-5% tổng giá trị</td><td>Suốt quá trình</td></tr>
                        <tr><td>Tư vấn một lần</td><td>500.000 - 1.000.000/lần</td><td>2-4 giờ</td></tr>
                        <tr><td>Kiểm tra chất lượng</td><td>300.000 - 500.000/lần</td><td>1-2 giờ</td></tr>
                        <tr><td>Gói tư vấn toàn diện</td><td>5-8% tổng giá trị</td><td>Từ đầu đến cuối</td></tr>
                    </table>
                    <p><strong>Cam kết:</strong> Hoàn tiền 100% nếu không hài lòng về chất lượng dịch vụ</p>'
            ]
        ];

        Service::insert($services);
    }
}
