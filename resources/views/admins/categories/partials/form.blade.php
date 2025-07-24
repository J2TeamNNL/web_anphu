<div class="form-group">
    <label for="type">Loại danh mục</label>
    <select name="type" class="form-control" required>
        <option value="">-- Chọn loại --</option>
        @foreach ($types as $type)
            <option value="{{ $type->value }}"
                {{ old('type', $category->type) === $type->value ? 'selected' : '' }}>
                {{ $type->value }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="name">Tên danh mục</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
</div>

<div class="form-group">
    <label for="parent_id">Danh mục cha</label>
    <select name="parent_id" class="form-control">
        <option value="">-- Không có --</option>
        @foreach ($parentCategories as $parent)
            <option value="{{ $parent->id }}"
                {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
</div>