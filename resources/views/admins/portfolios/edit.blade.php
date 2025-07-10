<div>
   <a href="{{ route('portfolios.index') }}" class="btn btn-primary">Quản lý các dự án</a>
</div>
<div class="col-md-12">
   <div class="card card-plain">
      <div class="card-header">
         <h4 class="card-title">Thêm Dự Án</h4>
      </div>
      <div class="card-body">
         <form action="{{ route('portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
               <label for="name">Tên dự án</label>
               <input type="text" name="name" id="name" class="form-control" value="{{ $portfolio->name }}" required>
            </div>

            <div class="form-group">
               <label for="location">Địa điểm</label>
               <input type="text" name="location" id="location" class="form-control" value="{{ $portfolio->location }}" required>
            </div>

            <div class="form-group">
               <label for="client">Khách hàng</label>
               <input type="text" name="client" id="client" class="form-control" value="{{ $portfolio->client }}" required>
            </div>

            <div class="form-group">
               <label for="image">Giữa anh chính cũ</label>
               <img src="{{ asset('storage/' . $portfolio->image) }}" width="200px">
               <input type="hidden" name="image_old" value="{{ $portfolio->image }}">
            </div>

            <div>
               <label for="image_new">Thay ảnh chính (tùy chọn)</label>
               <input type="file" name="image_new" id="image_new">
            </div>

            <div class="form-group">
               <label for="description">Mô tả</label>
               <textarea name="description" id="description" rows="3" class="form-control">{{ $portfolio->description }}</textarea>
            </div>

            <div class="form-group">
               <label for="year">Năm thực hiện</label>
               <input type="number" name="year" id="year" class="form-control" value="{{ $portfolio->year }}" required>
            </div>

            <div class="form-group">
               <label for="type">Loại hình công trình</label>
               <select name="type" id="type" class="form-control" value="{{ $portfolio->type }}" required>
                  <option value="">-- Chọn loại --</option>
                  @foreach ($types as $type)
                     <option value="{{ $type }}"
                     @if($portfolio->type == $type) selected @endif
                     >{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
                  @endforeach
               </select>
            </div>

            <div class="form-group">
               <label for="category">Phân danh mục</label>
               <select name="category" id="category" class="form-control" required>
                  <option value="">-- Chọn danh mục --</option>
                  {{-- RENDER OPTION HERE --}}
               </select>
            </div>

            <div class="form-group text-right">
               <button type="submit" class="btn btn-warning font-weight-bold">Cập nhập dự án</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script>
   const categories = @json($categories); 
   const selectedType = "{{ $portfolio->type }}";
   const selectedCategory = "{{ $portfolio->category }}";

   const typeSelect = document.getElementById('type');
   const categorySelect = document.getElementById('category');

   // Render category list theo type khi trang load
   function renderCategories(type) {
      categorySelect.innerHTML = '<option value="">-- Chọn danh mục --</option>';

      if (categories[type]) {
         categories[type].forEach(function (cat) {
            const option = document.createElement('option');
            option.value = cat;
            option.textContent = cat.charAt(0).toUpperCase() + cat.slice(1);
            if (cat === selectedCategory) {
               option.selected = true;
            }
            categorySelect.appendChild(option);
         });
      }
   }

   // Khi thay đổi type, render lại categories
   typeSelect.addEventListener('change', function () {
      renderCategories(this.value);
   });

   // Gọi khi trang load
   window.addEventListener('DOMContentLoaded', () => {
      renderCategories(selectedType);
   });
</script>
