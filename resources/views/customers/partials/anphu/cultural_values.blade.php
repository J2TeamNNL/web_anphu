@push('styles')
<style>
    .culture-wrapper {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 2rem;
    }

    /* Sidebar mục lục */
    .culture-toc {
        position: sticky;
        top: 100px;
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        height: fit-content;
    }

    .culture-toc h5 {
        font-size: 1rem;
        margin-bottom: 0.75rem;
        font-weight: 600;
        color: #0d6efd;
    }

    .culture-toc ul {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .culture-toc li {
        margin-bottom: 0.5rem;
    }

    .culture-toc a {
        text-decoration: none;
        color: #333;
        font-size: 0.95rem;
        transition: color 0.2s;
    }

    .culture-toc a:hover,
    .culture-toc a.active {
        color: #0d6efd;
        font-weight: 500;
    }

    /* Nội dung */
    .culture-content {
        padding: 2rem;
        background-color: #fff;
        border-left: 4px solid #0d6efd;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-radius: 6px;
        animation: fadeInUp 0.6s ease;
    }

    .culture-content p {
        font-size: 1.05rem;
        line-height: 1.75;
        margin-bottom: 1rem;
    }

    .culture-content h1, .culture-content h2, .culture-content h3 {
        margin-top: 1.5rem;
        color: #030a36;
        font-weight: 600;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .culture-wrapper {
            grid-template-columns: 1fr;
        }
        .culture-toc {
            position: static;
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

<div class="container my-4 culture-wrapper">
    <!-- Sidebar mục lục -->
    <aside class="culture-toc">
        <h5>Mục lục</h5>
        <ul id="culture-toc-list"></ul>
    </aside>

    <!-- Nội dung -->
    <div class="culture-content mb-4" id="culture-content">
        <section class="py-5" style="background-color: #fff;">
            <div class="container">
                <!-- Định hướng -->
                <h2 class="fw-bold text-uppercase mb-4" style="color:#030a36;">Định Hướng Quản Lý Và Phát Triển</h2>

                <!-- Tầm nhìn -->
                <h4 class="fw-bold text-uppercase" style="color:#C9B037;">Tầm Nhìn Dài Hạn</h4>
                <ul>
                    <li>Cung cấp các giải pháp xây dựng nhà phố và biệt thự theo <strong>TIÊU CHUẨN NHẤT</strong>, <strong>GIÁ VIỆT NAM</strong> cho khách hàng tại Việt Nam.</li>
                    <li>Các nhân viên công ty ngày càng phát triển về sự nghiệp, giàu có về vật chất và tinh thần.</li>
                </ul>

                <!-- Sứ mệnh -->
                <h4 class="fw-bold text-uppercase mt-4" style="color:#C9B037;">Sứ Mệnh</h4>
                <p>Sứ mệnh của chúng tôi là: <strong>“Xây dựng ngôi nhà thoáng, sáng, mát và năng lượng cao”</strong>.</p>

                <!-- Giá trị cốt lõi -->
                <h4 class="fw-bold text-uppercase mt-4" style="color:#C9B037;">Giá Trị Cốt Lõi</h4>

                <div class="mb-3">
                    <h5 class="fw-bold" style="color:#181f2f;">An Toàn Để Hạnh Phúc <span class="text-muted">(Quan trọng nhất)</span></h5>
                    <ul>
                        <li>Trang bị đầy đủ kiến thức, phương tiện để tự bảo vệ an toàn cho cá nhân và người xung quanh.</li>
                        <li>Thực hiện các quy định, nội quy công ty đưa ra và tuân thủ biện pháp an toàn lao động.</li>
                        <li>Dự đoán, ngăn chặn nguy cơ trực tiếp gây mất an toàn và hành vi vi phạm quy định an toàn.</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="fw-bold" style="color:#181f2f;">Tuân Thủ Quy Trình</h5>
                    <ul>
                        <li>Hiểu và thực hiện quy trình công ty đưa ra một cách chủ động.</li>
                        <li>Kiểm tra thường xuyên để đảm bảo chất lượng và tiến độ.</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="fw-bold" style="color:#181f2f;">Chủ Động Vì Thành Công Của Mình</h5>
                    <ul>
                        <li>Dự đoán trước vấn đề và lập kế hoạch hành động cụ thể.</li>
                        <li>Tiên phong, không e dè với điều mới.</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="fw-bold" style="color:#181f2f;">Chính Trực</h5>
                    <ul>
                        <li>Nói điều thật, làm điều thật.</li>
                        <li>Nhất quán giữa lời nói và hành động.</li>
                        <li>Đảm bảo đúng hoặc cao hơn cam kết với khách hàng.</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="fw-bold" style="color:#181f2f;">Biết Ơn</h5>
                    <ul>
                        <li>Luôn thể hiện sự biết ơn với đồng đội, khách hàng, đối tác từ những việc nhỏ nhất.</li>
                    </ul>
                </div>

                <!-- Năng lực lõi -->
                <h4 class="fw-bold text-uppercase mt-4" style="color:#C9B037;">Năng Lực Lõi</h4>
                <ul>
                    <li><strong>24/7 Tương Tác:</strong> Phản hồi trong 5 phút, xử lý vấn đề trong 24h, linh hoạt ngoài chuyên môn.</li>
                    <li><strong>Nhất Quán Về Chất Lượng:</strong> 100% công trình có sổ tay, 90% đạt chất lượng như nhau, 95% không thấm sau 2 năm.</li>
                    <li><strong>Am Hiểu Pháp Lý:</strong> Cập nhật quy hoạch, tuân thủ GPXD, xử lý đúng luật.</li>
                    <li><strong>Rõ Ràng Minh Bạch:</strong> Minh bạch báo giá, ký hợp đồng trước khi cung cấp vật tư, quyết toán theo thực tế.</li>
                </ul>

                <!-- Chuẩn mực -->
                <h4 class="fw-bold text-uppercase mt-4" style="color:#C9B037;">Chuẩn Mực Phục Vụ Khách Hàng</h4>

                <div class="mb-3">
                    <h5 class="fw-bold" style="color:#030a36;">Chủ Động Gặp Mặt</h5>
                    <ul>
                        <li>Lập kế hoạch gặp trực tiếp khách hàng.</li>
                        <li>Gửi lời mời chi tiết về thời gian, địa điểm, nội dung.</li>
                        <li>Chuẩn bị đầy đủ thông tin và tài liệu liên quan.</li>
                    </ul>
                </div>

                <div class="mb-3">
                    <h5 class="fw-bold" style="color:#030a36;">Hỏi Rõ Mong Muốn</h5>
                    <ul>
                        <li>Đặt câu hỏi mở để khách hàng nói ra mong muốn.</li>
                        <li>Lắng nghe và đặt câu hỏi để làm rõ nhu cầu.</li>
                        <li>Xác nhận và tổng hợp thông tin.</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("culture-content");
    const tocList = document.getElementById("culture-toc-list");

    // Danh sách tiêu đề cần lấy
    const targetTitles = [
        "Tầm Nhìn Dài Hạn",
        "Giá Trị Cốt Lõi",
        "Năng Lực Lõi",
        "Chuẩn Mực Phục Vụ Khách Hàng"
    ];

    // Tìm tất cả h4, lọc theo tiêu đề
    const headings = Array.from(content.querySelectorAll("h4"))
        .filter(h => targetTitles.includes(h.textContent.trim()));

    // Tạo mục lục
    headings.forEach((heading, index) => {
        const id = "section-" + index;
        heading.id = id;

        const li = document.createElement("li");
        const a = document.createElement("a");
        a.href = "#" + id;
        a.textContent = heading.textContent.trim();
        a.classList.add("toc-link");

        li.appendChild(a);
        tocList.appendChild(li);
    });

    // Highlight mục lục khi cuộn
    const tocLinks = document.querySelectorAll(".toc-link");
    window.addEventListener("scroll", () => {
        let fromTop = window.scrollY + 120;
        tocLinks.forEach(link => {
            const section = document.querySelector(link.hash);
            if (
                section.offsetTop <= fromTop &&
                section.offsetTop + section.offsetHeight > fromTop
            ) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    });
});
</script>
@endpush

