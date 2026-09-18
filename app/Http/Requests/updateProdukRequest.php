<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class updateProdukRequest extends FormRequest
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
            'nama_produk' => 'required|unique:produks,nama_produk,' . $this->produk->id,
            'deskripsi_produk' => 'required|min:10',
            'kategori_produk_id' => 'required|exists:kategori_produks,id',
        ];
    }

     public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk wajib diisi',
            'deskripsi_produk.required' => 'Deskripsi produk wajib diisi',
            'nama_produk.unique' => 'Nama produk sudah ada, gunakan nama lain',
            'deskripsi_produk.min' => 'Deskripsi produk minimal 10 karakter',
        ];
    }
}
