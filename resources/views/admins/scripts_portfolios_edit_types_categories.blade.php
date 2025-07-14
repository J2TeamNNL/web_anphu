@push('scripts_portfolios_edit_types_categories')
   <script>
      const categories = @json($categories); 
      const selectedType = "{{ $portfolio->type }}";
      const selectedCategory = "{{ $portfolio->category }}";

      const typeSelect = document.getElementById('type');
      const categorySelect = document.getElementById('category');

      function renderCategories(type) {
         categorySelect.innerHTML = '<option value="">-- Chọn danh mục --</option>';

         if (categories[type]) {
            Object.entries(categories[type]).forEach(([key, label]) => {
               const option = document.createElement('option');
               option.value = key;
               option.textContent = label;
               if (key === selectedCategory) {
                  option.selected = true;
               }
               categorySelect.appendChild(option);
            });
         }
      }

      typeSelect.addEventListener('change', function () {
         renderCategories(this.value);
      });

      window.addEventListener('DOMContentLoaded', () => {
         renderCategories(selectedType);
      });
   </script>
@endpush
