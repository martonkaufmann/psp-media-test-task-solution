<?php

return [
    'withdraw' => [
        'min' => env('TRANSACTION_MIN_WITHDRAW', 1),
    ],
    'deposit' => [
        'min' => env('TRANSACTION_MIN_DEPOSIT', 1),
    ],
    'bonus' => [
        'modulo_number' => env('TRANSACTION_MODULO_NUMBER', 3),
        'min' => env('TRANSACTION_MIN_BONUS', 5),
        'max' => env('TRANSACTION_MAX_BONUS', 20),
    ],
];
