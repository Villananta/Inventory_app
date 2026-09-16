@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
 <div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <x-per-page-option/>
            <x-kategori-produk.formkategori-produk/>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 15px">No</th>
                        <th>Nama Kategori</th>
                        <th class="text-center" style="width: 100px">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $index => $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + $kategori->firstItem() - 1 }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-2" >
                                <x-kategori-produk.formkategori-produk id="{{ $item->id }}"/>
                                <x-confirm-delete id="{{ $item->id }}" route="master-data.kategori-produk.destroy"/>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center">Data Kategori Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($kategori->hasPages())
        <div class="d-flex justify-content-start mt-3">
            {{ $kategori->links() }}
        </div>
        @endif
    </div>
 </div>
@endsection