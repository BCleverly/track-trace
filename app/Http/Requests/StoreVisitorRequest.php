<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitorRequest extends FormRequest
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
            'venue_id' => [
                'integer',
                'exists:venues,id',
            ],
            'email' => [
                'required',
            ],
            'phone' => [
                'required',
            ],
            'postcode' => [
                'required',
                'postal_code:GB',
            ],
            'extra_guests' => [
                'integer',
            ],
            'duration_of_stay' => [
                'required',
            ],
        ];
    }
}
