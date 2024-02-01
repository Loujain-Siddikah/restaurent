<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'floor' => 'required|string|max:255',
            'details' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'district.required' => 'The district field is required.',
            'street.required' => 'The street field is required.',
            'floor.required' => 'The floor field is required.',
            'details.required' => 'The details field is required.',
        ];
    }
}
