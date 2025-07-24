<tr>
   <td>{{ $category->id }}</td>
   <td>{{ $category->type->value }}</td>
   <td>{!! str_repeat('&mdash;', $level * 3) !!} {{ $category->name }}</td>
   <td>{{ $category->slug }}</td>
   
   
   <td>
      <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">Sửa</a>
      <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display:inline-block;" 
            onsubmit="return confirm('Bạn có chắc muốn xóa?')">
         @csrf
         @method('DELETE')
         <button class="btn btn-sm btn-danger">Xóa</button>
      </form>
   </td>
</tr>

@foreach ($category->children ?? [] as $child)
    @include('admins.categories.partials.category-row', ['category' => $child, 'level' => $level + 1])
@endforeach
