<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IssueTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->tokenCan('token:issue');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'token_name' => [
                'string',
                'required',
                'min:1'
            ],
            'permissions' => [
                'array',
                'required'
            ],
            'permissions.*' => [
                'distinct',
                Rule::in([
                    'task:create',
                    'task:read',
                    'task:update',
                    'task:delete'
                ])
            ]
        ];
    }
}
