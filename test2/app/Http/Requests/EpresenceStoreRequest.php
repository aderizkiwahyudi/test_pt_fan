<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EpresenceStoreRequest extends FormRequest
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
            'type' => 'required|in:in,out,IN,OUT',
            'waktu' => 'required|date_format:Y-m-d H:i:s'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'keterangan tidak boleh kosong',
            'type.in' => 'keterangan yang anda masukan tidak valid',
            'waktu.required' => 'Waktu tidak boleh kosong',
            'waktu.date_format' => 'Format waktu salah',
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
