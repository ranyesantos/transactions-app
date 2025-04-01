<?php

namespace App\DTO;

use App\Enums\TransactionType;

class TransactionDTO
{
    public function __construct(
        public string $description,
        public ?int $category_id,
        public int $amount,
        public TransactionType $type,
        public string $date
    ) {
        $this->amount = $this->adjustAmount($this->amount, $this->type);
    }

    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'category_id' => $this->category_id,
            'amount' => $this->amount,
            'type' => $this->type,
            'date' => $this->date
        ];
    }

    /**
     * Esse método garante que o valor retornado seja positivo para transações do tipo 'income' (renda).
     * e negativo para transações do tipo 'expense' (despesa).
     *
     *
     * @param int $amount O valor a ser ajustado.
     * @param TransactionType $type é uma instância do enum TransactionType
     *
     *
     * @return int Retorna o valor ajustado: retorna negativo para despesas e positivo para rendas.
     */
    private function adjustAmount(int $amount, TransactionType $type): int
    {
        if ($type === TransactionType::Expense) {
            return -abs(num: $amount);
        }

        return abs(num: $amount);
    }
}
