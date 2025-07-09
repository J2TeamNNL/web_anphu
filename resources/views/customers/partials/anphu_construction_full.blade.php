<section class="bg-light py-5">
   <div class="container">
      <div class="text-center mb-5">
         <h5 class="text-primary font-weight-bold">XÂY NHÀ TRỌN GÓI</h5>
         <h2 class="font-weight-bold">
            Giải pháp toàn diện từ khởi đầu đến hoàn thành
         </h2>
         <p class="text-muted">
            Chủ đầu tư tiết kiệm được chi phí, thời gian, công sức khi tất cả công việc từ thiết kế , thủ tục pháp lý, thi công xây dựng và hoàn thiện nội thất được thực hiện bởi một tổng thầu có đầy đủ năng lực
         </p>
      </div>

      <div class="row justify-content-center">
         @php
            $fullConstructions = [
               [
                  'title' => 'Tư vấn thiết kế, pháp lý',
                  'icon' => 'ic_construction_full_1.webp',
                  'desc' =>'
                     Giải pháp đồng bộ và tối ưu hóa thiết kế kiến trúc, nội thất đến hệ thống kết cấu, điện nước, kĩ thuật liên quan. Kiểm tra và thực hiện các thủ tục pháp lý về xây dựng đảm bảo dự án được thiết kế và triển khai thi công đúng quy định pháp luật.
                  ',
               ],
               [
                  'title' => 'Tiến hành thi công',
                  'icon' => 'ic_construction_full_2.webp',
                  'desc' =>'
                     Thi công xây dựng - hoàn thiện nội thất cam kết đúng chủng loại vật tư, tuân thủ đúng quy trình, tiêu chuẩn kĩ thuật thi công an toàn lao động và vệ sinh môi trường. Đảm bảo dự án triển khai thi công bài bản, chuẩn chất lượng.
                  ',
               ],
               [
                  'title' => 'Tối ưu ngân sách, tiến độ',
                  'icon' => 'ic_construction_full_3.webp',
                  'desc' =>'
                     Tiến độ thi công và ngân sách sẽ được quản lí xuyên suốt và cập nhật định kì hàng tuần cho chủ đầu tư, nhằm kiểm soát chặt chẽ, đảm bảo theo đúng kế hoạch đề ra
                  ',
               ],
               [
                  'title' => 'Bảo trì, bảo hành',
                  'icon' => 'ic_construction_full_4.webp',
                  'desc' =>'
                     Đồng hành xuyên suốt, thực hiện chế độ bảo hành, bảo trì chăm sóc định kì nhằm đảo bảo ngôi nhà luôn trong tình trạng tốt nhất
                  ',
               ]
            ];
         @endphp

         @foreach ($fullConstructions as $fullConstruction)
         <div class="col-lg-5 col-md-6 mb-5 d-flex">
            <div class="card border-0 shadow rounded p-4 position-relative d-flex flex-column w-100">

               <!-- Icon nổi -->
               <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                  <img src="{{ asset('assets/img/icon/' . $fullConstruction['icon']) }}" alt="Icon" style="height: 50px;">
               </div>

               <!-- Tiêu đề & mô tả -->
               <h5 class="font-weight-bold mt-4">{{ $fullConstruction['title'] }}</h5>
               <p>
                  {{ $fullConstruction['desc'] }}
               </p>
            </div>
      </div>
      @endforeach
   </div>
   </div>
</section>