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
        $search = request()->query('search');

        $perPageOptions = [10, 25, 50, 100];
        $perPage = (int) request('perPage', 10);

        if (! in_array($perPage, $perPageOptions, true)) {
            $perPage = 10;
        }

        $kategori = KategoriProduk::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_kategori', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->withQueryString();
        confirmDelete('Produk yang dihapus tidak dapat dikembalikan, lanjutkan?');

        if (request()->ajax()) {
            return view('kategori-produk._table', compact('kategori'))->render();
        }

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
