<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUploadValidationRequest extends FormRequest
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
            'book_name' => "required|max:255",
            'book_desc' => "required",
            'book_price' => 'required|numeric|max:100000',
            'book_author' => "required|max:255",
            'categories.*' => 'required|exists:categories,id',
            'book_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg, avif|max:2048',
            'book_file' => 'required|mimes:pdf,doc,docx',
        ];
    }

    public function messages()
    {
        return [
            'book_name.required' => 'Please enter book name.',
            'book_desc.required' => 'Please enter book desc.',
            'book_author.required' => 'Please enter book author.',
            'book_price.required' => 'Please enter book price.',
            'categories.required' => 'Please select category.',
            'book_image.required' => 'Please upload book image.',
            'book_file.required' => 'Please upload book file.',
            'book_file.mimes' => 'The file must be of type: pdf, doc, or docx.',
        ];
    }
}
