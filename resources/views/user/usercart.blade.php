<x-app-layout>

    <div class="py-5">
        <div class="container mx-auto mt-10">
            <div class="flex shadow-md my-10">
                <div class="w-3/4 px-10 py-10">
                    <div class="flex justify-between border-b pb-8">
                        <h1 class="font-semibold text-2xl text-white">Book Cart</h1>
                        <h2 class="font-semibold text-2xl text-red-600">{{ $bookinCarts->count() }} Books</h2>
                    </div>
                    <div class="flex mt-10 mb-5">
                        <h3 class="font-semibold text-white text-xs uppercase w-2/5">Book Details</h3>
                        <h3 class="font-semibold text-white text-xs uppercase w-1/5 text-center">Quantity
                        </h3>
                        <h3 class="font-semibold text-white text-xs uppercase w-1/5 text-center">Price
                        </h3>
                        <h3 class="font-semibold text-white text-xs uppercase w-1/5 text-center">Total
                        </h3>
                    </div>
                    @foreach ($bookinCarts as $boc)
                        @php
                            $book = App\Models\Book::where('id', $boc->book_id)->first();
                        @endphp
                        <div class="flex items-center hover:bg-gray-700 -mx-8 px-6 py-5">
                            <div class="flex w-2/5"> <!-- product -->
                                <div class="w-20">
                                    <img class="h-24"
                                        src="{{ $book->book_image ? Storage::url($book->book_image) : 'https://dummyimage.com/150x100' }}"
                                        alt="">
                                </div>
                                <div class="flex flex-col justify-between ml-4 flex-grow">
                                    <span class="font-bold text-sm text-white">{{ $book->book_name }}</span>
                                    <div class="flex flex-wrap">
                                        @foreach ($book->categories as $category)
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 inline-block mb-1 rounded">
                                                {{ $category->category_name ?? '' }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <form action="{{ route('books.removeCart', $book->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="font-semibold hover:text-red-500 text-white text-xs">Remove</button>
                                    </form>
                                </div>
                            </div>
                            <div class="flex justify-between w-1/5">
                                <svg class="fill-current text-white w-3 cursor-pointer" viewBox="0 0 448 512"
                                    id="minus">
                                    <path
                                        d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>

                                <input id="quantityInput" class="mx-2 text-dark border text-center w-32" type="number"
                                    value="1">

                                <svg class="fill-current text-white w-3 cursor-pointer" viewBox="0 0 448 512"
                                    id="plus">
                                    <path
                                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </div>
                            <span class="text-center text-white w-1/5 font-semibold text-sm" id="bookPrice">
                                {{ $book->book_price }}</span>
                            <span class="text-center text-white w-1/5 font-semibold text-sm" id="totalPrice">
                            </span>
                        </div>
                    @endforeach


                    <a href="#" class="flex font-semibold text-white text-sm mt-10">

                        <svg class="fill-current mr-2 text-white w-4" viewBox="0 0 448 512">
                            <path
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>

                <div id="summary" class="w-1/4 px-8 py-10">
                    <h1 class="font-semibold text-2xl border-b pb-8 text-white">Order Summary</h1>
                    <div class="mt-3">
                        <label class="font-medium inline-block mb-3 text-sm uppercase text-white">Shipping</label>
                        <select class="block p-2 w-full text-sm">
                            <option>Standard shipping - $10.00</option>
                        </select>
                    </div>
                    <div class="py-10">
                        <label for="promo" class="font-semibold text-white inline-block mb-3 text-sm uppercase">Promo
                            Code</label>
                        <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
                    </div>
                    <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button>
                    <div class="border-t mt-8">
                        <div class="flex font-semibold justify-between py-6 text-sm uppercase text-white">
                            <span>Total cost</span>
                            <span>$600</span>
                        </div>
                        <button
                            class="bg-red-500 font-semibold hover:bg-red-600 py-3 text-sm text-white uppercase w-full">Checkout</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantityInput');
        const minusBtn = document.getElementById('minus');
        const plusBtn = document.getElementById('plus');
        const bookPriceSpan = document.getElementById('bookPrice');
        const totalPriceSpan = document.getElementById('totalPrice');

        // Update total when quantity changes
        function updateTotal() {
            const quantity = parseInt(quantityInput.value) || 0;
            const price = bookPriceSpan.textContent || 0;
            const total = quantity * price;

            // Update the total span
            totalPriceSpan.textContent = total; // Adjust as needed
        }

        // Event listeners for plus and minus buttons
        minusBtn.addEventListener('click', function() {
            quantityInput.value = Math.max(parseInt(quantityInput.value) - 1, 0);
            updateTotal();
        });

        plusBtn.addEventListener('click', function() {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotal();
        });

        // Event listener for input change
        quantityInput.addEventListener('input', updateTotal);
    });
</script>
