<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class StoreEmployeeRequest extends FormRequest
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
            'phone' => ['required', 'string', 'max:15' ,'unique:employees,phone'],
            'division' => ['required', 'exists:divisions,id'],
            'position' => ['required', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'mimes:png,jpg', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.unique' => 'Nomor telepon sudah terdaftar.',
            'division.required' => 'Divisi wajib dipilih.',
            'division.exists' => 'Divisi tidak valid.',
            'position.required' => 'Posisi wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat png, jpg, atau jpeg.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
    
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validasi gagal!',
            'errors' => $validator->errors()
        ], 422));
    }

}
