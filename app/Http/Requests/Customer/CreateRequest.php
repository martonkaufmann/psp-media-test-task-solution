<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\GenderRule;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:customers',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'gender' => ['required', new GenderRule],
            'country' => 'required|exists:countries,code',
        ];
    }
}
