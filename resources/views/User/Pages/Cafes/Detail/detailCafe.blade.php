@extends('User.Pages.Cafes.Detail.layouts')
@section('title', 'Detail Cafe')
@section('head')
    {{-- Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

<body>
    @section('content')

        <div class="container-mobile">
            <!-- Header dengan gambar cafe -->
            <div class="position-relative mb-4">
                <button class="back-btn" onclick="history.back()">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 00-1.414 0L4.293 9.293a1 1 0 000 1.414l4.293 4.293a1 1 0 001.414-1.414L6.414 10l3.293-3.293A1 1 0 0010 5z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div id="cafeCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <div class="cafe-image error-image">
                                <span>Gambar Cafe</span>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="cafe-image error-image">
                                <span>Gambar Tidak Tersedia</span>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-indicators position-relative justify-content-center mt-2">
                        <button type="button" data-bs-target="#cafeCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#cafeCarousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    </div>
                </div>
            </div>

            <!-- Informasi Cafe -->
            <div class="card">
                <div class="card-header fw-bold">Informasi Cafe</div>
                <div class="card-body d-flex flex-wrap gap-3 small">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle-fill text-secondary me-1 fs-6"></i>
                        <span class="fw-semibold me-1">Nama:</span>
                        <span class="text-muted">{{ $cafe->name }}</span>
                    </div>

                    @if ($cafe->alamat)
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill text-secondary me-1 fs-6"></i>
                            <span class="fw-semibold me-1">Alamat:</span>
                            <span class="text-muted">{{ $cafe->alamat->village }}</span>
                        </div>
                    @endif

                    <div class="d-flex align-items-center">
                        <i class="bi bi-clock-fill text-secondary me-1 fs-6"></i>
                        <span class="fw-semibold me-1">Jam:</span>
                        <span class="text-muted">{{ $cafe->open }} - {{ $cafe->close }}</span>
                    </div>
                </div>
            </div>



            @include('User.Pages.Cafes.Detail.listImage', ['cafe' => $cafe])
        </div>
        </div>

        <!-- Fixed Bottom Bar -->
        <div class="fixed-bottom-bar">
            <button id="btnCekKeranjang" class="cart-btn">
                <span>Cek Keranjang</span>
                <span id="cartBadge" class="badge">Rp 0 (0)</span>
            </button>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection

    @section('scripts')
        <script>
            // Helpers
            const currencyIDR = (num) => new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
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

            // Update cart badge
            function updateCartBadge() {
                const cart = getCart();
                const totalItems = cart.reduce((s, it) => s + (it.quantity || 0), 0);
                const totalPrice = cart.reduce((s, it) => s + (Number(it.price || 0) * (it.quantity || 0)), 0);
                const el = document.getElementById('cartBadge');
                if (el) el.textContent = `${currencyIDR(totalPrice)} (${totalItems})`;
            }

            // Handle quantity buttons
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-item');
                    const isPlus = this.classList.contains('plus');
                    const input = document.querySelector(`.qty-input[data-item="${itemId}"]`);
                    let value = parseInt(input.value) || 0;

                    if (isPlus) {
                        value++;
                    } else if (value > 0) {
                        value--;
                    }

                    input.value = value;

                    // Update cart in sessionStorage
                    const cart = getCart();
                    const existingIndex = cart.findIndex(item => item.id === itemId);

                    if (value > 0) {
                        if (existingIndex >= 0) {
                            cart[existingIndex].quantity = value;
                        } else {
                            // In a real app, you would get this data from a data attribute
                            const menuItem = this.closest('.menu-item');
                            const title = menuItem.querySelector('.menu-title').textContent;
                            const price = menuItem.querySelector('.menu-price').textContent.replace(/\D/g, '');

                            cart.push({
                                id: itemId,
                                name: title,
                                price: price,
                                quantity: value
                            });
                        }
                    } else if (existingIndex >= 0) {
                        cart.splice(existingIndex, 1);
                    }

                    setCart(cart);
                    updateCartBadge();
                });
            });

            // Initialize cart badge
            document.addEventListener('DOMContentLoaded', updateCartBadge);

            // Handle cart button click
            document.getElementById('btnCekKeranjang').addEventListener('click', () => {
                alert('Fitur keranjang akan diarahkan ke halaman yang sesuai.');
                // window.location.href = '/cart'; // Uncomment in real implementation
            });

            // Handle image errors to prevent looping
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function() {
                    this.src =
                        'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iI2Y4ZjlmYyIvPjx0ZXh0IHg9IjUwJSIgeT0iNTAlIiBkeT0iLjM1ZW0iIHRleHQtYW5jaG9yPSJtaWRkbGUiIGZvbnQtc2l6ZT0iMTQiIGZpbGw9IiM2Yzc1N2QiPkdhbWJhciBUaWRhayBUZXJzZWRpYTwvdGV4dD48L3N2Zz4=';
                    this.onerror = null; // Prevent infinite loop
                });
            });
        </script>
    @endsection

    </html>
