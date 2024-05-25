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

            <a href="{{ route('meeting.show', $meeting->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden  sm:rounded-lg pt-4 pb-2 ">


                <table style="margin: 0px;">
                    <tr>
                        <td style="width: 33.33%">
                            <div style="float: left; margin-left: 10%">
                                @php $test_report_data = $meeting->slug . ' Board Meeting '. "\n". $meeting->id . "\n" . \Carbon\Carbon::parse($meeting->date_and_time)->format('d-M-Y H:i:s')  . "\n" . \Illuminate\Support\Facades\Auth::user()->id ; @endphp
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
                            Date & Time: {{ \Carbon\Carbon::parse($meeting->date_and_time)->format('d-M-Y H:i:s') }} PST <span style="font-size: 5px;">{{\Illuminate\Support\Facades\Auth::user()->id}}</span>
                            <br>
                            <span style="font-size: 14px;">MUID: {{ $meeting->id }}-{{\Illuminate\Support\Facades\Auth::user()->id}}</span>
                            <br>
                            {{--                                        Created At :: {{ \Carbon\Carbon::parse($meeting->created_at)->format('d-m-Y H:i:s a') }}--}}
                        </td>
                    <tr style="text-align: left!important;">
                        <td>
                            <span style=" text-align: left;">Agenda: {{ $agendaItems->title }}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>




                <hr style="border: 1px solid black!important;" class="my-4">
                <div class="prose max-w-full" style="margin-top: 15px;padding-left: 30px;padding-right: 30px;">
                    {!! $agendaItems->description !!}
                </div>



                @if($agendaItems->comments->isNotEmpty())
                    <h2 class="text-2xl text-center mb-4 mt-4 font-bold text-black ">Meeting Agenda Attachments / Documents / Comments</h2>
                    <div class="relative overflow-x-auto ">

                        <x-status-message class="ml-4 mt-4"/>
                        <x-validation-errors class="ml-4 mt-4"/>

                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-white  uppercase text-sm" style="background-color: #f78f1e;">
                                <th class="py-2 px-2 text-center">ID</th>
                                <th class="py-2 px-2 text-center">Added By</th>
                                <th class="py-2 px-2 text-center">Title</th>
                                <th class="py-2 px-2 text-center">Attachment</th>
                                @can('agenda-item-delete')
                                <th class="py-2 px-2 text-center print:hidden">Action</th>
                                    @endcan
                            </tr>
                            </thead>
                            @foreach($agendaItems->comments->sortBy('created_at') as $cmt)
                                <tbody class="text-black text-sm leading-normal ">
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-1 px-2 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="py-1 px-2 text-center">
                                        {{ $cmt->user?->name }}
                                    </td>
                                    <td class="py-1 px-2 text-center">
                                        {{ $cmt->description }}
                                    </td>
                                    <td class="py-1 px-2 text-center">

                                        @if(!empty($cmt->path_attachment))
                                            <a href="{{ \Illuminate\Support\Facades\Storage::url($cmt->path_attachment)  }}"  class="inline-flex" target="_blank">
{{--                                                <img src="https://img.icons8.com/?size=128&id=48139&format=png" alt="Show" class="w-6 h-6">--}}
                                                <svg data-slot="icon" fill="none"  class="w-6 h-6 mx-auto" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"></path>
                                                </svg>
                                            </a>
                                        @endif

                                    </td>
                                    @can('agenda-item-delete')
                                    <td class="py-1 px-2 text-center print:hidden">


                                            <form action="{{ route('meeting.agendaItem.comment.destroy', [$agendaItems->id, $cmt->id]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                                            </form>

                                    </td>
                                    @endcan
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                @endif


                @can('agenda-item-add-attachment')
                    <form method="POST" action="{{ route('meeting.agendaItem.comment.store', [$meeting->id, $agendaItems->id]) }}" enctype="multipart/form-data" class="print:hidden">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-4 pl-8 pb-4 pt-4 pr-8">
                            <div>
                                <x-label for="description" value="Description" :required="true"/>
                                <x-input id="description" name="description" class="block mt-1 w-full" type="text" required value="{{ old('title') }}"/>
                            </div>

                            <div>
                                <x-label for="path_attachment_file" value="Attachment (PDF, Docx)" :required="true"/>
                                <x-input id="path_attachment_file" name="path_attachment_file" class="block mt-1 w-full mt-3" type="file"/>
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-2 mr-2 mb-2">
                            <x-button class="ml-4 bank-green-bg" id="submit-btn"> {{ __('Add') }} </x-button>
                        </div>
                    </form>
                @endcan



            </div>
        </div>
    </div>
</x-app-layout>
