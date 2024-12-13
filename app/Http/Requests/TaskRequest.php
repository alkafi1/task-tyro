<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Contracts\Validation\Validator;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'assigned_to_user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed,in-progress',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        // Custom error handling
        Helper::sendErr('Validation error', $validator->errors());

        // You can throw a ValidationException to prevent further processing
        // throw new ValidationException($validator);
    }
}
