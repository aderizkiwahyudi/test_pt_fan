<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EpresenceUpdateRequest extends FormRequest
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
            'is_approve' => 'required|in:true,false'
        ];
    }

    public function messages()
    {
        return [
            'is_approve.required' => 'keterangan tidak boleh kosong',
            'is_approve.in' => 'keterangan yang anda masukan tidak valid'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'validation errors',
            'data' => $validator->errors(),
        ], 400));
    }
}
