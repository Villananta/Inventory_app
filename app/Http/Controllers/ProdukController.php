<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProdukRequest;
use App\Http\Requests\updateProdukRequest;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public $pageTitle = 'Data Produk';
    public function index(){
        $pageTitle = $this->pageTitle;
        $search = request()->query('search');

        $perPageOptions = [10, 25, 50, 100];
        $perPage = (int) request('perPage', 10);

        if (! in_array($perPage, $perPageOptions, true)) {
            $perPage = 10;
        }

        $produk = Produk::query()
            ->with('kategori:id,nama_kategori')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_produk', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage)
            ->withQueryString();
        confirmDelete('Menghapus data produk akan menghapus seluruh varian yang ada, lanjutkan?');

        if (request()->ajax()) {
            return view('produk._table', compact('produk'))->render();
        }

        return view('produk.index', compact('pageTitle', 'produk'));
    }

    public function store(storeProdukRequest $request){
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'kategori_produk_id' => $request->kategori_produk_id,
        ]);
        toast()->success('Produk berhasil ditambahkan');
        return redirect()->route('master-data.produk.index');
    }

    public function destroy(Produk $produk){
        $produk->delete();
        toast()->success('Produk berhasil dihapus');
        return redirect()->route('master-data.produk.index');
    }

    public function show(Produk $produk){
        $pageTitle = $this->pageTitle;
        confirmDelete('Varian akan dihapus, lanjutkan?');
        return view('produk.show', compact('pageTitle', 'produk'));
    }

    public function update(updateProdukRequest $request, Produk $produk){
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->kategori_produk_id = $request->kategori_produk_id;
        $produk->save();

        toast('Produk berhasil diubah', 'success');
        return redirect()->route('master-data.produk.index');
    }
}
