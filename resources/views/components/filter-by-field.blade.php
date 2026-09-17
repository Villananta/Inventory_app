<div class="d-flex {{ $attributes->get('class') }}" style="{{ $attributes->get('style') }}">
    <input type="text" name="{{ $term }}" id="{{ $term }}" class="form-control" placeholder="{{ $placeholder }}" value="{{ request($term) }}" onkeydown="if(event.key === 'Enter'){event.preventDefault(); filterByField(this)}" oninput="filterByField(this)">
    <button type="button" class="btn btn-dark ms-2" onclick="filterByField(this.previousElementSibling)">
        <i class="fas fa-search"></i>
    </button>
</div>