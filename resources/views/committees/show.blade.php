<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Committee Details') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg pt-4 pb-2 px-8">
                <div class="relative z-10">
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-bold">{{ $committee->name }}</h3>
                        <p class="text-lg">{{ $committee->type }}</p>
                        <p class="text-sm text-gray-500">Created on: {{ $committee->created_at->format('d-M-Y') }}</p>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-xl font-semibold mb-2">Members</h4>
                        <ul class="list-disc list-inside">
                            @forelse($committee->members ?? [] as $member)
                                <li>
                                    {{ $member->user->name }} ({{ $member->position ?? 'No Position' }})</li>
                            @empty
                                <li class="text-gray-500">No members found.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-xl font-semibold mb-2">Meetings</h4>
                        <ul class="list-disc list-inside">
                            @forelse($committee->meetings() ?? [] as $meeting)
                                <li>{{ \Carbon\Carbon::parse($meeting->meeting_date)->format('d-M-Y H:i') }} - {{ $meeting->title }}</li>
                            @empty
                                <li class="text-gray-500">No meetings scheduled.</li>
                            @endforelse
                        </ul>
                    </div>

{{--                    @can('meeting-create')--}}
{{--                        <x-validation-errors />--}}
{{--                        <x-status-message/>--}}
{{--                        <form method="POST" action="{{ route('committees.addMeeting', $committee->id) }}" class="mt-6">--}}
{{--                        <form method="POST" action="#" class="mt-6">--}}
{{--                            @csrf--}}
{{--                            <div class="grid grid-cols-1 gap-4">--}}
{{--                                <div>--}}
{{--                                    <x-label for="meeting_date" value="Meeting Date" />--}}
{{--                                    <x-input id="meeting_date" name="meeting_date" type="datetime-local" class="block mt-1 w-full" value="{{ old('meeting_date') }}" />--}}
{{--                                </div>--}}

{{--                                <div>--}}
{{--                                    <x-label for="title" value="Title" />--}}
{{--                                    <x-input id="title" name="title" type="text" class="block mt-1 w-full" value="{{ old('title') }}" />--}}
{{--                                </div>--}}

{{--                                <div class="flex items-center justify-end">--}}
{{--                                    <x-button class="ml-4 bank-green-bg">Add Meeting</x-button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    @endcan--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
