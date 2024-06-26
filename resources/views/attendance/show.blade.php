<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendance Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Meeting</h3>
                            <p class="mt-1 text-gray-600">{{ $attendance->meeting->title }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">User</h3>
                            <p class="mt-1 text-gray-600">{{ $attendance->user->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Status</h3>
                            <p class="mt-1 text-gray-600">{{ $attendance->status }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Created At</h3>
                            <p class="mt-1 text-gray-600">{{ $attendance->created_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Updated At</h3>
                            <p class="mt-1 text-gray-600">{{ $attendance->updated_at->format('Y-m-d H:i:s') }}</p>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('attendance.edit', $attendance) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                            {{ __('Edit') }}
                        </a>
                        <form action="{{ route('attendance.destroy', $attendance) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
