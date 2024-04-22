<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Attendance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('attendance.update', $attendance) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="meeting_id" value="{{ __('Meeting') }}" />
                            <select name="meeting_id" id="meeting_id" class="block mt-1 w-full" required>
                                <option value="">Select a meeting</option>
                                @foreach ($meetings as $meeting)
                                    <option value="{{ $meeting->id }}" {{ $attendance->meeting_id == $meeting->id ? 'selected' : '' }}>
                                        {{ $meeting->slug }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="user_id" value="{{ __('BAJK Board Member') }}" />
                            <select name="user_id" id="user_id" class="block mt-1 w-full" required>
                                <option value="">Select a member</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $attendance->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="status" value="{{ __('Status') }}" />
                            <select name="status" id="status" class="block mt-1 w-full" required>
                                <option value="">Select a status</option>
                                <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                                <option value="excused" {{ $attendance->status == 'excused' ? 'selected' : '' }}>Excused</option>
                            </select>
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
