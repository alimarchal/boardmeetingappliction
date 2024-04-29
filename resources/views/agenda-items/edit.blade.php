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
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('meeting.agenda-item.update', [$meeting->id, $agendaItems->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mt-4">
                            <x-label for="title" value="{{ __('Title') }}" />
                            <x-input id="title" name="title" class="block mt-1 w-full" type="text" required value="{{ $agendaItems->title }}" />
                        </div>

                        <div class="mt-4">
                            <x-label for="description" value="{{ __('Description') }}" />
                            <textarea name="description" id="description" rows="5" class="block mt-1 w-full" required>{{ $agendaItems->description }}</textarea>
                        </div>


                        <div class="mt-4">
                            <x-label for="order" value="{{ __('Order (the order in which the agenda items should be discussed)') }}" />
                            <select name="order" id="order" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" @if($i == old('order',$agendaItems->order)) selected @endif>{{ $i }}</option>
                                @endfor

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
