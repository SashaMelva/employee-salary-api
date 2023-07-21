<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'hours' => 'required|date_format:H:i',
            'price' => 'min:1|max:255|float',
            'employee_id' => 'required|integer'
        ];

        switch ($this->getMethod()) {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:transactions,id',
                    $rules
                ];
            case 'DELETE':
                return [
                    'id' => 'required|integer|exists:transactions,id'
                ];
        }
    }

    public function messages(): array
    {
        return [
            'date.required' => 'A date is required',
            'date.unique' => 'This date is already taken'
        ];
    }
}
