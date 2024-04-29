@push('header')
    <script src="{{ url('js/apexcharts.js') }}"></script>
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id="chart">
                </div>
                <x-welcome />
            </div>
        </div>
    </div>
    @push('modals')
        <script>

            var options = {
                series: [44, 55, 13, 43, 88],
                chart: {
                    width: 680,
                    type: 'pie',
                },
                labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        </script>
    @endpush
</x-app-layout>
