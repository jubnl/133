<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'string',
                'required',
                'min:1',
                'max:250'
            ],
            'description' => [
                'string',
                'max:2000'
            ],
            'due_date' => [
                'date'
            ],
            'assigned_to' => [
                'integer',
                'exists:App\Models\User,id'
            ]
        ];
    }
}
