@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
 <div class="card">
    <div class="card-body">
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div class="d-flex align-items-center gap-2">
                <x-filter-by-field term="search" placeholder="Cari Data..." style="width: 450px"/>
                <button type="button" class="btn btn-round btn-secondary" title="Refresh" onclick="resetKategori()">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="d-flex align-items-center gap-2">
                <x-per-page-option/>
                <x-kategori-produk.formkategori-produk/>
            </div>
        </div>
        </div>
        <div id="kategori-table">
            @include('kategori-produk._table', ['kategori' => $kategori])
        </div>
    </div>
 </div>
@endsection

@push('scripts')
<script>
    let kategoriSearchTimer;

    async function fetchKategori(href) {
        try {
            const response = await fetch(href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (! response.ok) throw new Error(response.status);

            document.getElementById('kategori-table').innerHTML = await response.text();
            history.replaceState(null, '', href);
        } catch (error) {
            window.location.href = href;
        }
    }

    function filterByField(input) {
        clearTimeout(kategoriSearchTimer);
        kategoriSearchTimer = setTimeout(() => {
            const url = new URL(window.location.href);
            if (input.value) {
                url.searchParams.set('search', input.value);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.delete('page');
            fetchKategori(url.toString());
        }, 400);
    }

    function resetKategori() {
        const searchInput = document.querySelector('[name="search"]');
        if (searchInput) {
            searchInput.value = '';
        }
        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        url.searchParams.delete('page');
        fetchKategori(url.toString());
    }

    document.addEventListener('click', (event) => {
        const link = event.target.closest('#kategori-table .pagination a');
        if (link) {
            event.preventDefault();
            fetchKategori(link.href);
        }
    });
</script>
@endpush