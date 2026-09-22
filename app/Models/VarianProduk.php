<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianProduk extends Model
{
    protected $fillable = ['produk_id', 'nomor_sku', 'nama_varian', 'gambar_varian', 'stok_varian', 'harga_varian'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}