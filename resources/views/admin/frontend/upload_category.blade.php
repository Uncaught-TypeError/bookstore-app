<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 dark:text-red-200 leading-tight mb-3">
            {{ __('Category') }}
        </h2>
    </x-slot>
    <div class="pb-12">
        <div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex">
                <div class="w-full md:w-1/2 p-4 md:p-8">
                    <header class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Category') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Create your book's category.") }}
                        </p>
                    </header>
                    <form method="post" action="{{ route('admin.category.post') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-6 space-y-6">
                            <div id="Category_Name" class="">
                                <x-input-label for="category_name" :value="__('Category Name')" />
                                <x-text-input id="category_name" name="category_name" type="text"
                                    class="mt-1 block w-full" required autofocus autocomplete="category_name" />
                                {{-- <x-input-error class="mt-2" :messages="$errors->get('book_name')" /> --}}
                                @if ($errors->has('category_name'))
                                    <strong
                                        style="font-size: .875em; margin-top: 0.25rem; color: #dc3545;">{{ $errors->first('category_name') }}</strong>
                                @endif
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                            </div>
                        </div>
                </div>
                </form>
                <div class="w-full md:w-1/2 p-4 md:p-8 flex justify-center">
                    <section id="secondSection" class="flex flex-col justify-center items-center">
                        <div class="text-3xl text-center text-black dark:text-white">Categories</div>
                        <div class="flex justify-center items-center">
                            <div class="py-3 text-xs max-w-xl whitespace-normal">
                                @foreach ($categories as $category)
                                    <div class="relative inline-block mr-2 mb-2">
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded inline-flex items-center">
                                            {{ $category->category_name ?? '' }}
                                            <form action="{{ route('admin.category.delete', $category->id) }}"
                                                method="post" class="ml-2">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="text-red-600 focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
