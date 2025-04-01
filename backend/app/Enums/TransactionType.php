<?php

namespace App\Enums;

enum TransactionType: string
{
    case Expense = 'expense';
    case Income = 'income';

    public function description(): string
    {
        return match($this) {
            self::Expense => 'This is an expense transaction',
            self::Income => 'This is an income transaction',
        };
    }
}
