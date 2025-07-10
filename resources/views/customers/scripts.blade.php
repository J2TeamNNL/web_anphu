<!-- JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

{{-- ANPHU COMMITMENT --}}
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


<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800, // thời gian chạy hiệu ứng (ms)
    once: true     // chỉ chạy hiệu ứng một lần
  });
</script>

<!-- Smooth Scroll for Anchor Links -->
<script>
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth'
      });
    }
  });
});
</script>

{{-- ISOTOPE --}}
@stack('scripts_isotope_project')
