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
            <button type="button" class="btn btn-dark btn-sm btn-sm" data-bs-toggle="modal" data-bs-target="#modalFormVarian" id="btnTambahVarian">
                Tambah Varian
            </button>
        </div>
        <div class="card-body">
            <div class="alert alert-info mb-0">
                <span>Belum ada varian produk, silahkan tambahkan varian produk</span>
            </div>
        </div>
    </div>
<x-produk.form-varian/>
@endsection

@push('scripts')

let modalEl = $('#modalFormVarian');
let modal = new bootstrap.Modal(modalEl);
let $form = $('$modalFormVarian form');
    <script>
        $(document).ready(function() {
            $(#btnTambahVarian).on('clik', function() {
                $form[0].reset();
                $form.attr('action');
                $form.find('small.text-danger').text('');
                $('modalFormVarian. modal-title').text('Tambah Varian Baru')
                modal.show;
            })

            $form.submit(function(e){
                e.preventDefault();
                let FormData = new FormData(this);

                $.ajax({
                    type:$form.attr('method'),
                    url: $form.attr('action'),
                    data: FormData,
                    processData:false;
                    contentType:false;                    
                    success: function (response){
                        alert('okai tek')
                    }
                    error: function (xhr){
                        console.log(errors);
                        
                        let errors = xhr.responseJSON.errors;
                        $form.find('small.text-danger').text('');
                        $.each(errors, function(key,val){
                            $form.find(['name="' + key + '"']).next('small.text-danger').text(val[0]);
                        }) 
                    }
                })
            })
        })
    </script>
@endpush