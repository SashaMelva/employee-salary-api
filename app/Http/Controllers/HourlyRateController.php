<?php

namespace App\Http\Controllers;

use App\Http\Requests\HourlyRateRequest;
use App\Http\Resources\HourlyRatesResource;
use App\Http\Services\BaseApi;
use App\Models\HourlyRate;

class HourlyRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hourlyRate = HourlyRate::all();
        return (new BaseApi())->sendResponse(HourlyRatesResource::collection($hourlyRate))->getData();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(HourlyRateRequest $request)
    {
        $validator = $request->validated();

        if($validator->fails()){
            return (new BaseApi())->sendError('Validation Error.', $validator->errors());
        }

        $validator->employee_id = $validator['employee_id'];
        $validator->price = $validator['price'];
        $hourlyRate = HourlyRate::create($validator);
        return (new BaseApi())->sendResponse($hourlyRate->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hourlyRate = HourlyRate::find($id);

        if (is_null($hourlyRate)) {
            return (new BaseApi())->sendError('Hourly rate not found.');
        }

        return (new BaseApi())->sendResponse($hourlyRate->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HourlyRateRequest $request, HourlyRate $hourlyRate)
    {
        $validator = $request->validated();

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $hourlyRate->employee_id = $validator['email'];
        $hourlyRate->hours = $validator['password'];
        $hourlyRate->id_status = $validator['id_status'];
        $hourlyRate->save();
        return (new BaseApi())->sendResponse($hourlyRate->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HourlyRate $hourlyRate)
    {
        $hourlyRateDelete = HourlyRate::find($hourlyRate);
        return (new BaseApi())->sendResponse($hourlyRateDelete->toArray());
    }
}
