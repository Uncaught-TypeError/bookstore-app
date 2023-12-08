<x-app-layout>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <section class="container mx-auto p-6">
                <div class="flex justify-end p-4">
                    <a href="{{ route('admin.books.upload') }}"
                        class="bg-red-400 rounded-lg py-2 px-3 hover:bg-red-500 font-bold text-white">Create
                        Books</a>
                </div>
                <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr
                                    class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Title</th>
                                    <th class="px-4 py-3">Image</th>
                                    <th class="px-4 py-3">Categories</th>
                                    <th class="px-4 py-3">Author</th>
                                    <th class="px-4 py-3">Price</th>
                                    <th class="px-4 py-3">Description</th>
                                    <th class="px-4 py-3">Option</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($books as $book)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-3 border">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-semibold text-black capitalize">
                                                        {{ $book->book_name ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-xs border max-w-xs whitespace-normal">
                                            <span
                                                class="text-xs font-medium mr-2 px-2.5 py-0.5 inline-block mb-1 rounded">{{ Str::limit($book->book_image, 20) ?? '' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-xs border max-w-xs whitespace-normal">
                                            @foreach ($book->categories as $category)
                                                <span
                                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 inline-block mb-1 rounded">
                                                    {{ $category->category_name ?? '' }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-3 text-xs border max-w-xs whitespace-normal">
                                            <span
                                                class="text-xs font-medium mr-2 px-2.5 py-0.5 inline-block mb-1 rounded">{{ $book->book_author ?? '' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-xs border">
                                            <span class="px-2 py-1 font-semibold leading-tight rounded-sm">$
                                                {{ $book->book_price ?? '' }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-xs border">
                                            <span
                                                class="px-2 py-1 font-semibold leading-tight rounded-sm">{{ Str::limit($book->book_desc, 20) }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-sm border">
                                            <div class="flex justify-around">
                                                <a href="{{ route('admin.books.edit', $book->id) }}"
                                                    class="text-blue-400 uppercase font-semibold hover:text-blue-500">Edit</a>
                                                <form action="{{ route('admin.books.delete', $book->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-400 uppercase font-semibold hover:text-red-500 cursor-pointer">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>