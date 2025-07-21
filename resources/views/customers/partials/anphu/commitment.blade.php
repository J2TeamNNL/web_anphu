<!-- Hero Section -->
<section class="hero-static-slider py-5" id="hero-static-slider">
    <div class="container position-relative text-white">
        <div class="slide-content-box show p-4 rounded" id="slide-content-box" style="background-color: rgba(0,0,0,0.6);">

            <!-- Nút chọn slide -->
            <div class="slide-buttons mt-3 mb-3 d-flex flex-wrap gap-2">
                <button class="btn btn-light btn-slide active" data-slide="1">Minh bạch, Uy tín</button>
                <button class="btn btn-light btn-slide" data-slide="2">Chất lượng</button>
            </div>

            <!-- Nội dung slide -->
            <div id="slide-content" class="bg-hover bg-opacity-50 rounded p-3 p-md-4 w-100 max-w-100"></div>

            <!-- Templates -->
            <template id="template-slide-1">
                <div class="text-content">
                    <h2 class="h5 h3-md mb-3">Cam kết về chất lượng và tiến độ ngay trong hợp đồng</h2>
                    <ul class="spaced-list small">
                        <li>Cam kết đúng chủng loại vật tư vật liệu, nếu phát hiện sai <span class="font-weight-bold text-warning">đền 300%</span></li>
                        <li>Cam kết về tiến độ, nếu <span class="font-weight-bold text-warning">chậm tiến độ đền 1 triệu/ ngày</span></li>
                        <li>Cam kết về bảo hành bảo trì <span class="font-weight-bold text-warning">5 năm với phụ kiện chính hãng</span>, 1 năm với tổng thể chung</li>
                        <li>Quá trình thi công gồm 3 lớp giám sát: Hiện trường (24/7) - Giám sát thiết kế - Giám sát tổng dự án</li>
                        <li>Luôn hỗ trợ khách hàng về <span class="font-weight-bold text-warning">quy trình pháp lý</span>, <span class="font-weight-bold text-warning">điều kiện P.C.C.C</span> theo QC mới nhất </li>
                    </ul>
                </div>
            </template>

            <template id="template-slide-2">
                <div class="text-content">
                    <h2 class="h5 h3-md mb-3">Thiết Kế Nhanh – Đẹp – Chuẩn Pháp Lý</h2>
                    <ul class="spaced-list small">
                        <li>Tiến độ hồ sơ thiết kế rõ ràng, linh hoạt và <span class="font-weight-bold text-warning">nhanh chóng (7-10 ngày)</span></li>
                        <li>Đội ngũ thiết kế chuyên nghiệp <span class="font-weight-bold text-warning">chất lượng cao</span> từ các trường hàng đầu như <span class="font-weight-bold text-warning">ĐH Kiến trúc Hà Nội</span>, <span class="font-weight-bold text-warning">ĐH Xây Dựng Hà Nội</span></li>
                        <li>
                            Áp dụng bản vẽ 2D, mô hình IFC 3D, <span class="font-weight-bold text-warning">có thể xem trên điện thoại</span><br>
                            <span class="font-weight-bold text-warning">Tích hợp công nghệ VR</span> giúp khách trải nghiệm ngôi nhà trước khi thi công
                        </li>
                    </ul>
                </div>
            </template>
        </div>
    </div>
</section>
    
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.btn-slide');
        const slideContent = document.getElementById('slide-content');
        const heroSection = document.getElementById('hero-static-slider');

        const backgrounds = {
            1: '{{ asset('assets/img/gallery/scadinavian1.jpg') }}',
            2: '{{ asset('assets/img/gallery/scadinavian2.jpg') }}',
        };

        function loadSlide(slideNum) {
            const template = document.getElementById(`template-slide-${slideNum}`);
            const bg = backgrounds[slideNum];

            if (template) {
                slideContent.innerHTML = template.innerHTML;
            }

            if (bg) {
                heroSection.style.backgroundImage = `url('${bg}')`;
            }

            buttons.forEach(b => b.classList.remove('active'));
            const activeBtn = document.querySelector(`.btn-slide[data-slide="${slideNum}"]`);
            if (activeBtn) activeBtn.classList.add('active');
        }

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const slideNum = btn.getAttribute('data-slide');
                loadSlide(slideNum);
            });
        });

        // Mặc định slide 1
        loadSlide(1);
    });
</script>
@endpush