<div>
    <select name="perPage" id="perPage" class="form-control" onchange="window.location.href = '?perPage=' + this.value" style="width: auto; min-width: 120px">
        <option value="">Per Page</option>
        @foreach ($perPageOptions as $item)
            <option value="{{ $item }}" @selected((int) request('perPage') === $item)>{{ $item }}</option>
        @endforeach
    </select>
</div>