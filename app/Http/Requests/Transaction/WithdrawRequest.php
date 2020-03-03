<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\BalanceGteRule;

class WithdrawRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'regex:/^\d+(\.\d{1,2})?$/',
                'min:' . config('transaction.withdraw.min'),
                new BalanceGteRule($this->customer),
            ]
        ];
    }
}
