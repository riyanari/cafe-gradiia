<section class="hero-cafe" style="background-image:url('{{ asset('images/bg_listcafe.png') }}')">
    <div class="hero__text">
        <h1 class="hero__title">Find your <br> favorite cafe</h1>
        <p class="hero__desc">
            Explore a variety of cozy cafes, <br> each offering a unique atmosphere, delicious coffee, <br>
            and the perfect spot to unwind, work, or catch up with friends.
        </p>
    </div>
    <div class="hero__img">
        <img src="{{ asset('images/img_cafe.png') }}" alt="Cafe Illustration">
    </div>

    {{-- FILTER BAR --}}
    <div class="filter-wrap">
        <div class="filter" id="filterBar">
            <div class="filter__ribbon">Filter</div>

            {{-- Location --}}
            <div class="filter__item">
                <img src="{{ asset('images/ic_location_yellow.png') }}" alt="" width="22" height="22">
                <div>
                    <select id="citySelect">
                        <option value="">All</option>
                        {{-- opsi kota akan diisi via JS dari data --}}
                    </select>
                    <div class="filter__hint">Select the locations</div>
                </div>
                <img src="{{ asset('images/ic_bullets.png') }}" alt="" width="22" height="22">
            </div>

            <div class="divider"></div>

            {{-- Place type --}}
            <div class="filter__item">
                <img src="{{ asset('images/ic_building.png') }}" alt="" width="22" height="22">
                <div>
                    <select id="typeSelect">
                        <option value="">All</option>
                        {{-- opsi tipe tempat akan diisi via JS --}}
                    </select>
                    <div class="filter__hint">Select place type</div>
                </div>
                <img src="{{ asset('images/ic_bullets.png') }}" alt="" width="22" height="22">
            </div>

            <div class="divider"></div>

            {{-- Rating --}}
            <div class="filter__item">
                <img src="{{ asset('images/ic_stars.png') }}" alt="" width="22" height="22">
                <div>
                    <select id="ratingSelect">
                        <option value="All">All</option>
                        <option value="3-5">3-5 Stars</option>
                        <option value="4-5">4-5 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                    <div class="filter__hint">Select cafe rating</div>
                </div>
                <img src="{{ asset('images/ic_bullets.png') }}" alt="" width="22" height="22">
            </div>

            <div class="divider"></div>

            {{-- Search toggle / input --}}
            <div id="searchToggleArea">
                <button class="btn btn-primary" id="searchBtn">Search</button>
            </div>
            <div id="searchInputArea" class="searchbox" style="display:none;">
                <input type="text" id="searchInput" placeholder="Place cafe..." autocomplete="off">
                <div class="filter__hint">Insert place name</div>
            </div>
        </div>
    </div>
</section>
