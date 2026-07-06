<div class="p-3">
    <a href="{{ route('category.show', ['category' => $category]) }}" class="flex flex-col items-center">
        <div>
            <img src="{{ asset("storage/$category->image") }}" class="w-44 aspect-square rounded-lg" alt="{{ $category->name }}">
        </div>
        <p class="text-center mt-2">
            {{ $category->name }}
        </p>
    </a>
</div>
