<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Brand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('dashboard.brand.store') }}" method="POST" x-data="{name:'{{ old('name') }}'}" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col gap-8">
                            <label class="input input-bordered flex items-center gap-2 ">
                                {{ __('Name') }}
                                <input name="name" type="text" class="grow border-0 focus:ring-0" x-model="name" placeholder="پرسیل"  autofocus/>
                            </label>
                            @error('name')
                                <p class="text-error">{{ $message }}</p>
                            @enderror

                            <label class="input input-bordered flex items-center gap-2 ">
                                {{ __('Slug') }}
                                <input type="text" class=" border-0 focus:ring-0" :value='name.trim().replace(/\s+/g, "-")' placeholder="{{ Str::slug('پرسیل', '-', null) }}"  disabled/>
                            </label>

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
