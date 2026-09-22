<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" style="width: 15px">No.</th>
                <th>SKU</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th class="text-center" style="width: 140px">Kartu Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stokBarang as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration + $stokBarang->firstItem() - 1 }}</td>
                <td>{{ $item->nomor_sku }}</td>
                <td>{{ $item->produk?->nama_produk }}</td>
                <td>{{ $item->produk?->kategori?->nama_kategori }}</td>
                <td>{{ $item->stok_varian }}</td>
                <td>Rp {{ number_format($item->harga_varian, 0, ',', '.') }}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-primary" disabled>Kartu Stok</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Data Stok Barang Kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if ($stokBarang->hasPages())
<div class="d-flex justify-content-start mt-3">
    {{ $stokBarang->links() }}
</div>
@endif