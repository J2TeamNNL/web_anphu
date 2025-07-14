@push('scripts_portfolios_create_types_categories')
   <script>
      const categories = @json($categories);

      const typeSelect = document.getElementById('type');
      const categorySelect = document.getElementById('category');

      typeSelect.addEventListener('change', function () {
         const selectedType = this.value;

         categorySelect.innerHTML = '<option value="">-- Chọn danh mục --</option>';

         if (categories[selectedType]) {
            Object.entries(categories[selectedType]).forEach(([key, value]) => {
                  const option = document.createElement('option');
                  option.value = key;
                  option.textContent = value;
                  categorySelect.appendChild(option);
            });
         }
      });
   </script>
@endpush
