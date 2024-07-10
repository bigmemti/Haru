<optgroup label="{!! str_repeat('&nbsp;', $level['depth'] * 4) . $level['category']->name !!}">
    @foreach($level['children'] as $child)
        @if (empty($child['children']))
            <option value="{{ $child['category']->id }}"  @selected(old('category_id', $product->category_id?? null)  == $child['category']->id)>
                {!! str_repeat('&nbsp;', $child['depth'] * 2) . $child['category']->name !!}
            </option>
        @else
            @include('dashboard.product.partials.category-option', ['level' => $child])
        @endif
    @endforeach
</optgroup>
