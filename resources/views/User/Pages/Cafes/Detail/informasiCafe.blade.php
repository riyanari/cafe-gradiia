{{-- resources/views/cafe/partials/informasi-cafe.blade.php --}}
@php
    use Illuminate\Support\Str;

    // Data dasar
    $logo = data_get($cafe, 'logo_cafe') ?: '/images/cafe-logo.jpg';
    $name = trim((string) data_get($cafe, 'name'));
    $rating = data_get($cafe, 'rating');

    $village = data_get($cafe, 'alamat.village');
    $city    = data_get($cafe, 'alamat.city');
    $prov    = data_get($cafe, 'alamat.provinsi');

    // Sumber URL maps mentah dari data
    $mapsRaw = trim((string) data_get($cafe, 'alamat.url_maps'));
    $host = $mapsRaw ? parse_url($mapsRaw, PHP_URL_HOST) : null;
    $isShortDynamic = $host && Str::contains($host, 'maps.app.goo.gl'); // short link rawan putus

    // Fallback berbasis koordinat / place_id / query nama+alamat
    $lat     = data_get($cafe, 'alamat.lat');
    $lng     = data_get($cafe, 'alamat.lng');
    $placeId = data_get($cafe, 'alamat.place_id');

    $addressLine = collect([$village, $city, $prov])->filter()->implode(', ');

    if ($placeId) {
        // Paling akurat jika punya place_id
        $fallbackUrl = "https://www.google.com/maps/search/?api=1&query=place_id:{$placeId}";
    } elseif ($lat && $lng) {
        // Kedua: koordinat
        $fallbackUrl = "https://www.google.com/maps/search/?api=1&query={$lat},{$lng}";
    } else {
        // Ketiga: query teks (nama + alamat)
        $query = trim($name . ' ' . $addressLine);
        $fallbackUrl = $query ? "https://www.google.com/maps/search/?api=1&query=" . rawurlencode($query) : null;
    }

    // Pakai url_maps jika valid & bukan dynamic short link; selain itu pakai fallback
    $mapsUrl = (! $isShortDynamic && filter_var($mapsRaw, FILTER_VALIDATE_URL)) ? $mapsRaw : $fallbackUrl;

    // Jam operasional ditampilkan HH:MM
    $open  = substr((string) data_get($cafe, 'open'), 0, 5);
    $close = substr((string) data_get($cafe, 'close'), 0, 5);
@endphp

<div class="card-body">
    <div class="d-flex align-items-start gap-3">
        <img
            src="{{ $logo }}"
            alt="Logo Cafe"
            class="rounded-circle"
            style="width:56px;height:56px;object-fit:cover;"
            onerror="this.src='/images/cafe-logo.jpg'"
            loading="lazy"
            decoding="async"
        >

        <div class="flex-grow-1">
            <h2 class="h5 text-primary-brown mb-1">{{ $name }}</h2>

            <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="badge text-bg-light d-inline-flex align-items-center">
                    <img src="/images/ic_stars.png" alt="Star" style="width:12px;height:12px;" class="me-1">
                    <strong class="text-primary-brown">{{ $rating }}</strong>
                </div>

                @if($mapsUrl)
                    <a href="{{ $mapsUrl }}"
                       target="_blank"
                       rel="noopener noreferrer nofollow"
                       class="btn-small-primary btn-compact">
                        Open Maps
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-3">
        <div>{{ $village }}, {{ $city }}, {{ $prov }}</div>
    </div>

    <div class="mt-2 p-2 rounded" style="background: var(--light-brown);">
        <small class="fw-semibold text-primary-brown">
            Buka Pada: {{ $open }} - {{ $close }} WIB
        </small>
    </div>

    <hr class="mt-4">
</div>
