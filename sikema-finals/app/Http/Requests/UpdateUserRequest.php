<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id ?? null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:admin,user'],
            'nim' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($userId, 'nim')],
        ];
    }

    public function messages(): array
    {
        return [
            'nim.unique' => 'Nomor Induk Mahasiswa ini sudah terdaftar.',
        ];
    }
}
