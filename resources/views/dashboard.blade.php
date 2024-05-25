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
            <div class="grid grid-cols-12 gap-6">
                <a href="#" class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-4 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ \App\Models\Meeting::count() }}
                                </div>
                                <div class="mt-1 text-base font-bold text-gray-600">
                                    Digital Meeting
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?id=g5UsP7eRJkpR&format=png" alt="legal case" class="h-18 w-18" />
                            </div>
                        </div>
                    </div>
                </a>
                <a href="#" class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-4 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ \App\Models\AgendaItems::count() }}
                                </div>
                                <div class="mt-1 text-base font-bold text-gray-600">
                                    Manual Meeting
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?id=L4SkoU5noBqn&format=png" alt="legal case" class="h-18 w-18" />
                            </div>
                        </div>
                    </div>
                </a>
                <a href="javascript:;"  class="transform hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-4 intro-y bg-white">
                    <div class="p-5">
                        <div class="grid grid-cols-3 gap-1">
                            <div class="col-span-2">
                                <div class="text-3xl font-bold leading-8">
                                    {{ \App\Models\MeetingMinutes::count() }}
                                </div>
                                <div class="mt-1 text-base font-bold text-gray-600">
                                    Total Minutes Of Meetings
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-end">
                                <img src="https://img.icons8.com/?id=bcGNwF2H0QAa&format=png" alt="legal case" class="h-12 w-12" />
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <h1 class="p-4 bank-green-bg uppercase text-white font-extrabold text-center text-2xl shadow-xl rounded-lg my-4">
                BOARD MEETING STATISTICS
            </h1>

            <div class="grid grid-cols-12 gap-6">

                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <div class="bg-white rounded-lg shadow-lg p-4" id="chart"></div>
                </div>

                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <div class="bg-white rounded-lg shadow-lg p-4" id="chart_subjects"></div>
                </div>



            </div>

        </div>
    </div>


    @push('modals')
        <script>

            var options = {
                series: [@foreach($lock_unlock_chart_data as $key => $value) {{ $value }}, @endforeach],
                chart: {
                    width: 550,
                    type: 'pie',
                },
                title: {
                    text: 'Meeting Lock / Unlock Status',
                    align: 'center',
                    margin: 0,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize:  '16px',
                        fontWeight:  'bold',
                        fontFamily:  undefined,
                        color:  '#0a0243'
                    },
                },
                labels: [@foreach($lock_unlock_chart_data as $key => $value) '{{ $key }}', @endforeach],
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

            var options_subjects = {
                series: [{
                    name: 'Meetings',
                    data: [
                        {{--                    @foreach ($admission_weekly_report as $date => $count)--}}
                            {{--                        {{ $count }},--}}
                            {{--                    @endforeach--}}
                            // 20,30,40,50, 60,
                        @foreach ($meetingCounts as $item)
                            {{ $item->count }},
                        @endforeach
                    ]
                }],
                chart: {
                    type: 'bar',
                    width: '550',
                    height: '435',
                },

                title: {
                    text: 'Meeting Month Wise Statistics (Last 6 months)',
                    align: 'center',
                    margin: 0,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize:  '16px',
                        fontWeight:  'bold',
                        fontFamily:  undefined,
                        color:  '#0a0243'
                    },
                },

                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: [

                    @foreach ($meetingCounts as $item)
                            '{{ $item->month . '-' . $item->year }}',
                    @endforeach
                        //     '27-Apr-24',
                        // '26-Apr-24',
                        // '25-Apr-24',
                        // '24-Apr-24',
                        // '23-Apr-24',
                    ],
                },
                yaxis: {
                    title: {
                        text: 'Total (Count)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val + ""
                        }
                    }
                }
            };

            var chart_options_subjects = new ApexCharts(document.querySelector("#chart_subjects"), options_subjects);
            chart_options_subjects.render();



        </script>
    @endpush
</x-app-layout>
