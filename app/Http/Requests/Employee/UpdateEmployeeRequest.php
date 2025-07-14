<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UpdateEmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee')?->id ?? null;

        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:15', 'unique:employees,phone,' . $employeeId],
            'division' => ['sometimes', 'exists:divisions,id'],
            'position' => ['sometimes', 'string', 'max:100'],
            'image' => ['sometimes', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.unique' => 'Nomor telepon sudah terdaftar.',
            'division.exists' => 'Divisi tidak valid.',
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
