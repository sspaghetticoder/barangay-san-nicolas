<?php

namespace App\Http\Requests;

use App\Models\Resident;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'suffix' => ['nullable', 'string', 'max:255'],
            'gender' => ['required', 'max:255', Rule::in(array_keys(Resident::GENDERS))],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('residents', 'email')],
            'contact_number' => ['required', 'string', 'max:255'],
            'house_number' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'area' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'house_number.required' => 'The '.Resident::HOUSE_NUMBER_ALIAS.' is required.',
        ];
    }
}
