<?php

namespace App\Services\Transactions;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TransactionService
{

    /**
     * Recupera uma lista paginada de transações do banco de dados.
     *
     * Este método permite a filtragem das transações com base no tipo.
     *
     * @param Request $request A instância da requisição HTTP, contendo parâmetros de consulta.
     *
     * @return LengthAwarePaginator Um objeto que representa a collection paginada de transações.
    */
    public function getTransactions(Request $request): LengthAwarePaginator
    {
        $query = Transaction::query();

        if ($request->has('type') && $request->input('type') != null) {
            $query->where('type', $request->input('type'));
        }
        if ($request->type === null){
            $query = Transaction::query();
        }

        return $query->paginate(perPage: 15);
    }


    /**
     * Cria uma nova transação no banco de dados.
     *
     * Este método utiliza o método privado adjustAmount para alterar o valor da transação
     * com base no tipo da transação ('income' ou 'expense') e depois
     * cria uma nova instância de Transaction com os dados fornecidos.
     *
     * @param array $data Um array contendo os dados da transação, que devem incluir:
     *                    - 'description': descrição da transação
     *                    - 'category_id': ID da categoria associada
     *                    - 'amount': valor da transação
     *                    - 'type': tipo da transação ('income' ou 'expense')
     *                    - 'date': data da transação
     *
     * @return Transaction a nova instância de Transaction criada no banco de dados.
    */
    public function createTransaction(array $data): Transaction
    {
        $data['amount'] = $this->adjustAmount(amount: $data['amount'], type: $data['type']);

        return Transaction::create($data);
    }

    /**
     * Atualiza os dados de uma transação existente.
     *
     * Este método utiliza o método privado adjustAmount para alterar o valor da transação
     * com base no tipo fornecido ('income' ou 'expense')
     * depois atualiza a instância da transação com os dados fornecidos
     * e retorna a transação atualizada.
     *
     * @param Transaction $transaction A instância da transação a ser atualizada.
     *
     * @param array $data Os dados que devem ser atualizados na transação.
     *
     * @return Transaction retorna a instância da transação atualizada.
    */
    public function updateTransaction(Transaction $transaction, array $data): Transaction
    {
        $data['amount'] = $this->adjustAmount(amount: $data['amount'], type: $data['type']);

        $transaction->update($data);

        return $transaction;
    }

    /**
     * Ajusta o valor de uma transação com base no seu tipo.
     *
     * Este método garante que o valor retornado seja para transações do tipo
     * 'expense' (despesa) e positivo para transações do tipo 'income' (renda).
     *
     * @param float $amount O valor a ser ajustado.
     * @param string $type O tipo da transação, deve ser 'income' ou 'expense'.
     *
     * @return float Retorna o valor ajustado: negativo para despesas e positivo para rendas.
     */
    private function adjustAmount(float $amount, string $type): float
    {
        if ($type === 'expense') {
            return -abs(num: $amount);
        }

        return abs(num: $amount);
    }


}

