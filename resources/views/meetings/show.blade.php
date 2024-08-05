<x-app-layout>
    @push('header')
        <script src="https://cdn.tiny.cloud/1/izbyerk8x92uls8z2ulnezm5uaudhf41lw0lebop5ba724o5/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
        </script>
        <style>
            table, td, th {
                /*border: 1px solid;*/
                padding-left: 5px;
            }

            table {
                width: 100%;
                font-size: 12px;
                border-collapse: collapse;
            }
        </style>


        <style>

            @media screen {
                .table_header_print {
                    display: none;
                }
            }

            @media print {
                body {
                    margin: 0;
                    padding: 0;
                }

                .header-print {
                    width: 100%;
                    height: 100px; /* Adjust the height as needed */
                    margin: 0;
                    padding: 0;
                    position: fixed;
                    top: 0;
                    left: 0;
                    background-color: white; /* Set the background color you want */
                }

                .table_header_print {
                    width: 100%;
                }

                .table_header_print td {
                    width: 33.33%;
                    text-align: center; /* Center the content horizontally */
                }

                .table_header_print img {
                    height: 100px;
                }

                table, td, th {
                    /*border: 1px solid;*/
                }

                .qrcode {
                    float: right;
                }
            }

            /* Hide the header on the screen */
            .header-print {
                display: none;
            }
        </style>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline">
            {{ __('Meeting / ' . $meeting->slug . ' ' . $meeting->title) }}
        </h2>

        <div class="flex justify-center items-center float-right">

            <a href="{{ route('meeting.index') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back
            </a>

            <a href="javascript:;" id="toggle" onclick="window.print()"
               class="flex items-center px-3 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
               title="Members List">


                <svg data-slot="icon" class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z"></path>
                </svg>


            </a>

        </div>

    </x-slot>

        <div class="fixed inset-0 z-0 pointer-events-none print:block hidden">
            <div class="w-full h-full flex flex-wrap content-center justify-center opacity-5 transform -rotate-45 text-gray-500 text-xs">
                @for ($i = 0; $i < 500; $i++)
                    <div class="p-0.5 whitespace-nowrap">Board Meeting {{ $meeting->me_id }} : <span style="font-size: 2px;"> {{ $auth_id }}</span></div>
                @endfor
            </div>
        </div>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Your existing content here -->
                <div class="bg-white overflow-hidden sm:rounded-lg pt-4 pb-2 ">
                    <div class="relative z-10">
                    <table style="margin: 0px;">
                        <tr>
                            <td style="width: 33.33%">
                                <div style="float: left; margin-left: 10%">
                                    @php $test_report_data = $meeting->slug . ' Board Meeting '. "\n". $meeting->id . "\n" . \Carbon\Carbon::parse($meeting->date_and_time)->format('d-M-Y H:i:s') ; @endphp
                                    {!! DNS2D::getBarcodeSVG($test_report_data, 'QRCODE',3,3) !!}
                                </div>
                            </td>
                            <td style="width: 33.33%">
                                <img src="{{ url('images/logo.png') }}" alt="Logo" style="margin:auto; height: 100px;">
                            </td>
                            <td style="width: 33.33%; text-align: center;">
                                <div style="margin: auto; margin-left: 30%">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table style="margin-top: 10px; font-size:18px; line-height: 1.2; text-align: center; font-weight: bold;">
                        <tbody>
                        <tr>
                            <td>
                                {{ $meeting->slug }} {{ $meeting->title }}
                                <br>
                                {{ $meeting->location }} <br>
                                Date & Time: {{ \Carbon\Carbon::parse($meeting->date_and_time)->format('d-M-Y H:i:s') }} <sup>PST<span style="font-size: 3px;margin: 0px; padding: 0px;">{{\Illuminate\Support\Facades\Auth::user()->id}}</span></sup>
                                <br>
                                <span style="font-size: 14px;">MUID: {{ $meeting->id }}</span>
                                {{--                                        Created At :: {{ \Carbon\Carbon::parse($meeting->created_at)->format('d-m-Y H:i:s a') }}--}}
                            </td>
                        </tr>
                        </tbody>
                    </table>


                    @if($meeting->agenda_items->isNotEmpty())
                        <hr class="mb-0 mt-1">
                        {{--                    <h1 class="text-2xl text-center mb-2 mt-1 font-bold">Meeting Agendas</h1>--}}
                        <div class="relative overflow-x-auto ">
                            <table class="min-w-max w-full table-auto print:bg-transparent print:overflow-visible">
                                <thead>
                                <tr class="bg-gray-200 text-white bank-green-bg uppercase text-sm print:bg-transparent print:overflow-visible">
                                    <th class="py-2 px-2 text-center">ID</th>
                                    <th class="py-2 px-2 text-center">Agenda Title</th>
                                    {{--                            <th class="py-2 px-2 text-center">Attachment</th>--}}
                                    <th class="py-2 px-2 text-center">Order</th>
                                    <th class="py-2 px-2 text-center print:hidden">Action</th>
                                </tr>
                                </thead>
                                @foreach($meeting->agenda_items->sortBy('order') as $ai)
                                    <tbody class="text-black text-sm leading-normal ">
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-1 px-2 text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="py-1 px-2 text-center">
                                            {{ $ai->title }}
                                        </td>

                                        <td class="py-1 px-2 text-center">
                                            {{ $ai->order }}
                                        </td>


                                        <td class="py-1 px-2 text-center print:hidden">

                                            @can('agenda-item-edit')
                                                <a href="{{ route('meeting.agenda-item.edit', [$meeting->id, $ai->id]) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('agenda-item-view')
                                                <a href="{{ route('meeting.agenda-item.show', [$meeting->id, $ai->id]) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                    View
                                                </a>
                                            @endcan

                                            @can('agenda-item-delete')
                                                <form action="{{ route('meeting.agenda-item.destroy', [$meeting->id, $ai->id]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    @endif

                    @can('agenda-item-create')
                        <form method="POST" action="{{ route('meeting.agenda-item.store', $meeting->id) }}" enctype="multipart/form-data" class="print:hidden">
                            <x-status-message class="ml-4 mt-4"/>
                            <x-validation-errors class="ml-4 mt-4"/>
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4 pl-8 pb-4 pt-4 pr-8">
                                <div>
                                    <x-label for="title" value="Meeting Agenda Title" :required="true"/>
                                    <x-input id="title" name="title" class="block mt-1 w-full" type="text" value="{{ old('title') }}"/>
                                </div>

                                <div>
                                    <x-label for="description" value="Description" :required="true" class="pb-2"/>
                                    <textarea class="block mt-1 w-full" name="description">{{ old('description') }}</textarea>
                                </div>

                                <input type="hidden" value="{{ $meeting->id }}" name="meeting_id">

                                <div>
                                    <x-label for="order" value="{{ __('Order (the order in which the agenda items should be discussed)') }}"/>
                                    <select name="order" id="order"
                                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        @for($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}" @if($i == old('order')) selected @endif>{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>

                                <div class="flex items-center justify-end mt-2">
                                    <x-button class="ml-4 bank-green-bg" id="submit-btn"> {{ __('Add') }} </x-button>
                                </div>
                            </div>
                        </form>
                    @endcan
                    </div>
            </div>

        </div>
    </div>
</x-app-layout>
