<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Create
        </h2>
    </x-slot>

    <x-form::container method="POST" :action="route('users.store')">
        <x-slot:content >
            <x-form::divider>
                <x-slot:title>Profile</x-slot:title>
            </x-form::divider>

            <x-form::field>
                <x-slot:title>Name</x-slot:title>

                <x-jet-input name="name" class="block mt-1" style="width: 70%;" type="text" :value="old('name')" required autofocus autocomplete="name"/>
                <x-jet-input-error for="name"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Email</x-slot:title>

                <x-jet-input name="email" class="block mt-1" style="width: 70%;" type="email" :value="old('email')" required/>
                <x-jet-input-error for="email"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Password</x-slot:title>

                <x-jet-input name="password" class="block mt-1" style="width: 70%;" type="password" required autocomplete="new-password" />
                <x-jet-input-error for="password"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Confirm Password</x-slot:title>

                <x-jet-input name="password_confirmation" class="block mt-1" style="width: 70%;" type="password" required autocomplete="new-password" />
            </x-form::field>

            <x-form::footer>
                <x-form::button title="Go back" type="secondary" :link="route('users.index')" />
                <x-form::button title="Add" type="primary" />
            </x-form::footer>
            </x-slot>
    </x-form::container>
</x-app-layout>
