<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 dark:text-red-600 leading-tight">
            {{ __('Admin Homepage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @role('admin')
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Welcome Admin!') }}
                    </div>
                @endrole
            </div>
        </div>
    </div>
</x-admin-layout>
