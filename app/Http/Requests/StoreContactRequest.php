<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name' => ['required', 'max:50'],
            'organization_id' => ['max:50'],
            'position_id' => ['max:50'],
            'service_id' => ['max:50'],
            'location_id' => ['max:50'],
            'phone' => ['min:9', 'max:50'],
            'short_phone' => ['min:6', 'max:6'],
            'phone_code' => ['min:4', 'max:4'],
            'email' => ['max:50', 'email'],
            'description' => ['max:100'],
        ];
    }
}
