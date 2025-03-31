<?php

namespace App\Services\Transactions;

use App\DTO\TransactionDTO;
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
     *                    - 'description': descrição da transação
     *                    - 'category_id': ID da categoria associada
     *                    - 'amount': valor da transação
     *                    - 'type': tipo da transação ('income' ou 'expense')
     *                    - 'date': data da transação
     *
    */
    public function createTransaction(TransactionDTO $data)
    {
        Transaction::create($data->toArray());

        return $data;
    }

    /**
     * Atualiza os dados de uma transação existente.
     *
     * Este método utiliza o método privado adjustAmount para alterar o valor da transação
     * com base no tipo fornecido ('income' ou 'expense')
     * depois atualiza a instância da transação com os dados fornecidos
     * e retorna a transação atualizada.
     *
     *
     * @return Transaction retorna a instância da transação atualizada.
    */
    public function updateTransaction(Transaction $transaction, TransactionDTO $data): Transaction
    {
        $transaction->update($data->toArray());

        return $transaction;
    }

}

