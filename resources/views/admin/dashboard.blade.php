<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-600 dark:text-red-200 leading-tight">
            {{ __('Admin Dashboard') }}
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
        <div class="w-full flex flex-col items-center justify-center mt-10">
            <span class="text-3xl font-bold text-red-400 p-3">User Analysis</span>
            <canvas id="myChart" class="dark:bg-gray-100 bg-white rounded-lg shadow-lg p-3"
                style="width:100%; max-width:700px"></canvas>
        </div>
    </div>

    <script>
        const xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October",
            "November", "December"
        ];
        const yValues = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 15];
        const barColors = ["#", "#", "#", "#", "#", "#", "#", "#", "#", "#", "#FFCDCD", "#FF7070"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "Books bought throughout the year"
                }
            }
        });
    </script>
</x-admin-layout>
