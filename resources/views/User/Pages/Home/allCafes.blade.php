<!-- Features Section -->
<section id="cafe" class="features card-cafe d-flex align-items-center justify-content-between"
    style="background-image: url('{{ asset('images/bg_cafe.png') }}'); background-size: cover; background-position: center;">
    <div class="d-none d-lg-block">
        <img src="{{ asset('images/img_cafe.png') }}"
            class="img-fluid hero-img animate__animated animate__fadeIn animate__delay-2s" alt="Cafe"
            style="max-width: 640px;" />
    </div>

    {{-- {/* Teks dan tombol */} --}}
    <div class="text-left">
        <p class="text-3xl font-bold text-white mb-6 animate__animated animate__fadeInUp animate__delay-1s">
            Find your <br />
            favorite cafe
        </p>
        <p class="text-sm font-light text-gray-300 mb-6 animate__animated animate__fadeInUp animate__delay-2s">
            Explore a variety of cozy cafes, each offering
            <br /> a unique atmosphere, delicious coffee, <br />
            and the perfect spot to unwind, work, or catch up
            with friends.
        </p>
        <div class="animate__animated animate__fadeInUp animate__delay-2s">
            <a href="{{ route('cafe.index') }}" class="btn btn-primary me-2">All Cafe</a>
            {{-- <a href="#features" class="btn btn-outline-primary">Learn More</a> --}}
        </div>

    </div>

</section>
