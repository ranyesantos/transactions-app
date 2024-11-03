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
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $transactions = $this->transactionService->getTransactions(request: $request);

        return response()->json(data: $transactions,  status: Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json(data: $transaction, status: Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return response()->json(data: [
            'message' => 'Transação excluída com sucesso'
        ],status: Response::HTTP_OK);
    }

}
