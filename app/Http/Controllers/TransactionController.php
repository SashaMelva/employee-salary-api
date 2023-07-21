<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionsResource;
use App\Http\Services\BaseApi;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;

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

        if($validator->fails()){
            return (new BaseApi())->sendError('Validation Error.', $validator->errors());
        }

        $validator->id_status = 3;
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
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $validator = $request->validated();

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $transaction->employee_id = $validator['employee_id'];
        $transaction->hours = $validator['hours'];
        $transaction->id_status = $validator['id_status'];
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
