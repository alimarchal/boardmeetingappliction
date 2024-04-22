<x-app-layout>'

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight inline-block">
            {{ __('Meetings') }}
        </h2>

        <div class="flex justify-center items-center float-right">

            <a href="{{ route('meeting.create') }}" class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2">
                <svg data-slot="icon" fill="none" class="h-6 w-6" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
            </a>



            <a href="javascript:;" id="toggle"
               class="flex items-center px-4 py-2 text-gray-600 bg-white border rounded-lg focus:outline-none hover:bg-gray-100 transition-colors duration-200 transform dark:text-gray-200 dark:border-gray-200  dark:hover:bg-gray-700 ml-2"
               title="Members List">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
            </a>

        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto px-4 sm:px-2 lg:px-8 print:hidden " style="display: none" id="filters">
        <div class="rounded-xl p-4 bg-white shadow-lg">
            <form method="GET" action="{{ route('meeting.index') }}">
                <div class="mt-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <x-label for="id" value="{{ __('UUID') }}" />
                        <x-input id="id" class="block mt-1 w-full" type="text" name="filter[id]" value="{{ request('filter.id') }}" />
                    </div>

                    <div>
                        <x-label for="title" value="{{ __('Title') }}" />
                        <x-input id="title" class="block mt-1 w-full" type="text" name="filter[title]" value="{{ request('filter.title') }}" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <x-label for="description" value="{{ __('Description') }}" />
                        <x-input id="description" class="block mt-1 w-full" type="text" name="filter[description]" value="{{ request('filter.description') }}" />
                    </div>




                </div>

                <div class="mt-4">
                    <x-button class="bg-indigo-500 text-white">
                        {{ __('Apply Filters') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>

    <div class="py-3">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($meetings->isNotEmpty())
                    <div class="relative overflow-x-auto rounded-lg ">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-white bank-green-bg uppercase text-sm" >
                                <th class="py-2 px-2 text-center">ID</th>
                                <th class="py-2 px-2 text-center">Meeting Title</th>
                                <th class="py-2 px-2 text-center">Attachment</th>
                                <th class="py-2 px-2 text-center">Created At</th>
                                <th class="py-2 px-2 text-center">Status</th>
                                <th class="py-2 px-2 text-center">Action</th>
                            </tr>
                            </thead>
                            @foreach($meetings as $mt)
                                <tbody class="text-black text-md leading-normal ">
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-1 px-2 text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="py-1 px-2 text-center">
                                        {{ $mt->title }}
                                    </td>
                                    <td class="py-1 px-2 text-center">

                                        @if(!empty($mt->path_attachment))
                                            <a href="{{ \Illuminate\Support\Facades\Storage::url($mt->path_attachment)  }}"  class="inline-flex" target="_blank">
                                                <img src="https://img.icons8.com/?size=128&id=48139&format=png" alt="Show" class="w-6 h-6">
{{--                                                <svg data-slot="icon" fill="none"  class="w-6 h-6 mx-auto" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">--}}
{{--                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"></path>--}}
{{--                                                </svg>--}}
                                            </a>
                                        @endif

                                    </td>
                                    <td class="py-1 px-2 text-center">
                                        {{ \Carbon\Carbon::parse($mt->created_at)->diffForHumans() }}
                                    </td>


                                    <td class="py-1 px-2 text-center">

                                        @if($mt->status == "Lock")
{{--                                            <img src="https://img.icons8.com/?size=160&id=WLP4hL0DancH&format=png"--}}
{{--                                                 alt="Lock"  class="w-8 h-8 mx-auto">--}}
                                            Lock
                                        @elseif($mt->status == "Unlock")
{{--                                            <img src="https://img.icons8.com/?size=160&id=8tvYaTgoZNSg&format=png"--}}
{{--                                                 alt="Lock"  class="w-8 h-8 mx-auto">--}}
                                            Un-Lock
                                        @endif
                                    </td>

                                    <td class="py-1 px-2 text-center">

                                        <a href="{{ route('meeting.edit', $mt->id) }}" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">

                                            Edit
{{--                                            <img src="https://img.icons8.com/?size=160&id=64058&format=png" alt="Edit" class="w-8 h-8">--}}
{{--                                            <svg data-slot="icon" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>--}}
{{--                                            </svg>--}}
                                        </a>

                                        <a href="{{ route('meeting.show', $mt->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            View
{{--                                            <img src="https://img.icons8.com/?size=128&id=119220&format=png" alt="Show" class="w-8 h-8">--}}
{{--                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />--}}
{{--                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />--}}
{{--                                            </svg>--}}
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @push('modals')
        <script>

            const targetDiv = document.getElementById("filters");
            const btn = document.getElementById("toggle");
            btn.onclick = function () {
                if (targetDiv.style.display !== "none") {
                    targetDiv.style.display = "none";
                } else {
                    targetDiv.style.display = "block";
                }
            };

            function redirectToLink(url) {
                window.location.href = url;
            }
        </script>
    @endpush
</x-app-layout>
