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
                    <form method="POST" action="{{ route('agenda-items.update', $agendaItem) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="meeting_id" value="{{ __('Meeting') }}" />
                            <select name="meeting_id" id="meeting_id" class="block mt-1 w-full" required>
                                <option value="">Select a meeting</option>
                                @foreach ($meetings as $meeting)
                                    <option value="{{ $meeting->id }}" {{ $agendaItem->meeting_id == $meeting->id ? 'selected' : '' }}>
                                        {{ $meeting->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="title" value="{{ __('Title') }}" />
                            <x-input id="title" name="title" class="block mt-1 w-full" type="text" required value="{{ $agendaItem->title }}" />
                        </div>

                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <textarea name="description" id="description" rows="5" class="block mt-1 w-full" required>{{ $agendaItem->description }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="order" value="{{ __('Order') }}" />
                            <x-input id="order" name="order" class="block mt-1 w-full" type="number" required value="{{ $agendaItem->order }}" />
                        </div>

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
