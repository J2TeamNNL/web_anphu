@extends('customers.layouts.master')

@section('content')

    {{-- THƯ NGỎ --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-aos="fade-right">
                    <h4 class="text-uppercase text-primary font-weight-bold">Thư ngỏ</h4>
                    <hr class="border-warning">

                    <p class="font-weight-bold text-uppercase">Chào mừng bạn đến với {{ $companySettings->company_brand ?? 'An Phú' }}</p>

                    <p>
                        Kính gửi quý khách hàng, quý đối tác cùng toàn thể cán bộ nhân viên đã và đang đồng hành cùng 
                        {{ $companySettings->company_brand ?? 'An Phú' }} trong suốt chặng đường hình thành và phát triển.
                    </p>

                    <p>
                        Cảm ơn bạn đã dành thời gian đọc những dòng chia sẻ này – câu chuyện về hành trình, tâm huyết và lý tưởng đã dẫn dắt tôi và tập thể 
                        {{ $companySettings->company_brand ?? 'An Phú' }} trở thành một đơn vị thiết kế &amp; xây dựng trọn gói uy tín như hôm nay.
                    </p>

                    <p>
                        Trong cuộc sống, đôi khi phải có “duyên” thì những con người xa lạ mới có thể gặp gỡ, trò chuyện và đồng hành. 
                        Khi bạn biết đến {{ $companySettings->company_brand ?? 'An Phú' }} và đọc được những dòng chữ này, tôi tin rằng giữa chúng ta đã có một mối duyên lành. 
                        Và chính vì thế, tôi càng trân trọng hơn cơ hội được chia sẻ, được lắng nghe và được phục vụ bạn – những người đã tin tưởng, lựa chọn và gắn bó với 
                        {{ $companySettings->company_brand ?? 'An Phú' }}.
                    </p>

                    <h5 class="mt-4 font-weight-bold">Chuyện của một kiến trúc sư đam mê tạo dựng những ngôi nhà đẹp và bền vững</h5>
                    <p>
                        Tên tôi là <span class="font-weight-bold">{{ $companySettings->director ?? 'Phạm Đăng Thu' }}</span>, sinh ra và lớn lên tại Hà Nội, nơi đã nuôi dưỡng tình yêu với kiến trúc, công trình và những giá trị bền vững. 
                        Tốt nghiệp ngành xây dựng, tôi có cơ hội làm việc sớm tại các công trình thực tế, trực tiếp tham gia giám sát, thi công và cải tiến kỹ thuật. 
                        Chính quá trình này giúp tôi hiểu sâu hơn rằng: một ngôi nhà đẹp không chỉ ở hình thức, mà còn ở sự chắc chắn, công năng hợp lý và cảm giác an yên cho người ở.
                    </p>

                    <p>
                        Bên cạnh công việc, tôi cũng ý thức sâu sắc trách nhiệm của mình – vừa là người chồng, người cha, vừa là người kỹ sư mang đến những giá trị thật cho xã hội, vừa là người làm kinh doanh minh bạch, lấy uy tín làm nền tảng.
                    </p>

                    <p>
                        Trong quá trình làm nghề, tôi nhận ra rất nhiều gia đình gặp khó khăn khi chuẩn bị xây nhà: lo lắng về chi phí, phân vân trong lựa chọn thiết kế, hoặc dễ mắc sai lầm khi tin vào những lời báo giá rẻ nhưng chất lượng thi công kém. 
                        Có những công trình vừa hoàn thiện đã xuống cấp, hoặc thi công bị bỏ dở vì nhà thầu thiếu trách nhiệm. 
                        Tôi hiểu rằng, mình cần phải tạo ra một giải pháp toàn diện, giúp mọi người có thể xây dựng tổ ấm một cách trọn vẹn, an toàn và bền lâu.
                    </p>

                    <h5 class="mt-4 font-weight-bold">{{ $companySettings->company_brand ?? 'An Phú' }} – Giải pháp trọn gói cho ngôi nhà mơ ước của bạn</h5>
                    <p>
                        Với khát khao đó, {{ $companySettings->company_brand ?? 'An Phú' }} ra đời như một người bạn đồng hành tận tâm, mang đến dịch vụ thiết kế &amp; thi công nhà trọn gói từ A–Z. 
                        Chúng tôi hội tụ đội ngũ kiến trúc sư và kỹ sư giàu kinh nghiệm, luôn tư vấn giải pháp tối ưu nhất, phù hợp với ngân sách và mong muốn của gia chủ.
                    </p>

                    <ul>
                        <li>Tư vấn tận tình, rõ ràng và minh bạch.</li>
                        <li>Sở hữu ngôi nhà không chỉ đẹp về thẩm mỹ mà còn thông thoáng, hợp phong thủy, bền vững theo thời gian.</li>
                        <li>Trải nghiệm quy trình thi công khoa học, đúng tiến độ và đảm bảo chất lượng.</li>
                    </ul>

                    <p>
                        Chúng tôi tin rằng, mỗi ngôi nhà được {{ $companySettings->company_brand ?? 'An Phú' }} xây dựng không chỉ là công trình, 
                        mà là nơi nuôi dưỡng hạnh phúc và gắn kết yêu thương.
                    </p>

                    <p class="mt-4 mb-0">
                        Trân trọng,<br>
                        <span class="font-weight-bold">{{ $companySettings->director ?? 'Phạm Đăng Thu' }}</span><br>
                        Giám đốc Công ty Thiết kế &amp; Xây dựng {{ $companySettings->company_brand ?? 'An Phú' }}
                    </p>
                </div>
            </div>
        </div>
    </section>


    @include('customers.partials.sign_up_1')

    @include('customers.partials.anphu.demo_projects')
    @include('customers.partials.anphu.partner')
@endsection

