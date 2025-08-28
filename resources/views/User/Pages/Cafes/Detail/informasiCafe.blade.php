{{-- resources/views/cafe/partials/informasi-cafe.blade.php --}}
<div class="card-body">
    <div class="d-flex align-items-start gap-3">
        <img src="{{ data_get($cafe, 'logo_cafe') ?: '/images/cafe-logo.jpg' }}"
             alt="Logo Cafe" class="rounded-circle" style="width:56px;height:56px;object-fit:cover;"
             onerror="this.src='/images/cafe-logo.jpg'">

        <div class="flex-grow-1">
            <h2 class="h5 text-primary-brown mb-1">{{ data_get($cafe, 'name') }}</h2>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="badge text-bg-light d-inline-flex align-items-center">
                    <img src="/images/ic_stars.png" alt="Star" style="width:12px;height:12px;" class="me-1">
                    <strong class="text-primary-brown">{{ data_get($cafe, 'rating') }}</strong>
                </div>

                @php $maps = data_get($cafe, 'alamat.url_maps'); @endphp
                @if($maps)
                    <a href="{{ $maps }}" target="_blank" rel="noopener" class="btn-small-primary">
                        Open Maps
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div>{{ data_get($cafe, 'alamat.village') }}, {{ data_get($cafe, 'alamat.city') }}, {{ data_get($cafe, 'alamat.provinsi') }}</div>
    </div>

    <div class="mt-2 p-2 rounded" style="background: var(--light-brown);">
        @php
            $open = substr((string) data_get($cafe, 'open'), 0, 5);
            $close = substr((string) data_get($cafe, 'close'), 0, 5);
        @endphp
        <small class="fw-semibold text-primary-brown">Buka Pada: {{ $open }} - {{ $close }} WIB</small>
    </div>

    <hr class="mt-4">
</div>
