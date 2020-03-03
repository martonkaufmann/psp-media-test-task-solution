<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Customer;

class BalanceGteRule implements Rule
{
    private Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     */
    public function passes($attribute, $value): bool
    {
        return $this->customer->transactions()->sum('amount') >= $value;
    }

    public function message(): string
    {
        return 'Balance too low for transaction.';
    }
}
