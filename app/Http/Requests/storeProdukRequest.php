<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class storeProdukRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_produk' => 'required|unique:produks,nama_produk',
            'deskripsi_produk' => 'required|min:5',
            'kategori_produk_id' => 'required|exists:kategori_produks,id',

        ];
    }

    public function messages(): array 
    {
        return [
            'nama_produk.required' => 'Nama harus tidak boleh kosong',
            'deskripsi_produk.required' => 'Deskripsi harus isi',
            'deskripsi_produk.min' => 'Deskripsi minimal 10 karakter',
            'kategori_produk.required' => 'Kategori harus isi',
            'kategori_produk.exists' => 'Kategori tidak ditemukan',
        ];
    }
}
