@push('scripts_isotope_blog')
<script>
    $(document).ready(function () {
        var $grid = $('.blog-grid').isotope({
            itemSelector: '.blog-item',
            layoutMode: 'fitRows'
        });

        $('.filter-button').on('click', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });

            $('.filter-button').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
@endpush
