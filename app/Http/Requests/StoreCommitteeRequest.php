<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommitteeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'members' => ['required', 'array', 'min:1'],
            'members.*.user_id' => ['required', 'exists:users,id'],
            'members.*.position' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'members.required' => 'At least one committee member is required.',
            'members.*.user_id.required' => 'Please select a user for each committee member.',
            'members.*.user_id.exists' => 'Selected user does not exist.',
            'members.*.position.required' => 'Position is required for each committee member.',
        ];
    }
}