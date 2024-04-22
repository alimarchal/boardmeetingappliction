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

    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Meeting Minutes') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('meeting-minutes.update', $meetingMinutes->id) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-label for="meeting_id" value="{{ __('Meeting') }}" />
                            <select name="meeting_id" id="meeting_id" class="block mt-1 w-full" required>
                                <option value="">Select a meeting</option>
                                @foreach ($meetings as $meeting)
                                    <option value="{{ $meeting->id }}" {{ $meetingMinutes->meeting_id == $meeting->id ? 'selected' : '' }}>
                                        {{ $meeting->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="content" value="{{ __('Content') }}" />
                            <textarea name="content" id="content" rows="5" class="block mt-1 w-full" required>{{ $meetingMinutes->content }}</textarea>
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
