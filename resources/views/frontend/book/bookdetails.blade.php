<x-app-layout>
    <section class="mt-5">
        <div class="p-5 flex justify-around">
            <a href="{{ route('welcome') }}"
                class="flex text-sm sm:text-base uppercase font-roboto dark:text-white text-black hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-2 ">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                Go Back to Browsing?
            </a>
        </div>
        <section class="dark:text-white text-black flex justify-center items-center">
            <div class="container justify-center items-center text-center mx-auto flex flex-col px-5 py-5">
                <span class="flex items-center justify-center text-2xl">
                    More Information for {{ $book->book_name }}
                </span>
                <div class="mx-auto lg:w-4/6 pt-10">
                    <div class="rounded-lg h-96 overflow-hidden mb-10">
                        <img alt="content" class="object-scale-down h-full w-full"
                            src="{{ $book->book_image ? Storage::url($book->book_image) : 'https://dummyimage.com/1000x750' }}">
                    </div>
                    {{-- <div class="flex justify-around w-full items-center p-5">
                        <a href="{{ route('download.pdf', $book->id) }}"
                            class="border p-2 sm:p-3 border-black bg-gray-500 hover:bg-gray-600 rounded-lg cursor-pointer text-sm sm:text-base">Read
                            Book</a>
                        <a href=""
                            class="border p-2 sm:p-3 border-black bg-gray-500 hover:bg-gray-600 rounded-lg cursor-pointer text-sm sm:text-base">
                            Download Book</a>
                    </div> --}}
                    <div class="flex flex-col sm:flex-row border-t">
                        <div class="text-center sm:w-1/3 sm:py-3 sm:pr-8">
                            <div class="flex flex-col items-center justify-center text-center">
                                <h2 class="title-font mt-4 text-lg font-medium text-gray-900">
                                </h2>
                                <div class="mb-4 mt-2 h-1 w-12 rounded bg-gray-500"></div>
                                <div class="mb-2 flex items-center justify-between gap-2">
                                    <div>
                                        <p>Author:</p>
                                    </div>
                                    <div>
                                        <p class="text-base">{{ $book->book_author }}</p>
                                    </div>
                                </div>
                                {{-- <div class="mb-2 flex items-center justify-between gap-2">
                                    <p>Duration:</p>
                                    <p class="text-base"> Days</p>
                                </div> --}}
                                <div class="mb-2 flex items-center justify-between gap-2">
                                    <p>Price:</p>
                                    <p class="text-base">$ {{ $book->book_price }}</p>
                                </div>
                                @role('admin')
                                    <div class="mb-2 flex items-center justify-between gap-2">
                                        <a href="{{ route('admin.books.edit', $book->id) }}"
                                            class="border p-1 sm:p-1 sm:px-2 bg-red-600 text-white hover:text-red-100 rounded-lg cursor-pointer text-sm sm:text-base">Edit
                                            Book</a>
                                    </div>
                                @endrole
                            </div>
                        </div>
                        <div
                            class="mt-4 border-t border-gray-200 pt-4 text-center sm:mt-0 sm:w-2/3 sm:border-l sm:border-t-0 sm:py-8 sm:pl-8 sm:text-left">
                            <div class="">
                                <p class="mb-4 text-lg leading-relaxed" style="word-wrap: break-word;">
                                    {{ $book->book_desc }}
                                </p>
                            </div>
                            @if (Auth::user())
                                @php
                                    $user_id = Auth::user()->id;
                                    $bookInCart = App\Models\MyCart::where('user_id', $user_id)
                                        ->where('book_id', $book->id)
                                        ->first();
                                @endphp
                                @unlessrole('admin')
                                    @if ($bookInCart)
                                        <div>
                                            <form action="{{ route('books.removeCart', $book->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex text-xl items-center text-red-500 cursor-pointer">Remove
                                                    from Cart
                                                    <svg viewBox="0 0 21 21" style="color: rgb(255, 255, 255); width: 30px"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd" transform="translate(2 4)">
                                                            <path
                                                                d="m3 2.5h12.5l-1.5855549 5.54944226c-.2453152.85860311-1.0300872 1.45055774-1.9230479 1.45055774h-6.70131161c-1.01909844 0-1.87522688-.76627159-1.98776747-1.77913695l-.80231812-7.22086305h-2"
                                                                stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <g fill="currentColor">
                                                                <circle cx="5" cy="12" r="1" />
                                                                <circle cx="13" cy="12" r="1" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div>
                                            <form action="{{ route('books.putCart', $book->id) }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex text-xl items-center text-red-500 cursor-pointer">Add
                                                    to Cart
                                                    <svg viewBox="0 0 21 21" style="color: rgb(255, 255, 255); width: 30px"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g fill="none" fill-rule="evenodd" transform="translate(2 4)">
                                                            <path
                                                                d="m3 2.5h12.5l-1.5855549 5.54944226c-.2453152.85860311-1.0300872 1.45055774-1.9230479 1.45055774h-6.70131161c-1.01909844 0-1.87522688-.76627159-1.98776747-1.77913695l-.80231812-7.22086305h-2"
                                                                stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                            <g fill="currentColor">
                                                                <circle cx="5" cy="12" r="1" />
                                                                <circle cx="13" cy="12" r="1" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endunlessrole
                            @else
                                <div>
                                    <form action="{{ route('books.putCart', $book->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex text-xl items-center text-red-500 cursor-pointer">Add
                                            to Cart
                                            <svg viewBox="0 0 21 21" style="color: rgb(255, 255, 255); width: 30px"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g fill="none" fill-rule="evenodd" transform="translate(2 4)">
                                                    <path
                                                        d="m3 2.5h12.5l-1.5855549 5.54944226c-.2453152.85860311-1.0300872 1.45055774-1.9230479 1.45055774h-6.70131161c-1.01909844 0-1.87522688-.76627159-1.98776747-1.77913695l-.80231812-7.22086305h-2"
                                                        stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <g fill="currentColor">
                                                        <circle cx="5" cy="12" r="1" />
                                                        <circle cx="13" cy="12" r="1" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

</x-app-layout>
