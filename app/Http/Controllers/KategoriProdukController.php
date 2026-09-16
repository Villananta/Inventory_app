<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeKategoriProdukRequest;
use App\Http\Requests\updateKategoriProdukRequest;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    public $pageTitle = 'Kategori Produk';
    public function index(){

        $pageTitle = $this->pageTitle;
        $query = KategoriProduk::query();
        $kategori = $query->paginate(10);
        confirmDelete('Produk yang dihapus tidak dapat dikembalikan, lanjutkan?');
        return view('kategori-produk.index', compact('pageTitle', 'kategori'));
    }

    public function store(storeKategoriProdukRequest $request){
        KategoriProduk::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('master-data.kategori-produk.index')->with('success', 'Kategori berhasil disimpan');
    }

    public function update(updateKategoriProdukRequest $request, KategoriProduk $kategoriProduk){
        $kategoriProduk->nama_kategori = $request->nama_kategori;
        $kategoriProduk->save();

        toast()->success('Kategori produk berhasil diubah');
        return redirect()->route('master-data.kategori-produk.index');
    }

    public function destroy(KategoriProduk $kategoriProduk){
        $kategoriProduk->delete();

        toast()->success('Kategori produk berhasil dihapus');
        return redirect()->route('master-data.kategori-produk.index');
    }

}
