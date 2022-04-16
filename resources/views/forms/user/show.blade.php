<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $user->name }}
        </h2>
    </x-slot>

    <x-form::container>
        <x-slot:content>
            <x-form::divider>
                <x-slot:title>Profile</x-slot:title>
            </x-form::divider>

            <x-form::field>
                <x-slot:title>User ID</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 35%;" :disabled="true" type="text" value="{{ $user->id }}"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Name</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true" type="text" value="{{ $user->name }}"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Email</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true" type="text" value="{{ $user->email }}"/>
            </x-form::field>
           
            <x-form::field>
                <x-slot:title>Activated</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 10%;" :disabled="true" type="text" value="{{ $user->activationStatus }}"/>
            </x-form::field>
           
            <x-form::field>
                <x-slot:title>Created At</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 40%;" :disabled="true" type="text" value="{{ $user->created_at }}"/>
            </x-form::field>
           
            <x-form::field>
                <x-slot:title>Last Modified</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 40%;" :disabled="true" type="text" value="{{ $user->updated_at }}"/>
            </x-form::field>

            <x-form::footer>
                <x-form::button title="Go back" type="secondary" :link="route('users.index')"/>
            </x-form::footer>
        </x-slot>
    </x-form::container>
</x-app-layout>
