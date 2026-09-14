@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
 <div class="div card">
    <div class="card-body py-5">
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
                    <td>{{ $loop->iteration + $kategori->firstItem() - 1 }}</td>
                    <td>{{ $item->nama_kategori }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Data Kategori Kosong</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
 </div>
@endsection