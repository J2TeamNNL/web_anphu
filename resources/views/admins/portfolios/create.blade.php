<div class="col-md-12">
   <div class="card card-plain">
      <div class="card-header">
         <h4 class="card-title">Thêm Dự Án</h4>
      </div>
      <div class="card-body">
         <form action="{{ route('portfolios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
               <label for="name">Tên dự án</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="location">Địa điểm</label>
               <input type="text" name="location" id="location" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="client">Khách hàng</label>
               <input type="text" name="client" id="client" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="image">Ảnh đại diện</label>
               <input type="file" name="image" id="image" class="form-control-file" required>
            </div>

            <div class="form-group">
               <label for="description">Mô tả</label>
               <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
            </div>

            <div class="form-group">
               <label for="year">Năm thực hiện</label>
               <input type="number" name="year" id="year" class="form-control" required>
            </div>

            <div class="form-group">
               <label for="type">Loại hình công trình</label>
               <select name="type" id="type" class="form-control" required>
                  <option value="">-- Chọn loại --</option>
                  @foreach ($types as $type)
                     <option value="{{ $type }}">{{ ucfirst(str_replace('_', ' ', $type)) }}</option>
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
               <button type="submit" class="btn btn-warning font-weight-bold">Thêm dự án</button>
            </div>
         </form>
      </div>
   </div>
</div>

<script>
    const categories = @json($categories); 

    const typeSelect = document.getElementById('type');
    const categorySelect = document.getElementById('category');

    typeSelect.addEventListener('change', function () {
        const selectedType = this.value;

        categorySelect.innerHTML = '<option value="">-- Chọn danh mục --</option>';

        if (categories[selectedType]) {
            categories[selectedType].forEach(function (cat) {
                const option = document.createElement('option');
                option.value = cat;
                option.textContent = cat.charAt(0).toUpperCase() + cat.slice(1);
                categorySelect.appendChild(option);
            });
        }
    });
</script>
