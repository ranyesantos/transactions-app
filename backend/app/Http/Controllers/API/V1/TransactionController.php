<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\Transactions\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{

    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Retorna uma lista de transações em formato JSON.
     *
     * Este método utiliza o serviço de transações para recuperar as transações que podem filtradas por parâmetros de consulta.
     *
     * @param Request $request A instância da requisição HTTP, que pode conter parâmetros de filtro.
     *
     * @return JsonResponse Uma resposta JSON contendo as transações recuperadas, com status HTTP 200 (OK).
    */
    public function index(Request $request): JsonResponse
    {
        $transactions = $this->transactionService->getTransactions(request: $request);

        return response()->json(data: $transactions,  status: Response::HTTP_OK);

    }


    /**
     * Armazena uma nova transação no sistema.
     *
     * Este método recebe uma requisição que contém os dados validados
     * da transação. Ele cria uma nova transação usando o serviço
     * de transação e retorna uma resposta JSON com a nova transaçao e uma confirmação.
     *
     * @param TransactionRequest $request A requisição contendo os dados da transação. Os dados são validados através da classe TransactionRequest.
     *
     * @return JsonResponse Retorna uma resposta JSON com os seguintes dados:
     *                     - 'transaction': a instância de Transaction criada.
     *                     - 'message': uma mensagem de sucesso.
     *                     - status: com status HTTP 201 (CREATED).
     */
    public function store(TransactionRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->createTransaction(data: $request->validated());

        return response()->json(data: [
            'transaction' => $transaction,
            'message' => 'Transação adicionada com sucesso',
        ], status: Response::HTTP_CREATED);

    }


    /**
     * Exibe os detalhes de uma transação específica.
     *
     * Este método recebe uma instância de Transaction como parâmetro,
     * que é automaticamente resolvida pelo Laravel através da
     * injeção de dependência e retorna os dados da transação em formato JSON.
     *
     * @param Transaction $transaction A instância da transação a ser exibida.
     *
     * @return JsonResponse Retorna uma resposta JSON contendo os dados da transação
     *                     com status HTTP 200 (OK).
    */
    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json(data: $transaction, status: Response::HTTP_OK);
    }


    /**
     * Atualiza os dados de uma transação existente.
     *
     * Este método recebe uma instância de Transaction como parâmetro
     * e também recebe uma requisição com os dados validados para atualização.
     * Retorna os dados atualizados a transação em formato JSON.
     *
     * @param TransactionRequest $request A requisição contendo os dados
     *                                    validados para a atualização da transação.
     * @param Transaction $transaction A instância da transação a ser atualizada.
     *
     * @return JsonResponse Retorna uma resposta JSON contendo os dados da transação
     *                     atualizada e manda uma mensagem de sucesso com status HTTP 200 (OK).
    */
    public function update(TransactionRequest $request, Transaction $transaction): JsonResponse
    {
        $transaction = $this->transactionService->updateTransaction( transaction: $transaction,  data: $request->validated());

        return response()->json(data: [
            'transaction' => $transaction,
            'message'=> 'Transação editada com sucesso',
        ],status: Response::HTTP_OK);

    }

    /**
     * Exclui uma transação existente.
     *
     * Este método remove a instância da transação do banco de dados.
     * Após a exclusão, retorna uma resposta JSON confirmando o sucesso da operação.
     *
     * @param Transaction $transaction A instância da transação a ser excluída.
     *
     * @return JsonResponse Retorna uma resposta JSON com uma mensagem de sucesso e um status HTTP 200 (OK).
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return response()->json(data: [
            'message' => 'Transação excluída com sucesso'
        ], status: Response::HTTP_OK);
    }


}
