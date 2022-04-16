<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Resident Management') }}
                </h2>
            </div>

            <div class="">
                <x-form::button title="Create" type="primary" :link="route('residents.create')" />
            </div>
        </div>
    </x-slot>

    <livewire:resident.resident-table />
</x-app-layout>
