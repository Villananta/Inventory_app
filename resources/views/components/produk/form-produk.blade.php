<div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-round {{ $id ? 'btn-primary btn-dark' : 'btn-dark' }}" data-bs-toggle="modal" data-bs-target="#formKategori{{ $id ?? '' }}">
  @if ($id)
  <i class="fas fa-edit"></i>
  @else
  <span>Produk Baru</span>
  @endif
</button>

<!-- Modal -->
<div class="modal fade" id="formKategori{{ $id ?? '' }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="formKategoriLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ $action }}" method="POST">
        @csrf
        @if ($id)
            @method('PUT')
        @else
            
        @endif
        <div class="modal-header">
        <h5 class="modal-title" id="formKategoriLabel">Form Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="form-group">
            <label for="kategori_produk_id" class="form-label">Kategori Produk</label>
            <select name="kategori_produk_id" id="kategori_produk_id" class="form-label">
                <option value="">Pilih Kategori</option>
                @foreach ( $kategori as $item )
                <option value="{{ $item->id }}" {{ old('kategori_produk_id', $kategori_produk_id ?? '' ) == $item->id ? 'selected' : '' }}>{{ $item->nama_kategori }}</option>
                @endforeach
                @error('kategori_produk_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </select>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>