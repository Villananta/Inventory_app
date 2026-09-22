<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\VarianProduk;

class StokBarangController extends Controller
{
    public $pageTitle = 'Stok Barang';

    public function index()
    {
        $pageTitle = $this->pageTitle;

        $perPageOptions = [10, 25, 50, 100];
        $perPage = (int) request('perPage', 10);

        if (! in_array($perPage, $perPageOptions, true)) {
            $perPage = 10;
        }

        $search = request()->query('search');
        $kategori = KategoriProduk::all();
        $rKategori = request()->query('kategori');

        $stokBarang = VarianProduk::query()
            ->with('produk.kategori')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_varian', 'like', "%{$search}%")
                        ->orWhere('nomor_sku', 'like', "%{$search}%")
                        ->orWhereHas('produk', function ($q) use ($search) {
                            $q->where('nama_produk', 'like', "%{$search}%");
                        });
                });
            })
            ->when($rKategori, function ($query) use ($rKategori) {
                $query->whereHas('produk', function ($q) use ($rKategori) {
                    $q->where('kategori_produk_id', $rKategori);
                });
            })
            ->orderByDesc('created_at')
            ->paginate($perPage)
            ->withQueryString();

        if (request()->ajax()) {
            return view('stok-barang._table', compact('stokBarang'))->render();
        }

        return view('stok-barang.index', compact('pageTitle', 'stokBarang', 'kategori'));
    }
}