<section class="py-5 bg-white">
    <div class="container">
        <div class="row">
            @php
                $companyName = "An Phú Design";
            @endphp


            <!-- Nội dung -->
            <div class="col-md-8" data-aos="fade-right">
                <h4 class="text-uppercase text-primary font-weight-bold">Giới Thiệu Về An Phú</h4>
                <p><span class="company-name">{{ $companyName }}</span> được thành lập từ kinh nghiệm cũng như mong  muốn của chúng tôi về một doanh nghiệp hàng đầu trong lĩnh vực thi công công trình dân dụng</p>
                <p><span class="company-name">{{ $companyName }}</span> mong muốn tạo ra thật nhiều không gian sống, một không gian lý tưởng để nâng cao chất lượng cuộc sống. Đơn giản chúng tôi tâm niệm rằng: không gian sống không chỉ là nơi để ở mà phải là nơi tận hưởng hạnh phúc của mình.</p>
                <p>Trải qua một thời gian xây dựng và phát triển, <span class="company-name">{{ $companyName }}</span> đã và đang ngày càng trưởng thành. Chúng tôi đã được rất nhiều Chủ đầu tư và các nhà cung cấp lựa chọn để trở thành đối tác chính trong lĩnh vực thi công công trình dân dụng tại Thành Phố Hà Nội và các tỉnh lân cận.</p>
                <p><span class="company-name">{{ $companyName }}</span> luôn tự hào mang đến cho khách hàng những công trình hoàn hảo, chắc bền theo thời gian phù hợp với xu hướng phát triển của Xã hội hiện đại. </p>
                
                <h4 class="text-uppercase text-primary font-weight-bold">Tại sao chọn An phú</h4>
                <p>Tầm nhìn của An Phú là luôn giữ vững sự <span class="slogan">Minh bạch</span>, <span class="slogan">Uy tín</span> và <span class="slogan">Chất lượng công trình</span> trên một thi trường ngày một hiện đại nhưng không kém phần mập mờ về quy trình, giá cả.</p>
                <p>
                    Chiến lược của <span class="company-name">{{ $companyName }}</span> là cung cấp những giải pháp xây dựng nhà theo Tiêu Chuẩn Nhật, Giá Việt Nam cho khách hàng xây nhà tại Việt Nam.
                    Chúng tôi hiểu rằng xây dựng nhà là một quyết định quan trọng và có ý nghĩa lớn đối với mỗi gia đình.
                    Với sự kết hợp giữa chất lượng hàng đầu và giá cả minh bạch,
                    chúng tôi mong muốn đem đến cho khách hàng những giải pháp thiết kế và thi công nhà ở hiệu quả, chi phí hợp lý nhưng vẫn đảm bảo tính thẩm mỹ và bền vững.
                </p>
            </div>

            <!-- Ảnh kỹ sư & Form -->
            <div class="col-md-4" data-aos="fade-left">
                <img src="{{ asset('assets/img/gallery/anphu_architect.jpg') }}" class="img-fluid rounded mb-3" alt="Engineer">
                <div class="bg-light p-3 rounded shadow-sm">
                    <h6 class="font-weight-bold text-center text-uppercase mb-3">Báo giá xây nhà!</h6>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Họ tên">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Diện tích & Số tầng">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block font-weight-bold">Nhận báo giá</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
