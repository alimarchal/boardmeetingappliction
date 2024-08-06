<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Committee') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-status-message class="ml-4 mt-4"/>
                <x-validation-errors class="ml-4 mt-4"/>
                <form method="POST" action="{{ route('committees.update', $committee->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-4 mt-4 pl-8 pb-4 pt-4 pr-8">
                        <div>
                            <x-label for="name" value="Committee Name" :required="true"/>
                            <x-input id="name" name="name" class="block mt-1 w-full" type="text" required value="{{ $committee->name }}"/>
                        </div>

                        <div>
                            <x-label for="type" value="Committee Type" :required="true"/>
                            <x-input id="type" name="type" class="block mt-1 w-full" type="text" required value="{{ $committee->type }}"/>
                        </div>

                        <div>
                            <h3 class="font-semibold text-lg">Members</h3>
                            <div id="members">
                                @foreach($committee->members as $index => $member)
                                    <div class="flex items-center mt-2">
                                        <select name="members[{{ $index }}][user_id]" class="block mt-1 w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                            <option value="">Select a user</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $user->id == $member->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input name="members[{{ $index }}][position]" class="block mt-1 w-1/2 ml-2" type="text" placeholder="Position" required value="{{ $member->position }}" />
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addMember()" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Member</button>
                        </div>

                        <div class="flex items-center justify-end mt-2">
                            <x-button class="ml-4 bank-green-bg" id="submit-btn"> {{ __('Update') }} </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function addMember() {
            const memberCount = document.querySelectorAll('#members .flex').length;
            const membersDiv = document.getElementById('members');
            const newMember = `
                <div class="flex items-center mt-2">
                    <select name="members[${memberCount}][user_id]" class="block mt-1 w-1/2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">Select a user</option>
                        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
            </select>
            <x-input name="members[${memberCount}][position]" class="block mt-1 w-1/2 ml-2" type="text" placeholder="Position" required />
                </div>
            `;
            membersDiv.insertAdjacentHTML('beforeend', newMember);
        }
    </script>
</x-app-layout>
