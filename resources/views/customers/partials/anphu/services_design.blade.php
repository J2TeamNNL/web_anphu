<section class="bg-light py-5">
   <div class="container">
      <div class="text-center mb-5">
         <h5 class="text-primary font-weight-bold">GIẢI PHÁP THIẾT KẾ</h5>
         <h2 class="font-weight-bold">
            Đồng bộ và tối ưu giá trị công năng - thẩm mỹ, đảm bảo chi phí tối ưu
         </h2>
      </div>

      <div class="row justify-content-center">
         @php
            $designs = [
               [
                  'title' => 'Thiết kế kiến trúc',
                  'icon' => 'ic_design_architect.webp',
                  'desc' =>'
                     Giải pháp thiết kế kiến trúc đáp ứng nhu cầu đa dạng về phong cách và ngân sách. Các thiết kế chú tâm nâng cấp thẩm mỹ kiến trúc và vẻ đẹp cá nhân hóa.
                  ',
               ],
               [
                  'title' => 'Thiết kế nội thất',
                  'icon' => 'ic_design_interior.webp',
                  'desc' =>'
                     Giải pháp thiết kế nội thất nâng tầm không gian sống, hài hòa với thẩm mỹ kiến trúc và đa dạng ngân sách. Giúp gia chủ sở hữu một không gian đẹp và đáng sống.
                  ',
               ],
               [
                  'title' => 'Thiết kế Kết cấu - Cơ điện',
                  'icon' => 'ic_design_mep.webp',
                  'desc' =>'
                     Giải pháp thiết kế kết cấu an toàn, bền vững. Và thiết kế hệ thống điện, cấp thoát nước, an ninh, chống sét tiếp địa chỉnh chu, đồng bộ.
                  ',
               ],
               [
                  'title' => 'Thiết kế hạng mục phụ',
                  'icon' => 'ic_design_miscel.webp',
                  'desc' =>'
                     Giải pháp thiết kế đa dạng và tích hợp các tiện ích phụ phục vụ không gian sống như cổng rào, sân vườn, hồ bơi, thang máy, phòng giải trí, phòng xông hơi…
                  ',
               ]
            ];
         @endphp

         @foreach ($designs as $design)
         <div class="col-lg-5 col-md-6 mb-5 d-flex">
            <div class="card card-service shadow rounded p-4 position-relative d-flex flex-column w-100">

               <!-- Icon nổi -->
               <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                  <img src="{{ asset('assets/img/icon/' . $design['icon']) }}" alt="Icon" style="height: 50px;">
               </div>

               <!-- Tiêu đề & mô tả -->
               <h5 class="font-weight-bold mt-4 text-primary">{{ $design['title'] }}</h5>
               <p>
                  {{ $design['desc'] }}
               </p>
            </div>
      </div>
      @endforeach
   </div>
   </div>
</section>