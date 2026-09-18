@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-body py-5">
            <div class="row align-items-center">
                <div class="row col-10"></div>
                <div class="row col-2 d-flex justify-content-end">
                    <x-produk.form-produk/>
                </div>
            </div>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15px">No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th class="text-center" style="width: 100px">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produk as $index => $item)
                        <tr>
                            <td>{{ $loop->iteration + $produk->firstItem() - 1 }}</td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-2" >
                                <x-produk.form-produk id="{{ $item->id }}" route="master-data.produk.update"/>
                                <x-confirm-delete id="{{ $item->id }}" route="master-data.produk.destroy"/>
                            </div>
                            </td>
                        </tr>
                    @empty
                        <td colspan="4" class="text-center">Data produk tidak ada</td>
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection