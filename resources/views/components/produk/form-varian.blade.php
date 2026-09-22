@php($modalId = 'modalFormVarian' . ($id ?? ''))
@php($formId = 'formVarian' . ($id ?? ''))
<div>
    @if ($id)
    <button type="button" class="btn btn-round btn-primary btn-icon" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
        <i class="fas fa-edit"></i>
    </button>
    @endif

    <div class="modal fade" id="{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <form id="{{ $formId }}" class="form-varian" method="POST" enctype="multipart/form-data" action="{{ $action }}">
                @csrf
                @if ($id)
                    @method('PUT')
                @endif
                <input type="hidden" name="produk_id" value="{{ $produk_id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="{{ $modalId }}Label">{{ $id ? 'Edit Varian' : 'Tambahkan Varian' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_varian{{ $id ?? '' }}" class="form-label">Nama Varian</label>
                            <input type="text" name="nama_varian" id="nama_varian{{ $id ?? '' }}" class="form-control" value="{{ old('nama_varian', $nama_varian ?? '') }}">
                            <small class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="harga_varian{{ $id ?? '' }}" class="form-label">Harga</label>
                            <input type="text" name="harga_varian" id="harga_varian{{ $id ?? '' }}" class="form-control" value="{{ old('harga_varian', $harga_varian ?? '') }}">
                            <small class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="stok_varian{{ $id ?? '' }}" class="form-label">Stok Varian</label>
                            <input type="number" name="stok_varian" id="stok_varian{{ $id ?? '' }}" class="form-control" value="{{ old('stok_varian', $stok_varian ?? '') }}">
                            <small class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="gambar_varian{{ $id ?? '' }}" class="form-label">Gambar Varian</label>
                            <input type="file" name="gambar_varian" id="gambar_varian{{ $id ?? '' }}" class="form-control">
                            @if ($id)
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>