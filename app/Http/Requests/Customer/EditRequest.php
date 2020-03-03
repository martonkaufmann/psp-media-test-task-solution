<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\GenderRule;

class EditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => [
                'sometimes',
                'email',
                Rule::unique('customers')->ignore($this->customer->id),
            ],
            'first_name' => 'max:255',
            'last_name' => 'max:255',
            'gender' => ['sometimes', new GenderRule],
            'country' => 'sometimes|exists:countries,code',
        ];
    }
}
