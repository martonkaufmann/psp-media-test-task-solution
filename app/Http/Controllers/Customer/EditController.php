<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\JsonResponse;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\EditRequest;

class EditController extends Controller
{
    public function __invoke(EditRequest $request, Customer $customer): JsonResponse
    {
        $customer->fill(
            $request->only('email', 'first_name', 'last_name', 'gender', 'country')
        );
        $customer->save();

        return response()->json($customer);
    }
}
