<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Transaction;

class Customer extends Model
{
    public $fillable = ['email', 'first_name', 'last_name', 'gender', 'country'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
