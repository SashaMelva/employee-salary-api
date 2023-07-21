<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeesResource;
use App\Http\Services\BaseApi;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return (new BaseApi())->sendResponse(EmployeesResource::collection($employees))->getData();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $validator = $request->validated();

        if ($validator->fails()) {
            return (new BaseApi())->sendError('Validation Error.', $validator->errors());
        }

        $employee = Employee::create($validator);
        return (new BaseApi())->sendResponse($employee->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return (new BaseApi())->sendError('Product not found.');
        }

        return (new BaseApi())->sendResponse($employee->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validator = $request->validated();

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee->email = $validator['email'];
        $employee->password = $validator['password'];
        $employee->save();
        return (new BaseApi())->sendResponse($employee->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee = Employee::find($employee);
        return (new BaseApi())->sendResponse($employee->toArray());
    }
}
