@push('scripts_isotope_project')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const grid = document.querySelector('.project-grid');
            if (!grid) return;

            const iso = new Isotope(grid, {
                itemSelector: '.project-item',
                layoutMode: 'fitRows'
            });

            const selectedType = @json($selectedType ?? '');

            if (selectedType !== '') {

                iso.arrange({ filter: `.${selectedType}` });

                const defaultButton = document.querySelector('.filter-button[data-filter="*"]');
                if (defaultButton) defaultButton.classList.add('active');
            }

            // Khi người dùng click filter
            document.querySelectorAll('.filter-button').forEach(button => {
                button.addEventListener('click', function () {
                    const filterValue = this.dataset.filter;
                    iso.arrange({ filter: filterValue });

                    document.querySelectorAll('.filter-button').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
@endpush