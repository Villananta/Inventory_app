<div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15px">No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th class="text-center" style="width: 100px">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + $produk->firstItem() - 1 }}</td>
                        <td>
                            <a href="{{ route('master-data.produk.show', $item->id) }}">{{ $item->nama_produk }}</a>
                        </td>
                        <td>{{ $item->kategori?->nama_kategori }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <x-produk.form-produk id="{{ $item->id }}" route="master-data.produk.update"/>
                                <x-confirm-delete id="{{ $item->id }}" route="master-data.produk.destroy"/>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Data Produk Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($produk->hasPages())
        <div class="d-flex justify-content-start mt-3">
            {{ $produk->links() }}
        </div>
        @endif