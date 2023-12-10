<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-3">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <form method="post" action="{{ route('admin.books.update', $book->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="pb-12">
            <div class="max-w-7xl mx-auto mt-4 sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex">
                    <div class="w-full md:w-1/2 p-4 md:p-8">
                        <header class="mb-6">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                Edit <span class="text-red-500">{{ $book->book_name }}</span> Infomation
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Create your book's information and category.") }}
                            </p>
                        </header>
                        <div class="mt-6 space-y-6">
                            <div id="Book_Name" class="">
                                <x-input-label for="book_name" :value="__('Book Name')" />
                                <x-text-input id="book_name" name="book_name" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="book_name" value="{{ $book->book_name }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('book_name')" />
                            </div>
                            <div id="Book_Author" class="">
                                <x-input-label for="book_author" :value="__('Book Author')" />
                                <x-text-input id="book_author" value="{{ $book->book_author }}" name="book_author"
                                    type="text" class="mt-1 block w-full" required autofocus
                                    autocomplete="book_author" />
                                <x-input-error class="mt-2" :messages="$errors->get('book_author')" />
                            </div>
                            <div id="Book_Price" class="">
                                <x-input-label for="book_price" :value="__('Book Price')" />
                                <x-text-input id="book_price" value="{{ $book->book_price }}" name="book_price"
                                    type="number" class="mt-1 block w-full" required autofocus
                                    autocomplete="book_price" />
                                <x-input-error class="mt-2" :messages="$errors->get('book_price')" />
                            </div>
                            <div id="Book_Category">
                                <x-input-label for="book_category" :value="__('Book Category')" />
                                <select id="book_category" multiple required
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    name="categories[]">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $book->categories->contains('id', $category->id) ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('book_category')" />
                            </div>
                            <div id="Book_Desc">
                                <x-input-label for="book_desc" :value="__('Book Description')" />
                                <textarea id="book_desc" name="book_desc"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    required autofocus autocomplete="book_desc">{{ $book->book_desc }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('book_desc')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 p-4 md:p-8 flex flex-col justify-evenly">
                        <div id="Book_Img">
                            <div style="width: 100%; height: 400px;">
                                <img id="preview_img"
                                    src="{{ $book->book_image ? Storage::url($book->book_image) : 'https://dummyimage.com/150x100' }}"
                                    style="height: 100%" alt="">
                            </div>
                            <input type="file" id="image" name="book_image" onchange="loadFile(event)"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                value="{{ $book->book_image }}">
                            <x-input-error class="mt-2" :messages="$errors->get('book_image')" />
                        </div>
                        <div id="Book_file">
                            <x-input-label for="book_file" :value="__('Book File')" />
                            <input type="file" name="book_file"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                value="{{ $book->book_file }}">
                            <x-input-error class="mt-2" :messages="$errors->get('book_file')" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

<script>
    var loadFile = function(event) {

        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('preview_img');


        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
