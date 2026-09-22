@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
<div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div class="d-flex align-items-center gap-2">
                <x-filter-by-field term="search" placeholder="Cari Data..." style="width: 400px"/>
                <select name="kategori" id="kategori" class="form-control" onchange="filterByKategori(this)" style="width: auto; min-width: 180px">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $item)
                        <option value="{{ $item->id }}" @selected((int) request('kategori') === $item->id)>{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-round btn-secondary" title="Refresh" onclick="resetStok()">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="d-flex align-items-center gap-2">
                <x-per-page-option/>
            </div>
        </div>
    </div>
    <div id="stok-table">
        @include('stok-barang._table', ['stokBarang' => $stokBarang])
    </div>
</div>
@endsection

@push('scripts')
<script>
    let stokSearchTimer;

    async function fetchStokBarang(href) {
        try {
            const response = await fetch(href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (! response.ok) throw new Error(response.status);

            document.getElementById('stok-table').innerHTML = await response.text();
            history.replaceState(null, '', href);
        } catch (error) {
            window.location.href = href;
        }
    }

    function filterByField(input) {
        clearTimeout(stokSearchTimer);
        stokSearchTimer = setTimeout(() => {
            const url = new URL(window.location.href);
            if (input.value) {
                url.searchParams.set('search', input.value);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.delete('page');
            fetchStokBarang(url.toString());
        }, 400);
    }

    function filterByKategori(select) {
        const url = new URL(window.location.href);
        if (select.value) {
            url.searchParams.set('kategori', select.value);
        } else {
            url.searchParams.delete('kategori');
        }
        url.searchParams.delete('page');
        fetchStokBarang(url.toString());
    }

    function resetStok() {
        const searchInput = document.querySelector('[name="search"]');
        if (searchInput) {
            searchInput.value = '';
        }
        const kategoriSelect = document.querySelector('[name="kategori"]');
        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        url.searchParams.delete('kategori');
        url.searchParams.delete('page');
        if (kategoriSelect) {
            kategoriSelect.value = '';
        }
        fetchStokBarang(url.toString());
    }

    document.addEventListener('click', (event) => {
        const link = event.target.closest('#stok-table .pagination a');
        if (link) {
            event.preventDefault();
            fetchStokBarang(link.href);
        }
    });
</script>
@endpush