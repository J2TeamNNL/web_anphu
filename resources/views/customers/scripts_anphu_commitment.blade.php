@push('scripts_anphu_commitment')
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