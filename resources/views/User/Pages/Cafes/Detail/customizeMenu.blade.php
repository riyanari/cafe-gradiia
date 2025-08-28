{{-- resources/views/cafe/customize-menu.blade.php --}}
@extends('User.Pages.Cafes.Detail.layouts')

@section('title', 'Customize ' . data_get($menu, 'name'))

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container my-4" style="max-width: 480px;">
        <div class="position-relative mb-2">
            <button type="button"
                class="btn btn-outline-brown btn-sm position-absolute top-0 start-0 m-1 rounded-pill d-flex align-items-center"
                onclick="history.back()">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 00-1.414 0L4.293 9.293a1 1 0 000 1.414l4.293 4.293a1 1 0 001.414-1.414L6.414 10l3.293-3.293A1 1 0 0010 5z"
                        clip-rule="evenodd" />
                </svg>
                Back
            </button>
        </div>

        <div class="card shadow-sm">
            @php $img = data_get($menu, 'image') ?: '/images/image_null.png'; @endphp
            <img src="{{ $img }}" class="card-img-top" alt="{{ data_get($menu, 'name') }}"
                onerror="this.src='/images/image_null.png'">

            <div class="card-body">
                <h1 class="h6 fw-semibold text-primary-brown mb-2">Customize {{ data_get($menu, 'name') }}</h1>
                <hr class="mt-3">

                {{-- Opsi --}}
                <div id="optionsWrap" class="mt-3">
                    @foreach ((array) data_get($menu, 'options', []) as $opt)
                        <div class="d-flex justify-content-between align-items-center mb-3 option-row"
                            data-id="{{ data_get($opt, 'id') }}" data-name="{{ data_get($opt, 'name') }}"
                            data-price="{{ (int) data_get($opt, 'price', 0) }}">
                            <label class="form-check-label">{{ data_get($opt, 'name') }}</label>
                            <div class="d-flex align-items-center gap-2">
                                <span
                                    class="text-muted small">{{ number_format((int) data_get($opt, 'price', 0), 0, ',', '.') }}</span>
                                <input class="form-check-input option-check" type="checkbox">
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Qty & Simpan --}}
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-brown btn-sm" id="btnMinus">-</button>
                        <button type="button" class="btn btn-brown btn-sm" id="btnPlus">+</button>
                    </div>

                    <div class="ms-2"><span class="fw-semibold text-primary-brown" id="qtyLabel">1</span></div>

                    <button type="button" class="btn-small-primary ms-auto" id="btnSave">
                        Tambah | <span id="totalLabel"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const basePrice = Number({{ (int) data_get($menu, 'price', 0) }});
        const menuId = "{{ data_get($menu, 'id') }}";
        const menuName = "{{ data_get($menu, 'name') }}";
        const menuImage = "{{ $img }}";

        let qty = 1;

        const currencyIDR = (num) => new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(Number(num || 0));
        const getCart = () => {
            try {
                const raw = sessionStorage.getItem('cafeCart');
                return raw && raw !== 'undefined' ? JSON.parse(raw) : [];
            } catch {
                return [];
            }
        };
        const setCart = (cart) => sessionStorage.setItem('cafeCart', JSON.stringify(cart || []));

        function calcTotal() {
            const opts = [...document.querySelectorAll('.option-row')].map(row => {
                const price = Number(row.dataset.price || 0);
                const name = row.dataset.name;
                const id = row.dataset.id;
                const checked = row.querySelector('.option-check').checked;
                return checked ? {
                    id,
                    name,
                    price
                } : null;
            }).filter(Boolean);
            const optionsPrice = opts.reduce((s, o) => s + (o.price || 0), 0);
            return {
                total: (basePrice + optionsPrice) * qty,
                selected: opts
            };
        }

        function updateLabels() {
            document.getElementById('qtyLabel').textContent = qty;
            document.getElementById('totalLabel').textContent = currencyIDR(calcTotal().total);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // qty controls
            document.getElementById('btnPlus').addEventListener('click', () => {
                qty += 1;
                updateLabels();
            });
            document.getElementById('btnMinus').addEventListener('click', () => {
                qty = Math.max(1, qty - 1);
                updateLabels();
            });
            document.querySelectorAll('.option-check').forEach(chk => chk.addEventListener('change', updateLabels));
            updateLabels();

            // save
            document.getElementById('btnSave').addEventListener('click', () => {
                try {
                    const cart = getCart();
                    const {
                        selected
                    } = calcTotal();
                    const item = {
                        id: menuId,
                        name: menuName,
                        price: basePrice,
                        image: menuImage,
                        quantity: qty,
                        options: selected
                    };
                    cart.push(item);
                    setCart(cart);
                    alert('Ditambahkan ke keranjang!');
                    history.back();
                } catch (e) {
                    console.error('Error adding to cart', e);
                    alert('Terjadi kesalahan. Coba lagi ya.');
                }
            });
        });
    </script>
@endsection
