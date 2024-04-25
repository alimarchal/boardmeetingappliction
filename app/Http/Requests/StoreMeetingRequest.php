<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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
            'date_and_time' => 'required',
            'location' => 'required',
            'description' => 'required',
            'path_attachment_file' => 'mimes:pdf,jpg,jpeg,png,doc,docx',
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
