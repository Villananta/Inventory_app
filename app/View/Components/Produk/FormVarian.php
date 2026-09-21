<?php

namespace App\View\Components\produk;

use App\Models\Produk;
use App\Models\VarianProduk;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormVarian extends Component
{
    /**
     * Create a new component instance.
     */
    public $id, $produk_id, $nama_varian, $stok_varian, $harga_varian, $action;
    public function __construct($id = null, $produk = null)
    {
        if ($produk) {
            $this->produk_id = $produk instanceof Produk ? $produk->id : $produk;
        } else {
            $routeProduk = request()->route('produk');
            $this->produk_id = $routeProduk ? $routeProduk->id : null;
        }

        if ($id) {
            $varian = VarianProduk::findOrFail($id);
            $this->id = $varian->id;
            $this->produk_id = $varian->produk_id;
            $this->nama_varian = $varian->nama_varian;
            $this->harga_varian = $varian->harga_varian;
            $this->stok_varian = $varian->stok_varian;
            $this->action = route('master-data.varian-produk.update', $varian->id);
        } else {
            $this->action = route('master-data.varian-produk.store');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.produk.form-varian');
    }
}
