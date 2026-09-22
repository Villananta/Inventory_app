@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Detail : {{ $produk->nama_produk }}</h4>
            <a href="{{ route('master-data.produk.index') }}" class="text-primary">Kembali</a>
        </div>
        <div class="card-body">
            <div class="mb-3"><x-meta-item label="Nama Produk" value="{{ $produk->nama_produk }}"/></div>
            <div class="mb-3"><x-meta-item label="Kategori" value="{{ $produk->kategori?->nama_kategori }}"/></div>
            <div><x-meta-item label="Deskripsi" value="{{ $produk->deskripsi_produk }}"/></div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Varian Produk</h4>
            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormVarian">
                Tambah Varian
            </button>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($produk->varian as $varian)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $varian->gambar_varian) }}" alt="{{ $varian->nama_varian }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $varian->nama_varian }}</h5>
                            <small class="text-muted d-block mb-2">{{ $varian->nomor_sku }}</small>
                            <p class="card-text mb-1 fw-bold">Rp {{ number_format($varian->harga_varian, 0, ',', '.') }}</p>
                            <p class="card-text mb-0">Stok : {{ $varian->stok_varian }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <x-produk.form-varian id="{{ $varian->id }}"/>
                            <x-confirm-delete id="{{ $varian->id }}" route="master-data.varian-produk.destroy"/>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info mb-0">
                        <span>Belum ada varian produk, silahkan tambahkan varian produk</span>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
<x-produk.form-varian/>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.form-varian').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            var isEdit = form.querySelector('input[name="_method"]') !== null;
            var nama = form.nama_varian.value.trim();
            var harga = form.harga_varian.value.trim();
            var stok = form.stok_varian.value.trim();
            var foto = form.gambar_varian.files[0];

            if (! nama || ! harga || ! stok || (! isEdit && ! foto)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Semua kolom wajib diisi, termasuk foto.',
                });
                return;
            }

            if (foto) {
                if (! ['image/png', 'image/jpeg', 'image/gif'].includes(foto.type)) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Foto harus berformat png, jpg, jpeg, atau gif.',
                    });
                    return;
                }

                if (foto.size > 2048 * 1024) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Ukuran foto melebihi batas maksimal 2048 KB (2MB).',
                    });
                }
            }
        });
    });
});
</script>
@endpush