<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $resident->name }}
        </h2>
    </x-slot>

    <x-form::container target="_blank" :action="route('pdf.print')">
        <x-slot:content>
            <x-form::divider>
                <x-slot:title>Personal Information</x-slot:title>
            </x-form::divider>

            <x-form::field>
                <x-slot:title>Resident ID</x-slot:title>

                <x-jet-input class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true" type="text"
                    value="{{ $resident->full_id }}" />
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Last Name</x-slot:title>

                <x-jet-input name="last_name" class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true"
                    type="text" :value="$resident->last_name" />
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>First Name</x-slot:title>

                <x-jet-input name="first_name" class="block mt-1 cursor-not-allowed" style="width: 70%;"
                    :disabled="true" type="text" :value="$resident->first_name" />
            </x-form::field>

            <x-form::field>
                <x-slot:title>Middle Name</x-slot:title>

                <x-jet-input name="middle_name" class="block mt-1 cursor-not-allowed" style="width: 70%;"
                    :disabled="true" type="text" :value="$resident->middle_name" />
            </x-form::field>

            <x-form::field>
                <x-slot:title>Suffix</x-slot:title>

                <x-jet-input name="suffix" class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true"
                    type="text" :value="$resident->suffix" />
            </x-form::field>

            <x-form::field>
                <x-slot:title :required="true">Gender</x-slot:title>

                <x-jet-input name="gender" class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true"
                    type="text" :value="$resident->gender_name" />
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Place Of Birth</x-slot:title>

                <x-jet-input name="place_of_birth" class="block mt-1 cursor-not-allowed" style="width: 70%;"
                    :disabled="true" type="text" :value="$resident->place_of_birth" />
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Birthdate</x-slot:title>

                <x-jet-input name="birth_date" class="block mt-1 cursor-not-allowed" style="width: 70%;"
                    :disabled="true" type="date" :value="$resident->birth_date" />
            </x-form::field>

            <x-form::divider>
                <x-slot:title>Contact Information</x-slot:title>
                <x-slot:description></x-slot:description>
            </x-form::divider>

            <x-form::field>
                <x-slot:title>Email</x-slot:title>

                <x-jet-input name="email" class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true"
                    type="text" :value="$resident->email" />
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Contact Number</x-slot:title>

                <x-jet-input name="contact_number" class="block mt-1 cursor-not-allowed" style="width: 70%;"
                    :disabled="true" type="text" :value="$resident->contact_number" />
                <x-jet-input-error for="contact_number" />
            </x-form::field>

            <x-form::divider>
                <x-slot:title>Home Address Information</x-slot:title>
                <x-slot:description></x-slot:description>
            </x-form::divider>

            <x-form::field :required="true">
                <x-slot:title>{{ $houseNumberAlias }}</x-slot:title>

                <x-jet-input name="house_number" class="block mt-1 cursor-not-allowed" style="width: 70%;"
                    :disabled="true" type="text" :value="$resident->house_number" required />
            </x-form::field>

            <x-form::field :required="true">
                <x-slot:title>Street Name</x-slot:title>

                <x-jet-input name="street" class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true"
                    type="text" :value="$resident->street" required />
            </x-form::field>

            <x-form::field>
                <x-slot:title>{{ $areaAlias }}</x-slot:title>

                <x-jet-input name="area" class="block mt-1 cursor-not-allowed" style="width: 70%;" :disabled="true"
                    type="text" :value="$resident->area" />
            </x-form::field>

            <x-form::divider>
                <x-slot:title>Request Document</x-slot:title>
                <x-slot:description>Please provide all the necessary information.</x-slot:description>
            </x-form::divider>

            <x-form::field :required="true">
                <x-slot:title>Purpose</x-slot:title>

                <x-form::select-input id="purpose" name="purpose" title="purpose" style="width: 70%;" required>
                    @foreach ($purposes as $key => $purpose)
                        <option value="{{ $purpose }}">
                            {{ $purpose }}</option>
                    @endforeach
                </x-form::select-input>
                <x-jet-input-error for="purpose" />
            </x-form::field>

            <x-form::field :required="true" id="specified-container" class="visible">
                <x-slot:title>Specify</x-slot:title>

                <x-jet-input id="specified" name="specified" class="block mt-1" style="width: 70%;" type="text"
                    required />
                <x-jet-input-error for="specified" />
            </x-form::field>

            <x-jet-input id="route" name="route" type="hidden" value="test"/>
            <x-jet-input id="full_id" name="full_id" type="hidden" value="{{ $resident->full_id }}"/>

            <x-form::footer>
                <x-form::button title="Go back" type="secondary" :link="route('residents.index')" />
                <x-form::button id="Indigency" title="Indigency" type="primary" class="print-btn ml-1 px-4 py-2 rounded-md" />
                <x-form::button id="Residency" title="Residency" type="info" class="print-btn ml-1 px-4 py-2 rounded-md" />
                <x-form::button id="Clearance" title="Clearance" type="success" class="print-btn ml-1 px-4 py-2 rounded-md" />
            </x-form::footer>
        </x-slot>
    </x-form::container>

    @push('scripts')
        <script src="{{ asset('js/dropdown.js') }}"></script>

        <script>
            var print_btns = document.querySelectorAll(".print-btn")
            var routeInput = document.querySelector("#route")

            print_btns.forEach(btn => {
                btn.addEventListener('click', function () {
                    routeInput.value = this.id
                })
            })
        </script>
    @endpush
</x-app-layout>
