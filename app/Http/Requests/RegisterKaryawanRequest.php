<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;

class RegisterKaryawanRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:255', 'min:2'],
            'umur' => ['required', 'integer', 'min:17', 'max:65'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'alamat' => ['required', 'string', 'max:500'],
            'posisi' => ['required', 'string', 'in:staff,barista,kasir,admin'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.min' => 'Nama minimal 2 karakter.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'umur.required' => 'Umur wajib diisi.',
            'umur.integer' => 'Umur harus berupa angka.',
            'umur.min' => 'Umur minimal 17 tahun.',
            'umur.max' => 'Umur maksimal 65 tahun.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal 500 karakter.',
            'posisi.required' => 'Posisi wajib dipilih.',
            'posisi.in' => 'Posisi yang dipilih tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama' => 'nama lengkap',
            'umur' => 'umur',
            'jenis_kelamin' => 'jenis kelamin',
            'alamat' => 'alamat',
            'posisi' => 'posisi',
            'email' => 'email',
            'password' => 'password',
        ];
    }
}
