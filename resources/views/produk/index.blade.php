@extends('layouts.kai')
@section('page_title', $pageTitle)
@section('content')
 <div class="card">
    <div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div class="d-flex align-items-center gap-2">
                <x-filter-by-field term="search" placeholder="Cari Data..." style="width: 450px"/>
                <button type="button" class="btn btn-round btn-secondary" title="Refresh" onclick="resetProduk()">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <div class="d-flex align-items-center gap-2">
                <x-per-page-option/>
                <x-produk.form-produk/>
            </div>
        </div>
    </div>
    <div id="produk-table">
        @include('produk._table', ['produk' => $produk])
    </div>
 </div>
@endsection

@push('scripts')
<script>
    let produkSearchTimer;

    async function fetchProduk(href) {
        try {
            const response = await fetch(href, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            if (! response.ok) throw new Error(response.status);

            document.getElementById('produk-table').innerHTML = await response.text();
            history.replaceState(null, '', href);
        } catch (error) {
            window.location.href = href;
        }
    }

    function filterByField(input) {
        clearTimeout(produkSearchTimer);
        produkSearchTimer = setTimeout(() => {
            const url = new URL(window.location.href);
            if (input.value) {
                url.searchParams.set('search', input.value);
            } else {
                url.searchParams.delete('search');
            }
            url.searchParams.delete('page');
            fetchProduk(url.toString());
        }, 400);
    }

    function resetProduk() {
        const searchInput = document.querySelector('[name="search"]');
        if (searchInput) {
            searchInput.value = '';
        }
        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        url.searchParams.delete('page');
        fetchProduk(url.toString());
    }

    document.addEventListener('click', (event) => {
        const link = event.target.closest('#produk-table .pagination a');
        if (link) {
            event.preventDefault();
            fetchProduk(link.href);
        }
    });
</script>
@endpush