<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('dashboard.product.update', ['product' => $product]) }}" method="POST" x-data="{name:'{{ old('name', $product->name) }}'}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col gap-8">
                            <label class="input input-bordered flex items-center gap-2 ">
                                {{ __('Name') }}
                                <input name="name" type="text" class="grow border-0 focus:ring-0" x-model="name" placeholder="کره بادوم زمینی"  autofocus/>
                            </label>
                            @error('name')
                                <p class="text-error">{{ $message }}</p>
                            @enderror

                            <label class="input input-bordered flex items-center gap-2 ">
                                {{ __('Slug') }}
                                <input type="text" class="grow border-0 focus:ring-0" :value='name.trim().replace(/\s+/g, "-")' placeholder="{{ Str::slug('کره بادوم زمینی', '-', null) }}"  disabled/>
                            </label>

                            <select class="select select-bordered" name="category_id" @disabled(!$hierarchy->count())>
                                <option value="" @selected(!old('category_id')) disabled>{{ __('Category') }}</option>
                                @foreach($hierarchy as $level)
                                    @include('dashboard.product.partials.category-option', ['level' => $level, 'product' => $product])
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-error">{{ $message }}</p>
                            @enderror

                            <select class="select select-bordered" name="brand_id" @disabled(!$brands->count())>
                                <option value="" @selected(!old('brand_id')) disabled>{{ __('Brand') }}</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id)  == $brand->id)>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <p class="text-error">{{ $message }}</p>
                            @enderror

                            <label class="input input-bordered flex items-center gap-2 ">
                                {{ __('Price') }}
                                <input name="price" type="number" class="grow border-0 focus:ring-0" value="{{ old('price', $product->price) }}" placeholder="300000"  autofocus/>
                            </label>
                            @error('price')
                                <p class="text-error">{{ $message }}</p>
                            @enderror

                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text">{{ __('description') }}</span>
                                </div>
                                <textarea name="description" class="textarea textarea-bordered h-24" placeholder="{{ __('description') }}">{{ old('description', $product->description) }}</textarea>
                                <div class="label">
                                    <span class="label-text">{{ __('description') }}</span>
                                </div>
                            </label>
                            @error('description')
                            <p class="text-error">{{ $message }}</p>
                            @enderror

                            <input type="file" name="image" class="file-input file-input-bordered"/>
                            @error('image')
                                <p class="text-error">{{ $message }}</p>
                            @enderror

                            <button type="submit" class="btn btn-success self-end">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
