{{-- resources/views/cafe/partials/list-image.blade.php --}}
<div class="mx-auto" style="max-width: 480px;">
    <div class="position-relative">
        <button type="button" class="btn btn-dark btn-sm position-absolute top-0 start-0 m-2 rounded-pill d-flex align-items-center"
                onclick="history.back()">
            {{-- Icon panah kiri --}}
            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                <path fill-rule="evenodd" d="M10 5a1 1 0 00-1.414 0L4.293 9.293a1 1 0 000 1.414l4.293 4.293a1 1 0 001.414-1.414L6.414 10l3.293-3.293A1 1 0 0010 5z" clip-rule="evenodd"/>
            </svg>
            Back
        </button>

        <div id="cafeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach(data_get($cafe, 'images', []) as $idx => $img)
                    <button type="button" data-bs-target="#cafeCarousel" data-bs-slide-to="{{ $idx }}" class="{{ $idx===0?'active':'' }}" aria-current="{{ $idx===0?'true':'false' }}" aria-label="Slide {{ $idx+1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner rounded shadow-sm">
                @forelse(data_get($cafe, 'images', []) as $idx => $img)
                    <div class="carousel-item {{ $idx===0?'active':'' }}">
                        <img src="{{ data_get($img, 'image_url') ?: '/images/image_null.png' }}"
                             class="d-block w-100" alt="Foto Cafe" onerror="this.src='/images/image_null.png'">
                    </div>
                @empty
                    <div class="carousel-item active">
                        <img src="/images/image_null.png" class="d-block w-100" alt="Foto Cafe">
                    </div>
                @endforelse
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#cafeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#cafeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
        </div>
    </div>
</div>
