<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PropertiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'title' => 'required|string|max:120|min:5',
            'category_id' => 'required|integer|exists:properties,id',
            'number_of_rooms' => 'required|integer',
            'number_of_guests' =>  'required|integer',
            'description' => 'required|string|max:255',
            'price_per_day' => 'required|integer|regex:/^\d*(\.\d{1,2})?$/',

            'country' => 'required|string|max:150',
            'place' => 'required|string|max:150',
            'street' => 'required|string|max:150',
            'house_number' => 'required|integer',
            'flat_number' => 'nullable|integer',
        ];
    }
}
