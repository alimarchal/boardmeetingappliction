<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
//            'description' => 'required',
//            'path_attachment_file' => 'required|mimes:pdf,jpg,jpeg,png,doc,docx',
        ];
    }


    public function messages(): array
    {
        return [
//            'description.required' => 'Meeting description is required.',
//            'path_attachment_file.required' => 'Attachment is required.',
//            'path_attachment_file.mimes' => 'Invalid file format. Allowed formats are PDF, JPG, JPEG, PNG, DOC, and DOCX.',
        ];
    }
}
