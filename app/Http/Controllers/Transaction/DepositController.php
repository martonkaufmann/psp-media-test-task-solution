<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Transaction;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\DepositRequest;

class DepositController extends Controller
{
    public function __invoke(DepositRequest $request, Customer $customer): JsonResponse
    {
        $transaction = Transaction::create([
            'amount' => $request->amount,
            'customer_id' => $customer->id,
        ]);

        return response()->json($transaction, Response::HTTP_CREATED);
    }
}
