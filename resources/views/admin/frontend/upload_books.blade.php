<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex flex-row md:flex-col">
                <div class="w-full md:w-1/2 bg-red-100 p-4 md:p-8">
                    <header class="mb-6">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Book Information') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Create your book's information and category.") }}
                        </p>
                    </header>
                    <form method="post" action="" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        <div id="Book_Name" class="">
                            <x-input-label for="book_name" :value="__('Book Name')" />
                            <x-text-input id="book_name" name="book_name" type="text" class="mt-1 block w-full"
                                required autofocus autocomplete="book_name" />
                            <x-input-error class="mt-2" :messages="$errors->get('book_name')" />
                        </div>
                        <div id="Book_Category">
                            <x-input-label for="book_category" :value="__('Book Category')" />
                            <select id="countries"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                                <option selected>Choose a category</option>
                                <option value="">Horror</option>
                                <option value="">Thriller</option>
                                <option value="">Comedy</option>
                                <option value="">Romace</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('book_category')" />
                        </div>
                        <div id="Book_Desc">
                            <x-input-label for="book_desc" :value="__('Book Description')" />
                            <textarea id="book_desc" name="book_desc"
                                class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                required autofocus autocomplete="book_desc"></textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('book_desc')" />
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-1/2 bg-slate-300 p-4 md:p-8">
                    <div class="">
                        <img src="{{ asset('test_images/very-good.gif') }}" class="w-full" alt="">
                    </div>
                    <input type="file"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
