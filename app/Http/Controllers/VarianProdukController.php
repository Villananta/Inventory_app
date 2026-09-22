<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVarianProdukRequest;
use App\Http\Requests\UpdateVarianProdukRequest;
use App\Models\VarianProduk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VarianProdukController extends Controller
{
    public function store(StoreVarianProdukRequest $request)
    {
        VarianProduk::create([
            'produk_id' => $request->produk_id,
            'nomor_sku' => 'SKU-' . $request->produk_id . '-' . strtoupper(Str::random(6)),
            'nama_varian' => $request->nama_varian,
            'harga_varian' => $request->harga_varian,
            'stok_varian' => $request->stok_varian,
            'gambar_varian' => $request->file('gambar_varian')->store('varian', 'public'),
        ]);

        toast()->success('Varian berhasil ditambahkan');
        return redirect()->route('master-data.produk.show', $request->produk_id);
    }

    public function update(UpdateVarianProdukRequest $request, VarianProduk $varianProduk)
    {
        $varianProduk->nama_varian = $request->nama_varian;
        $varianProduk->harga_varian = $request->harga_varian;
        $varianProduk->stok_varian = $request->stok_varian;

        if ($request->hasFile('gambar_varian')) {
            Storage::disk('public')->delete($varianProduk->gambar_varian);
            $varianProduk->gambar_varian = $request->file('gambar_varian')->store('varian', 'public');
        }

        $varianProduk->save();

        toast('Varian berhasil diubah', 'success');
        return redirect()->route('master-data.produk.show', $varianProduk->produk_id);
    }

    public function destroy(VarianProduk $varianProduk)
    {
        Storage::disk('public')->delete($varianProduk->gambar_varian);

        $produkId = $varianProduk->produk_id;
        $varianProduk->delete();

        toast('Varian berhasil dihapus', 'success');
        return redirect()->route('master-data.produk.show', $produkId);
    }
}