<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GenderRule implements Rule
{
    private const ALLOWED_GENDERS = ['male', 'female'];

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        return \in_array($value, self::ALLOWED_GENDERS);
    }

    public function message(): string
    {
        return 'Invalid gender.';
    }
}
