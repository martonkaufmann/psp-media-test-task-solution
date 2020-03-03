<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Transaction;
use App\Repositories\TransactionRepository;

class ReportingController extends Controller
{
    private TransactionRepository $repository;

    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Request $request, string $from, string $to): JsonResponse
    {
        if (Carbon::parse($to)->isBefore($from)) {
            return response()->json(null, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(
            $this->repository->getReport($from, $to)
        );
    }
}
