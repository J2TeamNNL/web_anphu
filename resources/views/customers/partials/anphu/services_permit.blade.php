<section class="bg-light py-5">
   <div class="container">
      <div class="text-center mb-5">
         <h5 class="text-primary font-weight-bold">DỊCH VỤ PHÁP LÝ XÂY DỰNG</h5>
         <h2 class="font-weight-bold">Dịch vụ tư vấn chuẩn xác, thực hiện <span class="text-warning">minh bạch</span> chi phí tối ưu</h2>
         <p class="text-dark">
            Vấn đề pháp lí trong xây dựng là một trong những vấn đề quan trọng để bắt đầu thiết kế, thi công. Chúng tôi mang lại các giải pháp trọn gói từ khâu tư vấn thông tin đến thực hiện thủ tục xin phép và hoàn công công trình xây dụng nhằm giúp gia chủ làm '' đúng ngay từ đầu'' - tiết kiệm thời gian, công sức và chi phí
         </p>
      </div>

      <div class="row justify-content-center">
         @php
            $permits = [
               [
                  'title' => 'Kiểm tra quy hoạch',
                  'icon' => 'ic_permit_architect.webp',
                  'list' => [
                     'Xác định vị trí cụ thể',
                     'Thu thập tài liệu quy hoạch chuẩn pháp lý',
                     'Đánh giá quy hoạch hiện tại',
                     'Kiểm tra giấy phép xây dựng'
                  ]
               ],
               [
                  'title' => 'Xin phép xây dựng mới',
                  'icon' => 'ic_permit_build.webp',
                  'list' => [
                     'Triển khai Hồ sơ bản vẽ cấp phép xây dựng',
                     'Liên hệ với cơ quản pháp chế xây dựng theo từng khu vực',
                     'Chuẩn bị Bộ hồ sơ cấp phép xây dựng',
                     'Nộp - Theo dõi - Nhận kết quả hồ sơ cấp phép'
                  ]
               ],
               [
                  'title' => 'Xin phép sửa chữa cải tạo',
                  'icon' => 'ic_permit_repair.webp',
                  'list' => [
                     'Hồ sơ bản vẽ Cải tạo sửa chữa',
                     'Bám sát loại hình kết cấu xin cải tạo',
                     'Hồ sơ xin phép Cải tạo công trình',
                     'Nộp hồ sơ tại cơ quan pháp chế theo từng địa phương',
                  ]
               ],
               [
                  'title' => 'Hoàn công cho công trình',
                  'icon' => 'ic_permit_task.webp',
                  'list' => [
                     'Thông báo với cơ quan quản lý địa phương',
                     'Xác định phạm vi hoàn cống',
                     'Tập hợp tài liệu liên quan',
                     'Tiến hành kiểm tra hoàn công',
                     'Nộp hồ sơ tại cơ quan pháp chế theo từng địa phương'
                  ]
               ]
            ];
         @endphp

         @foreach ($permits as $permit)
         <div class="col-lg-5 col-md-6 mb-5 d-flex">
            <div class="card card-service shadow rounded p-4 position-relative d-flex flex-column w-100">

               <!-- Icon nổi -->
               <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                  <img src="{{ asset('assets/img/icon/' . $permit['icon']) }}" alt="Icon" style="height: 50px;">
               </div>

               <!-- Tiêu đề & mô tả -->
               <h5 class="font-weight-bold mt-4 text-primary">{{ $permit['title'] }}</h5>
               <ul class="text-dark pl-3 mt-2 mb-0">
                  @foreach ($permit['list'] as $item)
                     <li>{{ $item }}</li>
                  @endforeach
               </ul>
            </div>
         </div>
         @endforeach
      </div>
   </div>
</section>