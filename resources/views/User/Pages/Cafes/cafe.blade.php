@extends('User.Layouts.main')

@section('title', 'Cafe')

@section('content')
    {{-- HERO --}}
    @include('User.Pages.Cafes.hero')

    {{-- LIST --}}
    <section class="container" id="cafe">
        <div class="list" id="cafeList">
            {{-- isi kartu cafe dirender via JS --}}
        </div>
    </section>


    {{-- DATA dari server untuk JS --}}
    <script>
        window.__CAFES__ = @json($cafes ?? []);
    </script>

    <script>
        window.__CAFE_DETAIL_BASE__ = "{{ url('/cafe') }}";
    </script>


    {{-- RENDERING & FILTERING --}}
    <script>
        (function() {
            const allCafes = (Array.isArray(window.__CAFES__) ? window.__CAFES__ : []).map(c => ({
                ...c
            }));
            let filtered = [...allCafes];

            const citySelect = document.getElementById('citySelect');
            const typeSelect = document.getElementById('typeSelect');
            const ratingSelect = document.getElementById('ratingSelect');
            const listEl = document.getElementById('cafeList');

            const searchBtn = document.getElementById('searchBtn');
            const searchToggleArea = document.getElementById('searchToggleArea');
            const searchInputArea = document.getElementById('searchInputArea');
            const searchInput = document.getElementById('searchInput');

            // Helpers safe access
            const get = (obj, path) => path.split('.').reduce((o, k) => (o && o[k] !== undefined) ? o[k] : null, obj);

            // Populate select options (unique by value)
            function unique(arr) {
                return Array.from(new Set(arr.filter(Boolean)));
            }

            function fillSelectOptions() {
                const cities = unique(allCafes.map(c => get(c, 'alamat.city')));
                const types = unique(allCafes.map(c => c.place_type));

                cities.forEach(city => {
                    const opt = document.createElement('option');
                    opt.value = city;
                    opt.textContent = city;
                    citySelect.appendChild(opt);
                });
                types.forEach(t => {
                    const opt = document.createElement('option');
                    opt.value = t;
                    opt.textContent = t;
                    typeSelect.appendChild(opt);
                });
            }

            // Card HTML builder
            function cardHtml(c) {
                const img = (c.images && c.images[0] && c.images[0].image_url) ? c.images[0].image_url :
                    '{{ asset('images/image_null.png') }}';
                const slug = c.slug ? window.__CAFE_DETAIL_BASE__ + '/' + encodeURIComponent(c.slug) : '#';
                const nama = c.name || '-';
                const desa = get(c, 'alamat.village') || '';
                const kota = get(c, 'alamat.city') || '';
                const prov = get(c, 'alamat.provinsi') || '';
                const maps = get(c, 'alamat.url_maps');

                return `
                        <article class="card">
                            <a href="${slug}">
                            <img class="card__img" src="${img}" alt="${nama}">
                            </a>
                            <div class="card__body">
                                <h3 class="card__title"><a href="${slug}" style="text-decoration:none;color:inherit">${nama}</a></h3>
                                <p class="card__meta">${desa ? desa+', ' : ''}${kota}${prov ? ', '+prov : ''}</p>

                                <div class="card__btn" style="margin-top:30px;">
                                    <span class="card__meta card__stars">
                                        <img src="{{ asset('images/ic_stars.png') }}" alt="rating" class="icon-star">
                                        <span class="card__rating">${c.rating ?? '-'}</span>
                                    </span>
                                    <a class="btn btn-small-primary btn-sm" href="${slug}">View</a>
                                </div>

                            </div>
                        </article>
                        `;
            }

            // Empty state HTML
            function emptyHtml() {
                return `
          <div class="empty">
            <div class="empty__box">
              <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#9aa0a6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:block;margin:0 auto 10px">
                <path d="M9.172 16.172a4 4 0 0 1 5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0"></path>
              </svg>
              <div style="font-weight:600;color:#4b5563;margin-bottom:4px">Tidak Ada Cafe Ditemukan</div>
              <div class="muted">Silakan coba dengan filter yang berbeda</div>
            </div>
          </div>
        `;
            }

            // Render list
            function render() {
                if (!filtered.length) {
                    listEl.innerHTML = emptyHtml();
                    return;
                }
                listEl.innerHTML = filtered.map(cardHtml).join('');
            }

            // Apply filters
            function applyFilters() {
                const search = (searchInput.value || '').toLowerCase().trim();
                const city = (citySelect.value || '').toLowerCase();
                const type = (typeSelect.value || '').toLowerCase();
                const rating = ratingSelect.value;

                let res = [...allCafes];

                if (search) {
                    res = res.filter(c => (c.name || '').toLowerCase().includes(search));
                }
                if (city) {
                    res = res.filter(c => ((get(c, 'alamat.city') || '').toLowerCase()).includes(city));
                }
                if (type) {
                    res = res.filter(c => ((c.place_type || '').toLowerCase()) === type);
                }
                if (rating !== 'All') {
                    res = res.filter(c => {
                        const r = parseFloat(c.rating || 0);
                        switch (rating) {
                            case '3-5':
                                return r >= 3 && r <= 5;
                            case '4-5':
                                return r >= 4 && r <= 5;
                            case '5':
                                return r === 5;
                            default:
                                return true;
                        }
                    });
                }
                filtered = res;
                render();
            }

            // Events
            [citySelect, typeSelect, ratingSelect].forEach(el => el.addEventListener('change', applyFilters));
            searchInput.addEventListener('input', applyFilters);

            // Toggle Search
            searchBtn.addEventListener('click', function() {
                searchToggleArea.style.display = 'none';
                searchInputArea.style.display = 'block';
                searchInput.focus();
            });
            // Hide search when pressing ESC or when input is emptied and blurred
            searchInput.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    searchInput.value = '';
                    applyFilters();
                    searchInputArea.style.display = 'none';
                    searchToggleArea.style.display = 'block';
                }
            });
            searchInput.addEventListener('blur', () => {
                if (!searchInput.value.trim()) {
                    searchInputArea.style.display = 'none';
                    searchToggleArea.style.display = 'block';
                }
            });

            // Init
            fillSelectOptions();
            applyFilters();
        })();
    </script>


@endsection
