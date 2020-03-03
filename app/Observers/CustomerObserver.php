<?php

namespace App\Observers;

use App\Customer;

class CustomerObserver
{
    public function creating(Customer $customer): void
    {
        $customer->bonus = rand(
            config('transaction.bonus.min'),
            config('transaction.bonus.max')
        );
    }
}
