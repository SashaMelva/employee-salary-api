<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusTransactionsResource;
use App\Http\Services\BaseApi;
use App\Models\StatusTransaction;
use Illuminate\Http\Request;

class StatusTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = StatusTransaction::all();
        return (new BaseApi())->sendResponse(StatusTransactionsResource::collection($status))->getData();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validated();

        $validator->id_status = 3;
        $transaction = StatusTransaction::create($validator);
        return (new BaseApi())->sendResponse($transaction->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $status = StatusTransaction::find($id);

        if (is_null($status)) {
            return (new BaseApi())->sendError('Status transaction not found.');
        }

        return (new BaseApi())->sendResponse($status->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusTransaction $statusTransaction)
    {
        $validator = $request->validated();

        $statusTransaction->title = $validator['title'];
        $statusTransaction->description = $validator['description'];
        $statusTransaction->save();
        return (new BaseApi())->sendResponse($statusTransaction->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( StatusTransaction $statusTransaction)
    {
        $statusTransactionDelete = StatusTransaction::find($statusTransaction);
        return (new BaseApi())->sendResponse($statusTransactionDelete->toArray());
    }
}
