<div>
    <select name="perPage" id="perPage" class="form-control" onchange="let url = new URL(window.location.href); url.searchParams.set('perPage', this.value); window.location.href = url.toString();" style="width: auto; min-width: 120px">
        <option value="">Per Page</option>
        @foreach ($perPageOptions as $item)
            <option value="{{ $item }}" @selected((int) request('perPage') === $item)>{{ $item }}</option>
        @endforeach
    </select>
</div>