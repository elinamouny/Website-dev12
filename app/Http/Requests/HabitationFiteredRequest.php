<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HabitationFiteredRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function isFiltered(): bool
    {
        return $this->has('filtered');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'city' => 'string',
            'type' => 'string',
            'area' => 'numeric',
            'price' => 'numeric',
            'min_price' => 'numeric',
            'bedrooms' => 'integer',
            'garages' => 'integer',
            'bathrooms' => 'integer'
        ];
    }
}
