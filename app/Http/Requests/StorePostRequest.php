<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'level' => ['required', Rule::in(['A1', 'A2', 'B1', 'B2', 'C1', 'C2'])],
            'file_name' => [
                'file',
                'required',
                // 拡張子
                'mimes:pdf,doc,zip,xls',
                // MIMEタイプ：Word, Excel, Zip, PDF
                'mimetypes:application/pdf,application/msword,application/zip,application/msexcel',
            ],
            'text_id' => 'nullable|exists:texts,id',
        ];
    }
}
