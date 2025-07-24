<tr>
    <td>{{ $category->id }}</td>
    <td>{!! str_repeat('&mdash;', $level * 4) !!} {{ $category->name }}</td>
    <td>{{ $category->slug }}</td>
    <td>
        {{ $category->parent ? $category->parent->name : 'Cấp 1' }}
    </td>
    <td>{{ $category->category_for }}</td>
    <td>
        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Sửa</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn xoá?')">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Xoá</button>
        </form>
    </td>
</tr>

@if ($category->children)
    @foreach ($category->children as $child)
        @include('categories.partials.category_row', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
