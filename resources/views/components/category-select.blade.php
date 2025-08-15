@props([
    'name' => 'category_id',
    'id' => 'category_id',
    'label' => '',
    'placeholder' => '-- Chọn danh mục --',
    'categories' => [],
    'selected' => null,
    'showChildren' => true,
    'useOptgroup' => false,
    'childrenOnly' => false,
    'class' => 'form-control',
    'required' => false
])

@php
    // Determine selected value based on different sources
    $selectedValue = $selected ?? old($name) ?? request($name);
@endphp

<div class="form-group">
    @if($label)
        <h5 for="{{ $id }}">{{ $label }}</h5>
    @endif
    
    <select 
        name="{{ $name }}" 
        id="{{ $id }}" 
        class="{{ $class }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
        <option value="">{{ $placeholder }}</option>
        
        @foreach ($categories as $category)
            @if($useOptgroup && $showChildren && $category->children->isNotEmpty())
                {{-- Use optgroup style (for portfolios) --}}
                <optgroup label="{{ $category->name }}">
                    @foreach ($category->children as $child)
                        <option value="{{ $child->id }}" 
                            {{ $selectedValue == $child->id ? 'selected' : '' }}>
                            {{ $child->name }}
                        </option>
                    @endforeach
                </optgroup>
            @else
                {{-- Standard style --}}
                @if(!$childrenOnly)
                    {{-- Show parent category --}}
                    <option value="{{ $category->id }}" 
                        {{ $selectedValue == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endif
                
                @if($showChildren && $category->children->isNotEmpty())
                    {{-- Show children with prefix --}}
                    @foreach ($category->children as $child)
                        <option value="{{ $child->id }}" 
                            {{ $selectedValue == $child->id ? 'selected' : '' }}>
                            — {{ $child->name }}
                        </option>
                    @endforeach
                @endif
            @endif
        @endforeach
    </select>
</div>
