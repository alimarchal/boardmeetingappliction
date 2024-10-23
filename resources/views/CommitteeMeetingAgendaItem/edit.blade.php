<x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Agenda Item') }}
            </h2>
            @push('header')
                <script src="https://cdn.tiny.cloud/1/izbyerk8x92uls8z2ulnezm5uaudhf41lw0lebop5ba724o5/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: 'textarea',
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    });
                </script>
            @endpush
        </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-status-message class="ml-4 mt-4"/>
                <x-validation-errors class="ml-4 mt-4"/>
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Adjusted form action to pass committeeMeeting and agendaItem for update -->
                    <form method="POST" action="{{ route('committee_meeting.agenda_item.update', [$committeeMeeting->id, $committeeMeetingAgendaItem->id]) }}">
                        @csrf
                        @method('PUT') <!-- Since we are editing, we use PUT method -->

                        <!-- Committee Meeting (read-only, as it's already associated) -->
                        <div>
                            <x-label for="committee_meeting_id" value="{{ __('Committee Meeting') }}" />
                            <x-input id="committee_meeting_id" value="{{ $committeeMeeting->title }}" class="block mt-1 w-full" type="text" disabled />
                            <input type="hidden" name="committee_meeting_id" value="{{ $committeeMeeting->id }}" />
                        </div>

                        <!-- Agenda Item Title (pre-filled with existing value) -->
                        <div class="mt-4">
                            <x-label for="title" value="{{ __('Title') }}" />
                            <x-input id="title" name="title" class="block mt-1 w-full" type="text" value="{{ $committeeMeetingAgendaItem->title }}" required />
                        </div>

                        <!-- Agenda Item Description (pre-filled with existing value) -->
                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <textarea name="description" id="description" rows="5" class="block mt-1 w-full" required>{{ $committeeMeetingAgendaItem->description }}</textarea>
                        </div>

                        <!-- Agenda Item Order (pre-filled with existing value) -->
                        <div class="mt-4">
                            <x-label for="order" value="{{ __('Order') }}" />
                            <x-input id="order" name="order" class="block mt-1 w-full" type="number" value="{{ $committeeMeetingAgendaItem->order }}" required />
                        </div>

                        <!-- Hidden User ID (auto-filled) -->
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}" />

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
