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
                padding-left: 5px;
            }

            table {
                width: 100%;
                font-size: 12px;
                border-collapse: collapse;
            }

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
            {{ __('Meeting / ' . $committeeMeeting->slug . ' ' . $committeeMeeting->title) }}
        </h2>

        <div class="flex justify-center items-center float-right">
            <a href="{{ route('committee_meeting.show', $committeeMeeting->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Back
            </a>

            <a href="javascript:;" id="toggle" onclick="window.print()"
               class="flex items-center px-3 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200 dark:hover:bg-gray-700 ml-2"
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
                <div class="p-0.5 whitespace-nowrap">Board Meeting {{ $committeeMeeting->me_id }} : <span style="font-size: 2px;"> {{ Auth::user()->id }}</span></div>
            @endfor
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg pt-4 pb-2 ">
                <div class="relative z-10">
                    <table style="margin: 0px;">
                        <tr>
                            <td style="width: 33.33%">
                                <div style="float: left; margin-left: 10%">
                                    @php
                                        $test_report_data = $committeeMeeting->slug . ' Board Meeting ' . "\n" . $committeeMeeting->id . "\n" . \Carbon\Carbon::parse($meeting->date_and_time)->format('d-M-Y H:i:s')  . "\n" . Auth::user()->id;
                                    @endphp
                                    {!! DNS2D::getBarcodeSVG($test_report_data, 'QRCODE', 3, 3) !!}
                                </div>
                            </td>
                            <td style="width: 33.33%">
                                <img src="{{ url('images/logo.png') }}" alt="Logo" style="margin:auto; height: 100px;">
                            </td>
                            <td style="width: 33.33%; text-align: center;">
                                <div style="margin: auto; margin-left: 30%"></div>
                            </td>
                        </tr>
                    </table>

                    <table style="margin-top: 10px; font-size:18px; line-height: 1.2; text-align: center; font-weight: bold;">
                        <tbody>
                            <tr>
                                <td>
                                    {{ $committeeMeeting->slug }} {{ $committeeMeeting->title }}
                                    <br>
                                    {{ $committeeMeeting->location }} <br>
                                    Date & Time: {{ \Carbon\Carbon::parse($committeeMeeting->date_and_time)->format('d-M-Y H:i:s') }} <sub>PST <span style="font-size: 3px;margin: 0px; padding: 0px;">{{ Auth::user()->id }}</span></sub>
                                    <br>
                                    <span style="font-size: 14px;">MUID: {{ $committeeMeeting->id }}-{{ Auth::user()->id }}</span>
                                    <br>
                                </td>
                            </tr>
                            <tr style="text-align: left!important;">
                                <td>
                                    <span style="text-align: left;">Agenda: {{ $committee_meeting_agenda_items->title }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr style="border: 1px solid black!important;" class="my-4">
                    <div class="prose max-w-full" style="margin-top: 15px;padding-left: 30px;padding-right: 30px;">
                        {!! $committee_meeting_agenda_items->description !!}
                    </div>

                    @if($committee_meeting_agenda_items->comments->isNotEmpty())
                        <h2 class="text-2xl text-center mb-4 mt-4 font-bold text-black">Meeting Agenda Attachments / Documents / Comments</h2>
                        <div class="relative overflow-x-auto">
                            <x-status-message class="ml-4 mt-4"/>
                            <x-validation-errors class="ml-4 mt-4"/>

                            <table class="min-w-full border border-gray-300">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 px-4 py-2 text-left">Document Name</th>
                                        <th class="border-b-2 px-4 py-2 text-left">Description</th>
                                        <th class="border-b-2 px-4 py-2 text-left">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($committee_meeting_agenda_items->comments as $comment)
                                        <tr>
                                            <td class="border-b px-4 py-2">{{ $comment->document_name }}</td>
                                            <td class="border-b px-4 py-2">{{ $comment->description }}</td>
                                            <td class="border-b px-4 py-2">{{ $comment->comment }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('committee_meeting.store.agenda.item', $committeeMeeting->id) }}">
                        @csrf
                        <div class="my-4">
                            <label for="title" class="block text-gray-700">Title</label>
                            <input type="text" name="title" id="title" required class="w-full border rounded-md px-2 py-1">
                        </div>
                        <div class="my-4">
                            <label for="description" class="block text-gray-700">Description</label>
                            <textarea name="description" id="description" required class="w-full border rounded-md px-2 py-1"></textarea>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Add Agenda Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
