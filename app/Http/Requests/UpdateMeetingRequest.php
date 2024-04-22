<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMeetingRequest extends FormRequest
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
            //
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Meeting title is required.',
            'description.required' => 'Meeting description is required.',
            'path_attachment_file.mimes' => 'Invalid file format. Allowed formats are PDF, JPG, JPEG, PNG, DOC, and DOCX.',
        ];
    }
}
