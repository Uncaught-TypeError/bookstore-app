@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-red-400 dark:border-red-600 text-start text-base font-medium text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/50 focus:outline-none focus:text-red-800 dark:focus:text-red-200 focus:bg-red-100 dark:focus:bg-red-900 focus:border-red-700 dark:focus:border-red-300 transition duration-150 ease-in-out' : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 hover:bg-red-50 dark:hover:bg-red-700 hover:border-red-300 dark:hover:border-red-600 focus:outline-none focus:text-red-800 dark:focus:text-red-200 focus:bg-red-50 dark:focus:bg-red-700 focus:border-red-300 dark:focus:border-red-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
