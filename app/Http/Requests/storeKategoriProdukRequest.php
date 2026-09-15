<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class storeKategoriProdukRequest extends FormRequest
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
            'nama_kategori' => 'required|unique:kategori_produks,nama_kategori'
        ];
    }

    public function messages():array{
        return [
            'nama_kategori.required' => ':attribute wajib diisi',
            'nama_kategori.unique' => ':attribute sudah ada, gunakan nama lain',
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_kategori' => 'Nama kategori',
        ];
        toast()->success('Kategori Produk Berhasil Ditambahkan');
        return redirect()->route('master-data.kategori-produk.index');
    }

    
}
