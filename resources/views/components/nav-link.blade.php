@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 pt-1 border-b-2 border-red-400 dark:border-red-600 text-sm font-medium leading-5 text-red-600 dark:text-red-600 focus:outline-none focus:border-red-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-600 hover:border-red-400 dark:hover:border-red-400 focus:outline-none focus:text-red-400 dark:focus:text-red-300 focus:border-red-300 dark:focus:border-red-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
