<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('User Management') }}
                </h2>
            </div>

            <div class="">
                <x-form::button title="Create" type="primary" :link="route('users.create')" />
            </div>
        </div>
    </x-slot>

    <livewire:user.user-table />
</x-app-layout>
