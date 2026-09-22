<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVarianProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_varian' => 'required',
            'harga_varian' => 'required|numeric|min:0',
            'stok_varian' => 'required|numeric|min:0',
            'gambar_varian' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ];
    }
}