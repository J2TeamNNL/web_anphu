<option value="{{ $category->id }}">
    {{ $prefix }}{{ $category->name }}
</option>

@if ($category->children->isNotEmpty())
    @foreach ($category->children as $child)
        @include('components.category-option', ['category' => $child, 'prefix' => $prefix . '— '])
    @endforeach
@endif
