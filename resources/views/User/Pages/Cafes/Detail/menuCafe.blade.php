{{-- resources/views/cafe/partials/menu-cafe.blade.php --}}
@php
    $menus = collect(data_get($cafe, 'menus', []));
    $categories = $menus->pluck('category')->filter()->unique()->values();
@endphp

<div class="card-body pt-0">
    {{-- Header kecil: mode makan & meja --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light-brown"
                 style="width:48px;height:48px;">
                <img src="/images/img_meja_cafe.png" class="img-fluid" alt="Meja Cafe" style="width:32px;height:32px;">
            </div>
            <div class="position-relative">
                <select class="form-select form-select-sm">
                    <option value="makan-ditempat">Makan di Tempat</option>
                    <option value="bawa-pulang">Bawa Pulang</option>
                </select>
            </div>
        </div>
        <div class="badge text-bg-light">
            <strong class="text-primary-brown">Meja 1</strong>
        </div>
    </div>

    {{-- Sticky controls: kategori & search --}}
    <div class="position-sticky top-0 bg-white z-3 py-2 mt-3" style="box-shadow: 0 .25rem .5rem rgba(0,0,0,.05);">
        <div class="row g-2">
            <div class="col-12 col-md-6">
                <select id="selectCategory" class="form-select fw-semibold">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <div class="input-group">
                    <span class="input-group-text" id="searchIcon">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1111.2 2.6l4.2 4.2a1 1 0 11-1.4 1.4l-4.2-4.2A6 6 0 012 8z"
                                  clip-rule="evenodd" />
                        </svg>
                    </span>
                    <input id="inputSearch" type="text" class="form-control" placeholder="Mau makan apa?"
                           aria-describedby="searchIcon">
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Menu per Kategori --}}
    <div class="mt-3" id="menuList" style="max-width: 480px; margin: 0 auto;">
        @foreach ($categories as $i => $cat)
            @php $catId = 'cat-'.Str::slug($cat); @endphp
            <div id="{{ $catId }}" class="mb-4 category-section" data-category="{{ $cat }}">
                <div class="d-flex justify-content-between align-items-center px-2">
                    <h3 class="h6 fw-bold text-primary-brown mb-0">{{ $cat }}</h3>

                    {{-- Toggle show/hide (collapse) --}}
                    <button class="btn btn-link text-decoration-none p-0 small" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $catId }}" aria-expanded="true">
                        <span class="collapse-toggle-text">Sembunyikan</span>
                    </button>
                </div>

                <div id="collapse-{{ $catId }}" class="collapse show">
                    <div class="vstack gap-3 mt-2">
                        @foreach ($menus->where('category', $cat) as $item)
                            @php
                                $available = data_get($item, 'isAvailable', true);
                                $isCustomizable = data_get($item, 'isCustomizable', false);
                                $price = (int) data_get($item, 'price', 0);
                                $img = data_get($item, 'img_menu') ?: '/images/default_food.jpg';
                            @endphp

                            <div class="card shadow-sm menu-item" data-id="{{ data_get($item, 'id') }}"
                                 data-name="{{ data_get($item, 'name') }}" data-price="{{ $price }}"
                                 data-category="{{ $cat }}">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <img src="{{ $img }}"
                                             class="img-fluid rounded-start h-100 object-fit-cover"
                                             alt="{{ data_get($item, 'name') }}"
                                             onerror="this.src='/images/default_food.jpg'">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body py-2">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title h6 mb-1 item-name">{{ data_get($item, 'name') }}</h5>
                                                @if (!$available)
                                                    <span class="badge text-bg-secondary">Habis</span>
                                                @endif
                                            </div>
                                            <p class="card-text mb-2">
                                                <strong class="text-primary-brown item-price" data-price="{{ $price }}">
                                                    {{ number_format($price, 0, ',', '.') }}
                                                </strong>
                                            </p>

                                            <div class="d-flex align-items-center gap-2">
                                                @if ($available)
                                                    <div class="btn-group" role="group">
                                                        <button type="button"
                                                                class="btn btn-outline-brown btn-sm btn-minus">-</button>
                                                        <button type="button"
                                                                class="btn btn-brown btn-sm btn-plus">+</button>
                                                    </div>
                                                @endif

                                                @if ($isCustomizable)
                                                    <a href="{{ route('cafe.menu.customize', ['menu' => data_get($item, 'id')]) }}"
                                                       class="btn-small-primary">
                                                        Customize
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if ($i < count($categories) - 1)
                    <hr class="my-4">
                @endif
            </div>
        @endforeach
    </div>
</div>


{{-- Scripts khusus menu list --}}
@push('scripts')
    <script>
        (function() {
            // Search filter
            const inputSearch = document.getElementById('inputSearch');
            const sections = document.querySelectorAll('.category-section');
            const items = document.querySelectorAll('.menu-item');

            function applyFilter() {
                const q = (inputSearch.value || '').toLowerCase();
                items.forEach(card => {
                    const name = (card.querySelector('.item-name')?.textContent || '').toLowerCase();
                    card.style.display = name.includes(q) ? '' : 'none';
                });
                // Hide category if none visible
                sections.forEach(sec => {
                    const visible = sec.querySelectorAll('.menu-item:not([style*="display: none"])').length > 0;
                    sec.style.display = visible ? '' : 'none';
                });
            }
            if (inputSearch) inputSearch.addEventListener('input', applyFilter);

            // Category change -> scroll into view
            const selectCategory = document.getElementById('selectCategory');
            if (selectCategory) {
                selectCategory.addEventListener('change', (e) => {
                    const val = e.target.value;
                    const target = document.getElementById('cat-' + slugify(val));
                    if (target) target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }

            function slugify(str) {
                return (str || '').toString().toLowerCase()
                    .replace(/\s+/g, '-').replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-').replace(/^-+/, '').replace(/-+$/, '');
            }

            // Collapse toggle text swap
            document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(btn => {
                const targetSel = btn.getAttribute('data-bs-target');
                const target = document.querySelector(targetSel);
                const txt = btn.querySelector('.collapse-toggle-text');
                if (!target || !txt) return;

                target.addEventListener('shown.bs.collapse', () => txt.textContent = 'Sembunyikan');
                target.addEventListener('hidden.bs.collapse', () => txt.textContent = 'Tampilkan');
            });

            // Cart ops
            const getCart = () => {
                try {
                    const raw = sessionStorage.getItem('cafeCart');
                    return raw && raw !== 'undefined' ? JSON.parse(raw) : [];
                } catch {
                    return [];
                }
            };
            const setCart = (cart) => sessionStorage.setItem('cafeCart', JSON.stringify(cart || []));
            const updateBadge = () => {
                const ev = new Event('storage'); // trigger global badge update in parent
                window.dispatchEvent(ev);
            };

            function addItemToCart(item) {
                const cart = getCart();
                const idx = cart.findIndex(x => x.id == item.id);
                if (idx >= 0) cart[idx].quantity += 1;
                else cart.push({
                    ...item,
                    quantity: 1
                });
                setCart(cart);
                updateBadge();
            }

            function decreaseItem(item) {
                const cart = getCart();
                const idx = cart.findIndex(x => x.id == item.id);
                if (idx >= 0) {
                    cart[idx].quantity -= 1;
                    if (cart[idx].quantity <= 0) cart.splice(idx, 1);
                    setCart(cart);
                    updateBadge();
                }
            }

            // Bind plus/minus buttons
            document.querySelectorAll('.menu-item').forEach(card => {
                const id = card.dataset.id;
                const name = card.dataset.name;
                const price = Number(card.dataset.price || 0);
                const img = card.querySelector('img')?.getAttribute('src') || '/images/default_food.jpg';

                const plus = card.querySelector('.btn-plus');
                const minus = card.querySelector('.btn-minus');

                if (plus) plus.addEventListener('click', () => addItemToCart({
                    id,
                    name,
                    price,
                    image: img
                }));
                if (minus) minus.addEventListener('click', () => decreaseItem({
                    id
                }));
            });
        })();
    </script>
@endpush
