<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateRequest;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request): JsonResponse
    {
        $customer = Customer::create(
            $request->only('email', 'first_name', 'last_name', 'gender', 'country')
        );

        return response()->json($customer, Response::HTTP_CREATED);
    }
}
