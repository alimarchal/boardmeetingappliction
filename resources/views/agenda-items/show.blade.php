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
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden  sm:rounded-lg pt-4 pb-2 ">

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
                            Date & Time: {{ \Carbon\Carbon::parse($meeting->date_and_time)->format('d-M-Y H:i:s') }} PST
                            <br>
                            <span style="font-size: 14px;">MUID: {{ $meeting->id }}</span>
                            <br>
                            Item: {{ $agendaItems->order }}  - {{ $agendaItems->title }}
                            {{--                                        Created At :: {{ \Carbon\Carbon::parse($meeting->created_at)->format('d-m-Y H:i:s a') }}--}}
                        </td>
                    </tr>
                    </tbody>
                </table>




                <hr class="mb-1 mt-1">

{{--                <form method="POST" action="{{ route('meeting.agenda-item.store', $meeting->id) }}" enctype="multipart/form-data">--}}
{{--                    <x-status-message class="ml-4 mt-4"/>--}}
{{--                    <x-validation-errors class="ml-4 mt-4"/>--}}
{{--                    @csrf--}}
{{--                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4 pl-8 pb-4 pt-4 pr-8">--}}
{{--                        <div>--}}
{{--                            <x-label for="title" value="Meeting Agenda Title" :required="true"/>--}}
{{--                            <x-input id="title" name="title" class="block mt-1 w-full" type="text"  value="{{ old('title') }}"/>--}}
{{--                        </div>--}}

{{--                        <div>--}}
{{--                            <x-label for="description" value="Description" :required="true" class="pb-2"/>--}}
{{--                            <textarea class="block mt-1 w-full" name="description">{{ old('description') }}</textarea>--}}
{{--                        </div>--}}

{{--                        <input type="hidden" value="{{ $meeting->id }}" name="meeting_id">--}}

{{--                        <div>--}}
{{--                            <x-label for="order" value="{{ __('Order (the order in which the agenda items should be discussed)') }}" />--}}
{{--                            <select name="order" id="order" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">--}}
{{--                                @for($i = 1; $i <= 20; $i++)--}}
{{--                                    <option value="{{ $i }}" @if($i == old('order')) selected @endif>{{ $i }}</option>--}}
{{--                                @endfor--}}

{{--                            </select>--}}
{{--                        </div>--}}


{{--                        <div>--}}
{{--                            <x-label for="path_attachment_file" value="Attachment (PDF, Docx)" :required="true"/>--}}
{{--                            <x-input id="path_attachment_file" name="path_attachment_file" class="block mt-1 w-full mt-3" type="file"/>--}}
{{--                        </div>--}}


{{--                        <div class="flex items-center justify-end mt-2">--}}
{{--                            <x-button class="ml-4 bank-green-bg" id="submit-btn"> {{ __('Add') }} </x-button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}



                <div class="prose max-w-full" style="padding-left: 10px;padding-right: 10px;">
                    {!! $agendaItems->description !!}
                </div>

{{--                    <div style="padding-left: 10px;padding-right: 10px; text-align: center; ">--}}

{{--                        @if(!empty($meeting->path_attachment))--}}
{{--                        <a href="{{ \Illuminate\Support\Facades\Storage::url($meeting->path_attachment)  }}"--}}
{{--                           class="text-red-700 inline-flex border-1 border-blue-500" target="_blank">--}}
{{--                            --}}{{----}}{{--                                            <img src="https://img.icons8.com/?size=160&id=115364&format=png"--}}
{{--                            --}}{{----}}{{--                                                 alt="Attachment" class="w-12 h-12 mx-auto" >--}}
{{--                            <x-label value="Meeting Attachment View / Download" style="font-size: 16px; font-weight: bold; color: red " class="pb-2 font-extrabold text-blue-300 hover:underline"/>--}}
{{--                        </a>--}}
{{--                        <div>--}}
{{--                            @else--}}
{{--                                #N/A--}}
{{--                            @endif--}}

{{--                            <form method="POST" action="{{ route('comment.store', $meeting->id) }}" enctype="multipart/form-data" class="print:hidden">--}}
{{--                                @csrf--}}
{{--                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-4 pl-8 pb-4 pt-4 pr-8">--}}
{{--                                    <div>--}}
{{--                                        <x-label for="description" value="Description" :required="true"/>--}}
{{--                                        <x-input id="description" name="description" class="block mt-1 w-full" type="text" required value="{{ old('title') }}"/>--}}
{{--                                    </div>--}}

{{--                                    <div>--}}
{{--                                        <x-label for="path_attachment_file" value="Attachment (PDF, Docx)" :required="true"/>--}}
{{--                                        <x-input id="path_attachment_file" name="path_attachment_file" class="block mt-1 w-full mt-3" type="file"/>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}

{{--                                    </div>--}}

{{--                                    <div class="flex items-center justify-end mt-2">--}}
{{--                                        <x-button class="ml-4 bank-green-bg" id="submit-btn"> {{ __('Add') }} </x-button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}

{{--                            <hr>--}}
{{--                            @if($meeting->comments->isNotEmpty())--}}
{{--                                <table style="margin-top: 10px; font-size:14px;text-align: center; border: 1px solid black;">--}}
{{--                                    <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="3" style="border: 1px solid black;font-size:18px;font-weight: bold; " class="py-2">--}}
{{--                                            Annexure / Other Documents--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

{{--                                    <tr>--}}
{{--                                        <td style="border: 1px solid black; " class="py-2 font-bold">--}}
{{--                                            Description--}}
{{--                                        </td>--}}
{{--                                        <td style="border: 1px solid black; " class="py-2 font-bold">--}}
{{--                                            Attachment--}}
{{--                                        </td>--}}
{{--                                        @can('meeting-edit')--}}
{{--                                            <td style="border: 1px solid black; " class="py-2 font-bold">--}}
{{--                                                Action--}}
{{--                                            </td>--}}
{{--                                        @endcan--}}
{{--                                    </tr>--}}


{{--                                    @foreach($meeting->comments->sortBy('created_at') as $cmt)--}}
{{--                                        <tr>--}}
{{--                                            <td style="border: 1px solid black;">--}}
{{--                                                {{ $cmt->description }}--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center" style="border: 1px solid black;">--}}
{{--                                                <a href="{{ \Illuminate\Support\Facades\Storage::url($cmt->path_attachment) }}" class="inline-flex " target="_blank">--}}
{{--                                                    <img--}}
{{--                                                        src="https://img.icons8.com/?size=128&id=43996&format=png"--}}
{{--                                                        alt="download" class="w-8 h-8">--}}

{{--                                                </a>--}}
{{--                                            </td>--}}

{{--                                            @can('meeting-edit')--}}
{{--                                                <td class="text-center" style="border: 1px solid black;">--}}
{{--                                                    <form action="{{ route('comment.destroy', $cmt->id) }}" method="post" class="inline">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button type="submit"--}}
{{--                                                                class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">--}}
{{--                                                            Delete--}}
{{--                                                            --}}{{--                                                        <img src="https://img.icons8.com/?size=160&id=102350&format=png" alt=""  class="w-8 h-8">--}}

{{--                                                        </button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            @endcan--}}
{{--                                        </tr>--}}

{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            @endif--}}

{{--                        </div>--}}
{{--                    </div>--}}


            </div>
        </div>
    </div>
</x-app-layout>
