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
            <button class="btn btn-primary btn-sm">Tambah Varian</button>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-0">
                <span>Belum ada varian produk, silahkan tambahkan varian produk</span>
            </div>
        </div>
    </div>
@endsection