<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $resident->name }}
        </h2>
    </x-slot>

    <x-form::container method="POST" :action="route('residents.update', $resident)">
        <x-slot:subMethod>
            @method("PUT")
        </x-slot:subMethod>

        <x-slot:content >
            <x-form::divider>
                <x-slot:title>Personal Information</x-slot:title>
            </x-form::divider>

            <x-form::field>
                <x-slot:title>Resident ID</x-slot:title>

                <x-jet-input name="full_id" class="block mt-1 cursor-not-allowed" style="width: 70%;" readonly type="text" value="{{ $resident->full_id }}"/>
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Last Name</x-slot:title>

                <x-jet-input name="last_name" class="block mt-1" style="width: 70%;" type="text" :value="old('last_name') ? old('last_name') : $resident->last_name" required autofocus autocomplete="last_name"/>
                <x-jet-input-error for="last_name"/>
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>First Name</x-slot:title>

                <x-jet-input name="first_name" class="block mt-1" style="width: 70%;" type="text" :value="old('first_name') ? old('first_name') : $resident->first_name" required autofocus autocomplete="first_name"/>
                <x-jet-input-error for="first_name"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Middle Name</x-slot:title>

                <x-jet-input name="middle_name" class="block mt-1" style="width: 70%;" type="text" :value="old('middle_name') ? old('middle_name') : $resident->middle_name" autofocus autocomplete="middle_name"/>
                <x-jet-input-error for="middle_name"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>Suffix</x-slot:title>

                <x-jet-input name="suffix" class="block mt-1" style="width: 70%;" type="text" :value="old('suffix') ? old('suffix') : $resident->suffix" autofocus autocomplete="suffix"/>
                <x-jet-input-error for="suffix"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title :required="true">Gender</x-slot:title>

                <x-form::select-input name="gender" title="gender" style="width: 70%;" required>
                    @foreach ($genders as $key => $gender)
                        <option value="{{ $key }}" @if ($key == old('gender') ? old('gender') : $resident->gender) selected @endif>{{ $gender }}</option>
                    @endforeach
                </x-form::select-input>
                <x-jet-input-error for="gender"/>
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Place Of Birth</x-slot:title>

                <x-jet-input name="place_of_birth" class="block mt-1" style="width: 70%;" type="text" :value="old('place_of_birth') ? old('place_of_birth') : $resident->place_of_birth" required autofocus autocomplete="place_of_birth"/>
                <x-jet-input-error for="place_of_birth"/>
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Birthdate</x-slot:title>

                <x-jet-input name="birth_date" class="block mt-1" style="width: 70%;" type="date" :value="old('birth_date') ? old('birth_date') : $resident->birth_date" required autofocus autocomplete="birth_date"/>
                <x-jet-input-error for="birth_date"/>
            </x-form::field>

            <x-form::divider>
                <x-slot:title>Contact Information</x-slot:title>
                <x-slot:description></x-slot:description>
            </x-form::divider>

            <x-form::field>
                <x-slot:title>Email</x-slot:title>

                <x-jet-input name="email" class="block mt-1" style="width: 70%;" type="email" :value="old('email') ? old('email') : $resident->email" autofocus/>
                <x-jet-input-error for="email"/>
                <x-jet-label>Please use an active email.</x-jet-label>
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Contact Number</x-slot:title>

                <x-jet-input name="contact_number" class="block mt-1" style="width: 70%;" type="tel" :value="old('contact_number') ? old('contact_number') : $resident->contact_number" required autofocus/>
                <x-jet-input-error for="contact_number"/>
                <x-jet-label>Please use an active contact number.</x-jet-label>
            </x-form::field>

            <x-form::divider>
                <x-slot:title>Home Address Information</x-slot:title>
                <x-slot:description></x-slot:description>
            </x-form::divider>

            <x-form::field :required="true">
                <x-slot:title>{{ $houseNumberAlias }}</x-slot:title>

                <x-jet-input name="house_number" class="block mt-1" style="width: 70%;" type="text" :value="old('house_number') ? old('house_number') : $resident->house_number" required autofocus/>
                <x-jet-input-error for="house_number"/>
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Street Name</x-slot:title>

                <x-jet-input name="street" class="block mt-1" style="width: 70%;" type="text" :value="old('street') ? old('street') : $resident->street" required autofocus/>
                <x-jet-input-error for="street"/>
            </x-form::field>

            <x-form::field>
                <x-slot:title>{{ $areaAlias }}</x-slot:title>

                <x-jet-input name="area" class="block mt-1" style="width: 70%;" type="text" :value="old('area') ? old('area') : $resident->area" autofocus/>
                <x-jet-input-error for="area"/>
            </x-form::field>

            <x-form::footer>
                <x-form::button title="Go back" type="secondary" :link="route('residents.index')" />
                <x-form::button title="Update" type="primary" />
            </x-form::footer>
            </x-slot>
    </x-form::container>
</x-app-layout>
