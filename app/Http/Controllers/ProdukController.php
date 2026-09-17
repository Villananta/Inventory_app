<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public $pageTitle = 'Data Produk';
    public function index(){
        $query = Produk::query();
        $perPage = request()->query('perPage') ?? 10;
        $search = request()->query('search');
        $pageTitle = $this->pageTitle;

        $query->with('kategori:id, nama_kategori');
        if ($search) {
            $query->where('nama_produk', 'like', '%' . $search . '%');
        }

        $produk = $query->orderBy('created_at', 'DESC')->paginate($perPage)->appends(request()->query());
        confirmDelete('Menghapus data produk akan menghapus seluruh varian yang ada, lanjutkan?');
        return view('produk.index', compact('pageTitle', 'produk'));
    }
}
