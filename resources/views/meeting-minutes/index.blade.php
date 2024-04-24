<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
            {{ __('Meeting Minutes') }}
        </h2>

        <div class="flex justify-center items-center float-right">

            <a href="{{ route('meeting-minutes.create') }}" class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2">
                <svg data-slot="icon" fill="none" class="h-6 w-6" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                @if($meetingMinutes->isNotEmpty())
                    <div class="relative overflow-x-auto rounded-lg ">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-white bank-green-bg uppercase text-sm" >
                                <th class="py-2 px-2 text-center">Meeting</th>
                                <th class="py-2 px-2 text-center">Created At</th>
                                <th class="py-2 px-2 text-center">Actions</th>
                            </tr>
                            </thead>
                            @foreach($meetingMinutes as $mm)
                                <tbody class="text-black text-md leading-normal ">
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-1 px-2 text-center">
                                        {{ $mm->meeting->title }}
                                    </td>
                                    <td class="py-1 px-2 text-center">
                                        {{ $mm->created_at->format('Y-m-d H:i:s') }}
                                    </td>
                                    <td class="py-1 px-2 text-center">
                                        @can('meeting-minutes-edit')
                                            <a href="{{ route('meeting-minutes.edit', $mm->id) }}" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('meeting-minutes-view')
                                            <a href="{{ route('meeting-minutes.show', $mm->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                View
                                            </a>
                                        @endcan


                                        @can('meeting-minutes-delete')
                                            <form action="{{ route('meeting-minutes.destroy', $mm->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                @endif

{{--                <div class="p-6 bg-white border-b border-gray-200">--}}
{{--                    <a href="{{ route('meeting-minutes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 mb-4">--}}
{{--                        {{ __('Create Meeting Minutes') }}--}}
{{--                    </a>--}}

{{--                    <table class="min-w-full divide-y divide-gray-200">--}}
{{--                        <thead class="bg-gray-50">--}}
{{--                        <tr>--}}
{{--                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                Meeting--}}
{{--                            </th>--}}
{{--                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                Created At--}}
{{--                            </th>--}}
{{--                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">--}}
{{--                                Actions--}}
{{--                            </th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody class="bg-white divide-y divide-gray-200">--}}
{{--                        @foreach ($meetingMinutes as $minutes)--}}
{{--                            <tr>--}}
{{--                                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                    {{ $minutes->meeting->title }}--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                    {{ $minutes->created_at->format('Y-m-d H:i:s') }}--}}
{{--                                </td>--}}
{{--                                <td class="px-6 py-4 whitespace-nowrap">--}}
{{--                                    <a href="{{ route('meeting-minutes.show', $minutes->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">View</a>--}}
{{--                                    <a href="{{ route('meeting-minutes.edit', $minutes->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>--}}
{{--                                    <form action="{{ route('meeting-minutes.destroy', $minutes->id) }}" method="POST" class="inline">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</x-app-layout>
