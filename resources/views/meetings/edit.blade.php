<x-app-layout>
    @push('header')
        <script src="https://cdn.tiny.cloud/1/izbyerk8x92uls8z2ulnezm5uaudhf41lw0lebop5ba724o5/tinymce/6/tinymce.min.js"
                referrerpolicy="origin"></script>
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
                <form method="POST" action="{{ route('meeting.update', $meeting->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4 pl-8 pb-4 pt-4 pr-8">
                        <div>
                            <x-label for="title" value="Meeting Title" :required="true"/>
                            <x-input id="title" name="title" class="block mt-1 w-full" type="text" required value="{{ $meeting->title }}"/>
                        </div>



                        <div>
                            <x-label for="date_and_time" value="Date & Time" :required="true"/>
                            <x-input id="date_and_time" name="date_and_time" class="block mt-1 w-full" type="datetime-local" required value="{{ old('date_and_time',$meeting->date_and_time) }}"/>
                        </div>


                        <div>
                            <x-label for="location" value="Location" :required="true"/>
                            <x-input id="location" name="location" class="block mt-1 w-full" type="text" required value="{{ old('location',$meeting->location) }}"/>
                        </div>


                        <div>
                            <x-label for="description" value="Description" :required="true" class="pb-2"/>
                            <textarea class="block mt-1 w-full" name="description">{{ old('description',$meeting->description) }}</textarea>
                        </div>

                        <div>
                            <x-label for="path_attachment_file" value="Attachment (PDF, Docx)" :required="true"/>
                            <x-input id="path_attachment_file" name="path_attachment_file" class="block mt-1 w-full" type="file"/>
                        </div>

                        <div>
                            <x-label for="status" value="Status" :required="true" />
                            <select id="status" name="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                <option value="">Select a status</option>
                                <option value="Lock" @if($meeting->status == "Lock") selected @endif>Lock</option>
                                <option value="Unlock" @if($meeting->status == "Unlock") selected @endif>Unlock</option>
                            </select>
                        </div>


                        @if(!empty($meeting->path_attachment))
                            <div>
                                <x-label value="Existing Attachment" class="pb-2 font-extrabold text-red-700"/>
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($meeting->path_attachment)  }}"
                                   class="text-red-700 inline-flex border-1 border-blue-500" target="_blank">
                                    <svg data-slot="icon" fill="none" class="w-6 h-6 mx-auto" stroke-width="1.5"
                                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                         aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"></path>
                                    </svg>
                                </a>
                                <div>
                                    @else
                                        #N/A
                                    @endif


                                    <div class="flex items-center justify-end mt-2">
                                        <x-button class="ml-4 bank-green-bg" id="submit-btn"> {{ __('Update') }} </x-button>
                                    </div>
                                </div>

                            </div>
                    </div>
                </form>


            </div>
        </div>
</x-app-layout>
