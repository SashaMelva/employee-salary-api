<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionsResource;
use App\Http\Services\BaseApi;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return (new BaseApi())->sendResponse(TransactionsResource::collection($transactions))->getData();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionRequest $request)
    {
        $validator = $request->validated();

        $transaction = Transaction::create($validator);
        return (new BaseApi())->sendResponse($transaction->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (is_null($transaction)) {
            return (new BaseApi())->sendError('Transaction not found.');
        }

        return (new BaseApi())->sendResponse($transaction->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionRequest $request, string $id)
    {
        $validator = $request->validated();

        $transaction = Transaction::findOrFail($id);
        $transaction->fill($validator->except(['id']));
        $transaction->save();
        return (new BaseApi())->sendResponse($transaction->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transactionDelete = Transaction::find($transaction);
        return (new BaseApi())->sendResponse($transactionDelete->toArray());
    }
}
