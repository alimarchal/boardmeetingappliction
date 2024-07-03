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
                border: 1px solid;
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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meetings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="ml-4 mt-4"/>
                <x-validation-errors class="ml-4 mt-4"/>
                <form method="POST" action="{{ route('meeting.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4 pl-8 pb-4 pt-4 pr-8">

                        <div>
                            <x-label for="me_id" value="Meeting No"  class="block mt-1 w-full"  :required="true"/>
                            <select name="me_id" id="me_id" class="border-gray-300 mt-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                                <option value="">None</option>
                                @for($i = 1; $i <= 100; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>


                        <div>
                            <x-label for="title" value="Meeting Title" :required="true"/>
                            <x-input id="title" name="title" class="block mt-1 w-full" type="text" required value="{{ old('title') }}"/>
                        </div>


                        <div>
                            <x-label for="date_and_time" value="Date & Time" :required="true"/>
                            <x-input id="date_and_time" name="date_and_time" class="block mt-1 w-full" type="datetime-local" required value="{{ old('date_and_time') }}"/>
                        </div>


                        <div>
                            <x-label for="location" value="Location" :required="true"/>
                            <x-input id="location" name="location" class="block mt-1 w-full" type="text" required value="{{ old('location') }}"/>
                        </div>


                        <div>
                            <x-label for="meeting_status" value="Meeting Status"  class="block mt-1 w-full"  :required="true"/>
                            <select name="meeting_status" id="meeting_status" class="border-gray-300 mt-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
                                <option value="">None</option>
                                <option value="Manual">Manual</option>
                                <option value="Digital" selected>Digital</option>
                            </select>
                        </div>


                        <div>
                            <x-label for="description" value="Description" :required="true" class="pb-2"/>
                            <textarea class="block mt-1 w-full" name="description">{{ old('description') }}</textarea>
                        </div>

{{--                        <div>--}}
{{--                            <x-label for="path_attachment_file" value="Attachment (PDF, Docx)" :required="true" />--}}
{{--                            <x-input id="path_attachment_file" name="path_attachment_file" class="block mt-1 w-full" type="file"/>--}}
{{--                        </div>--}}

                        <div class="flex items-center justify-end mt-2">
                            <x-button class="ml-4 bank-green-bg" id="submit-btn"> {{ __('Create') }} </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
