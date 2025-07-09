<section class="bg-light py-5">
   <div class="container">
      <div class="text-center mb-5">
         <h5 class="text-primary font-weight-bold">HOÀN CÔNG XÂY DỰNG</h5>
         <h2 class="font-weight-bold">
            Giải pháp toàn diện từ khởi đầu đến hoàn thành
         </h2>
         <p class="text-muted">
            Tổ chức thi công đạt tiêu chuẩn chất lượng, tiến độ, an toàn với đội ngũ kĩ sư nhiều kinh nghiệm, công nhân lành nghề và trang thiết bị máy móc đầy đủng.
         </p>
      </div>

      <div class="row">
         @php
            $constructions = [
               [
                  'title' => 'Thi công phần thô & nhân công hoàn thiện tiêu chuẩn',
                  'icon' => 'ic_construction_1.webp',
                  'desc' =>'
                     Cung cấp vật tư phần thô( bao gồm: Sắt, gạch, cát, đá, xi măng, vật tư điện nước âm tường...) cung cấp thiết bị + nhân công để thi công phần thô. Cung cấp nhân công phần hoàn thiện xây dựng: công tác ốp lát, công tác sơn, chống thấm Cam kết chính sách tiêu chuẩn.
                  ',
               ],
               [
                  'title' => 'Thi công phần khung bê tông cốt thép thô',
                  'icon' => 'ic_construction_2.webp',
                  'desc' =>'
                     Cung cấp vật tư phần thô( bao gồm: Sắt, gạch, cát, đá, xi măng, vật tư điện nước âm tường...) cung cấp thiết bị + nhân công để thi công phần thô
                  ',
               ],
               [
                  'title' => 'Thi công phần thô & nhân công hoàn thiện cao cấp',
                  'icon' => 'ic_construction_3.webp',
                  'desc' =>'
                     Cung cấp vật tư phần thô( bao gồm: Sắt, gạch, cát, đá, xi măng, vật tư điện nước âm tường...) cung cấp thiết bị + nhân công để thi công phần thô. Cung cấp nhân công phần hoàn thiện xây dựng: công tác ốp lát, công tác sơn, chống thấm Cam kết chính sách cao cấp vượt trội
                  ',
               ],
               [
                  'title' => 'Thi công hạng mục riêng lẻ công trình',
                  'icon' => 'ic_construction_4.webp',
                  'desc' =>'
                     Thi công tùy chọn, một hoặc nhiều hạng mục tích hợp như phần thô, hoàn thiện nội thất, cảnh quan sân vườn, nhà thông minh smart home, điện năng lượng mặt trời, không gian gym, xông hơi, spa, giải trí,... cho chủ đầu tư Các hạng mục bao gồm cung cấp vật tư, thiết bị và nhân công thi công.
                  ',
               ]
            ];
         @endphp

         @foreach ($constructions as $construction)
         <div class="col-lg-4 col-md-6 mb-5 d-flex">
            <div class="card border-0 shadow rounded p-4 position-relative d-flex flex-column w-100">

               <!-- Icon nổi -->
               <div class="icon-circle-2 position-absolute d-flex align-items-center justify-content-center">
                  <img src="{{ asset('assets/img/icon/' . $construction['icon']) }}" alt="Icon" style="height: 50px;">
               </div>

               <!-- Tiêu đề & mô tả -->
               <h5 class="font-weight-bold mt-4">{{ $construction['title'] }}</h5>
               <p>
                  {{ $construction['desc'] }}
               </p>
            </div>
      </div>
      @endforeach
   </div>
   </div>
</section>