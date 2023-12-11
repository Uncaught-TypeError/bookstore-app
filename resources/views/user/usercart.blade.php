<x-app-layout>
    <div class="py-5">
        <div class="container mx-auto mt-10">
            <div class="flex shadow-md my-10">
                <div class="w-3/4 px-10 py-10">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-semibold text-2xl dark:text-white text-black">Book Cart</h1>
                        <h2 class="font-semibold text-2xl text-red-600">{{ $bookinCarts->count() }} Books</h2>
                    </div>
                    <div class="flex mt-10 mb-5">
                        <h3 class="font-semibold dark:text-white text-black text-xs uppercase w-2/5">Book Details</h3>
                        <h3 class="font-semibold dark:text-white text-black text-xs uppercase w-1/5 text-center">Quantity
                        </h3>
                        <h3 class="font-semibold dark:text-white text-black text-xs uppercase w-1/5 text-center">Price
                        </h3>
                        <h3 class="font-semibold dark:text-white text-black text-xs uppercase w-1/5 text-center">Total
                        </h3>
                    </div>
                    @php
                        $totalCost = 0;
                    @endphp
                    @foreach ($bookinCarts as $boc)
                        @php
                            $book = App\Models\Book::where('id', $boc->book_id)->first();
                            $totalCost = $totalCost + $book->book_price;
                        @endphp
                        <div class="flex items-center dark:hover:bg-gray-700 hover:bg-gray-200 -mx-8 px-6 py-5">
                            <div class="flex w-2/5"> <!-- product -->
                                <div class="w-20">
                                    <img class="h-24"
                                        src="{{ $book->book_image ? Storage::url($book->book_image) : 'https://dummyimage.com/150x100' }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col justify-between ml-4 flex-grow">
                                    <span
                                        class="font-bold text-sm dark:text-white text-black">{{ $book->book_name }}</span>
                                    <div class="flex flex-wrap">
                                        @foreach ($book->categories as $category)
                                            <span
                                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 inline-block mb-1 rounded">
                                                {{ $category->category_name ?? '' }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <form action="{{ route('books.removeCart', $book->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-semibold hover:text-red-500 dark:text-white text-black text-xs">Remove</button>
                                    </form>
                                </div>
                            </div>
                            <div class="flex justify-between w-1/5">
                                <svg class="fill-current dark:text-white text-black w-3 cursor-pointer"
                                    viewBox="0 0 448 512" id="minus-{{ $book->id }}">
                                    <path
                                        d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>

                                <input id="quantityInput-{{ $book->id }}"
                                    class="mx-2 text-dark border text-center w-32" type="number" value="1">

                                <svg class="fill-current dark:text-white text-black w-3 cursor-pointer"
                                    viewBox="0 0 448 512" id="plus-{{ $book->id }}">
                                    <path
                                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </div>
                            <span class="text-center dark:text-white text-black w-1/5 font-semibold text-sm"
                                id="bookPrice-{{ $book->id }}">
                                {{ $book->book_price }}</span>
                            <span class="text-center dark:text-white text-black w-1/5 font-semibold text-sm"
                                id="totalPrice-{{ $book->id }}">{{ $book->book_price }}
                            </span>
                        </div>
                    @endforeach


                    <a href="{{ route('welcome') }}"
                        class="flex font-semibold dark:text-white text-black text-sm mt-10">

                        <svg class="fill-current mr-2 dark:text-white text-black w-4" viewBox="0 0 448 512">
                            <path
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>

                <div id="summary" class="w-1/4 px-8 py-10">
                    <h1 class="font-semibold text-2xl border-b pb-8 dark:text-white text-black">Order Summary</h1>
                    <div class="mt-3 mb-5">
                        <label
                            class="font-medium inline-block mb-3 text-sm uppercase dark:text-white text-black">Shipping</label>
                        <select class="block p-2 w-full text-sm">
                            <option>Select Shipping</option>
                            <option>Standard shipping - $10.00</option>
                        </select>
                    </div>
                    {{-- <div class="py-10">
                        <label for="promo" class="font-semibold text-white inline-block mb-3 text-sm uppercase">Promo
                            Code</label>
                        <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
                    </div> --}}
                    {{-- <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button> --}}
                    <form action="{{ route('user.checkout', $totalCost) }}" method="post">
                        @csrf
                        @php
                            $cartBookIds = [];
                            foreach ($bookinCarts as $boc) {
                                $book = App\Models\Book::where('id', $boc->book_id)->first();
                                $cartBookIds[] = $book->id;
                            }
                            session(['cart_bookIds' => $cartBookIds]);
                        @endphp
                        <input type="hidden" name="totalCheckOutPrice" id="totalCheckOutPriceInput"
                            value="{{ $totalCost }}">
                        <div class="border-t mt-8">
                            <div
                                class="flex font-semibold justify-between py-6 text-sm uppercase dark:text-white text-black">
                                <span>Total cost</span>
                                <span id="totalCost">{{ $totalCost }}</span>
                            </div>
                            @if ($cart_empty == 0)
                                <button
                                    class="bg-red-500 font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                            @else
                                <button
                                    class="bg-red-500 font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full"
                                    disabled>Checkout</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

{{-- Test-1 Script --}}
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalCost = document.getElementById('totalCost');
        let totalCheckOutPrice = {{ $totalCost }};
        // let quantityValue = 1;
        // console.log('Default State:', quantityValue);
        @foreach ($bookinCarts as $boc)
            @php
                $book = App\Models\Book::where('id', $boc->book_id)->first();
            @endphp
            const quantityInput{{ $book->id }} = document.getElementById(
                'quantityInput-{{ $book->id }}');
            const minusBtn{{ $book->id }} = document.getElementById('minus-{{ $book->id }}');
            const plusBtn{{ $book->id }} = document.getElementById('plus-{{ $book->id }}');
            const bookPriceSpan{{ $book->id }} = document.getElementById('bookPrice-{{ $book->id }}');
            const totalPriceSpan{{ $book->id }} = document.getElementById(
                'totalPrice-{{ $book->id }}');

            // totalCheckOutPrice = totalCheckOutPrice + parseInt(totalPriceSpan{{ $book->id }}.textContent);
            // Update total when quantity changes
            function updateTotal{{ $book->id }}() {
                const quantity{{ $book->id }} = parseInt(quantityInput{{ $book->id }}.value) || 0;
                const price{{ $book->id }} = parseInt(bookPriceSpan{{ $book->id }}.textContent) || 0;
                const total{{ $book->id }} = quantity{{ $book->id }} * price{{ $book->id }};

                // Update the total span
                totalPriceSpan{{ $book->id }}.textContent = total{{ $book->id }};

                // totalCheckOutPrice = totalCheckOutPrice + price{{ $book->id }};

                updateTotalCost();
            }

            // Event listeners for plus and minus buttons
            // if (quantityInput{{ $book->id }}.value > 0) {
            // console.log(quantityValue);
            minusBtn{{ $book->id }}.addEventListener('click', function() {
                // if (parseInt(totalPriceSpan{{ $book->id }}.textContent) > 0) {
                quantityInput{{ $book->id }}.value = Math.max(parseInt(
                    quantityInput{{ $book->id }}.value) - 1, 1);
                // console.log(parseInt(bookPriceSpan{{ $book->id }}.textContent));
                totalCheckOutPrice = totalCheckOutPrice - parseInt(
                    bookPriceSpan{{ $book->id }}.textContent);
                // } else {
                //     totalCheckOutPrice = 0;
                // }
                updateTotal{{ $book->id }}();
            });

            // }
            plusBtn{{ $book->id }}.addEventListener('click', function() {
                // if (parseInt(totalPriceSpan{{ $book->id }}.textContent) > 1) {
                quantityInput{{ $book->id }}.value = parseInt(
                    quantityInput{{ $book->id }}
                    .value) + 1;
                totalCheckOutPrice = totalCheckOutPrice + parseInt(
                    bookPriceSpan{{ $book->id }}.textContent);
                // } else {
                //     totalCheckOutPrice = 0;
                // }
                // updateQuantityValue();
                updateTotal{{ $book->id }}();
            });

            // Event listener for input change
            quantityInput{{ $book->id }}.addEventListener('input', updateTotal{{ $book->id }});
        @endforeach

        function updateTotalCost() {
            totalCost.textContent = totalCheckOutPrice;
        }

        // function updateQuantityValue() {
        //     quantityValue += 1;
        //     console.log('Last State:', quantityValue);
        // }
    });
</script> --}}

{{-- Test-3 Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalCost = document.getElementById('totalCost');
        let totalCheckOutPrice = {{ $totalCost }};
        @foreach ($bookinCarts as $boc)
            @php
                $book = App\Models\Book::where('id', $boc->book_id)->first();
            @endphp
            const quantityInput{{ $book->id }} = document.getElementById(
                'quantityInput-{{ $book->id }}');
            const minusBtn{{ $book->id }} = document.getElementById('minus-{{ $book->id }}');
            const plusBtn{{ $book->id }} = document.getElementById('plus-{{ $book->id }}');
            const bookPriceSpan{{ $book->id }} = document.getElementById('bookPrice-{{ $book->id }}');
            const totalPriceSpan{{ $book->id }} = document.getElementById(
                'totalPrice-{{ $book->id }}');

            // Update total when quantity changes
            function updateTotal{{ $book->id }}() {
                const quantity{{ $book->id }} = parseInt(quantityInput{{ $book->id }}.value) || 0;
                const price{{ $book->id }} = parseInt(bookPriceSpan{{ $book->id }}.textContent) || 0;
                const total{{ $book->id }} = quantity{{ $book->id }} * price{{ $book->id }};

                // Update the total span
                totalPriceSpan{{ $book->id }}.textContent = total{{ $book->id }};

                updateTotalCost();
            }

            // Event listeners for plus and minus buttons
            minusBtn{{ $book->id }}.addEventListener('click', function() {
                const currentQuantity = parseInt(quantityInput{{ $book->id }}.value) || 0;

                if (currentQuantity > 1) {
                    quantityInput{{ $book->id }}.value = currentQuantity - 1;
                    totalCheckOutPrice = totalCheckOutPrice - parseInt(
                        bookPriceSpan{{ $book->id }}.textContent);
                    updateTotal{{ $book->id }}();
                }
            });

            plusBtn{{ $book->id }}.addEventListener('click', function() {
                quantityInput{{ $book->id }}.value = parseInt(
                    quantityInput{{ $book->id }}
                    .value) + 1;
                totalCheckOutPrice = totalCheckOutPrice + parseInt(
                    bookPriceSpan{{ $book->id }}.textContent);
                updateTotal{{ $book->id }}();
            });

            // Event listener for input change
            quantityInput{{ $book->id }}.addEventListener('input', updateTotal{{ $book->id }});
        @endforeach

        function updateTotalCost() {
            totalCost.textContent = totalCheckOutPrice;
            document.getElementById('totalCheckOutPriceInput').value = totalCheckOutPrice;
        }

    });
</script>
