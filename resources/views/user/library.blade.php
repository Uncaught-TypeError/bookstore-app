<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Library') }}
        </h2>
    </x-slot>
    <section class="px-1 flex flex-wrap justify-center items-center gap-3">
        @foreach ($allBooks as $book)
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg"
                        src="{{ $book->book_image ? Storage::url($book->book_image) : 'https://dummyimage.com/1000x750' }}"
                        alt="" />
                </a>
                <div class="p-5 flex flex-col items-center justify-center">
                    <a href="#">
                        <h5 class="mb-2 text-center text-2xl font-bold tracking-tight text-dark">
                            {{ $book->book_name }}
                        </h5>
                    </a>
                    <p class="mb-3 text-center font-normal text-gray-700">{{ Str::limit($book->book_desc, 100) }}
                    </p>
                    <div class="flex justify-evenly items-center w-full">
                        <a href="{{ route('view.pdf', $book->id) }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Read Now
                        </a>
                        <a href="{{ route('download.pdf', $book->id) }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Download Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
</x-app-layout>
