<?php

namespace App\DTO;

class TransactionDTO
{
    public function __construct(
        public string $description,
        public ?int $category_id,
        public int $amount,
        public string $type,
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
     * Ajusta o valor de uma transação com base no seu tipo.
     *
     * Este método garante que o valor retornado seja para transações do tipo
     * 'expense' (despesa) e positivo para transações do tipo 'income' (renda).
     *
     * @param int $amount O valor a ser ajustado.
     * @param string $type O tipo da transação, deve ser 'income' ou 'expense'.
     *
     * @return int Retorna o valor ajustado: negativo para despesas e positivo para rendas.
     */
    private function adjustAmount(int $amount, string $type): int
    {
        if ($type === 'expense') {
            return -abs(num: $amount);
        }

        return abs(num: $amount);
    }
}
