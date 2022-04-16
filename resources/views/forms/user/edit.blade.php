<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <x-form::container :action="route('users.update', $user)">
        <x-slot:subMethod>
            @method("PUT")
        </x-slot:subMethod>

        <x-slot:content>
            <x-form::divider>
                <x-slot:title>Profile</x-slot:title>
            </x-form::divider>

            <x-form::field>
                <x-slot:title>User ID</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 35%;" :disabled="true" type="text"
                    value="{{ $user->id }}" />
            </x-form::field>

            <x-form::field>
                <x-slot:title>Name</x-slot:title>

                <x-jet-input name="name" class="block mt-1" style="width: 70%;" type="text" :value="old('name') ? old('name') : $user->name" />
                <x-jet-input-error for="name"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Email</x-slot:title>

                <x-jet-input name="email" class="block mt-1" style="width: 70%;" type="email" :value="old('email') ? old('email') : $user->email" />
                <x-jet-input-error for="email"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Activate</x-slot:title>

                <x-form::select-input name="active" title="status" style="width: 70%;">
                    @foreach ($statuses as $key => $status)
                        <option value="{{ $key }}" @if ($key == $user->active) selected @endif>{{ $status }}</option>
                    @endforeach
                </x-form::select-input>
                <x-jet-input-error for="active"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Created At</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 40%;" :disabled="true" type="text"
                    value="{{ $user->created_at }}" />
            </x-form::field>

            <x-form::field>
                <x-slot:title>Last Modified</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 40%;" :disabled="true" type="text"
                    value="{{ $user->updated_at }}" />
            </x-form::field>

            <x-form::footer>
                <x-form::button title="Go back" type="secondary" :link="route('users.index')" />
                <x-form::button title="Update" type="primary" />
            </x-form::footer>
            </x-slot>
    </x-form::container>
</x-app-layout>
