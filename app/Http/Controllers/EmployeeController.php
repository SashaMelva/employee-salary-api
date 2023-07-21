<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeesResource;
use App\Http\Services\BaseApi;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

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

        $employee = Employee::create([
            'email' => $validator['email'],
            'password' => Hash::make($validator['password'])
        ]);
        return (new BaseApi())->sendResponse($employee->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return (new BaseApi())->sendError('Employee not found.');
        }

        return (new BaseApi())->sendResponse($employee->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validator = $request->validated();

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
