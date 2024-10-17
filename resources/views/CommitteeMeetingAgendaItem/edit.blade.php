<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Agenda Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Adjusted form action to pass committeeMeeting and agendaItem for update -->
                    <form method="POST" action="{{ route('committee_meeting.agenda_item.update', ['committeeMeeting' => $committeeMeeting->id, 'agendaItem' => $committee_meeting_agenda_items->id]) }}">
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
                            <x-input id="title" name="title" class="block mt-1 w-full" type="text" value="{{ $committee_meeting_agenda_items->title }}" required />
                        </div>

                        <!-- Agenda Item Description (pre-filled with existing value) -->
                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <textarea name="description" id="description" rows="5" class="block mt-1 w-full" required>{{ $committee_meeting_agenda_items->description }}</textarea>
                        </div>

                        <!-- Agenda Item Order (pre-filled with existing value) -->
                        <div class="mt-4">
                            <x-label for="order" value="{{ __('Order') }}" />
                            <x-input id="order" name="order" class="block mt-1 w-full" type="number" value="{{ $committee_meeting_agenda_items->order }}" required />
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
