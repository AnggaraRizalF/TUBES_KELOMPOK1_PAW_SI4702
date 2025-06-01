<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,user'],
            'nim' => ['required', 'string', 'max:255', 'unique:users,nim'],
        ];
    }

    public function messages(): array
    {
        return [
            'nim.required' => 'Nomor Induk Mahasiswa wajib diisi.',
            'nim.unique' => 'Nomor Induk Mahasiswa ini sudah terdaftar.',
            'nim.string' => 'Nomor Induk Mahasiswa harus berupa teks.',
            'nim.max' => 'Nomor Induk Mahasiswa tidak boleh lebih dari :max karakter.',
        ];
    }
}
