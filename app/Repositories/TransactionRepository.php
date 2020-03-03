<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    /**
     * @param string $from - Date from for report, format: yyyy-mm-dd
     * @param string $to - Date to for report, format: yyyy-mm-dd
     */
    public function getReport(string $from, string $to): Collection
    {
        return DB::table('transactions')
            ->select(
                DB::raw('COUNT(CASE WHEN transactions.amount > 0 THEN 1 END) AS number_of_deposits'),
                DB::raw('COUNT(CASE WHEN transactions.amount < 0 THEN 1 END) AS number_of_withdraws'),
                DB::raw('COUNT(DISTINCT(customer_id)) AS number_of_unique_customers'),
                DB::raw('IFNULL(SUM(CASE WHEN transactions.amount > 0 THEN transactions.amount END), 0) AS deposit_total'),
                DB::raw('IFNULL(SUM(CASE WHEN transactions.amount < 0 THEN transactions.amount END), 0) AS withdraws_total'),
                DB::raw('DATE(transactions.created_at) AS date'),
                DB::raw('customers.country AS country'),
            )
            ->leftJoin('customers', 'transactions.customer_id', '=', 'customers.id')
            ->where('transactions.created_at', '>=', $from)
            ->where('transactions.created_at', '<=', $to)
            ->groupBy(DB::raw('DATE(transactions.created_at)'), 'customers.country')
            ->get()
        ;
    }
}
