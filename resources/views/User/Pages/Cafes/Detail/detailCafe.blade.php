{{-- resources/views/cafe/detail.blade.php --}}
@extends('User.Pages.Cafes.Detail.layouts')

@section('title', 'Detail Cafe')

@section('head')
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container my-4 pb-5">
        @include('User.Pages.Cafes.Detail.listImage', ['cafe' => $cafe])
        <div class="card shadow-sm mx-auto mt-4" style="max-width: 480px;">
            @include('User.Pages.Cafes.Detail.informasiCafe', ['cafe' => $cafe])
            @include('User.Pages.Cafes.Detail.menuCafe', ['cafe' => $cafe])
        </div>
    </div>

    {{-- Fixed bottom bar: Cek Keranjang --}}
    <div class="fixed-bottom bg-white border-top">
        <div class="container py-3 d-flex justify-content-center">
            <button id="btnCekKeranjang"
                class="btn-small-primary w-100 rounded-pill fw-semibold d-flex align-items-center justify-content-center"
                style="max-width: 480px;">
                <span>Cek Keranjang</span>
                <span id="cartBadge" class="badge bg-white text-primary-brown ms-2"></span>
            </button>
        </div>
    </div>

@endsection

@section('scripts')
    {{-- Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Util & Cart --}}
    <script>
        // Helpers
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

        // Update cart badge on load & on change
        function updateCartBadge() {
            const cart = getCart();
            const totalItems = cart.reduce((s, it) => s + (it.quantity || 0), 0);
            const totalPrice = cart.reduce((s, it) => s + (Number(it.price || 0) * (it.quantity || 0)), 0);
            const el = document.getElementById('cartBadge');
            if (el) el.textContent = `${currencyIDR(totalPrice)} (${totalItems})`;
        }
        document.addEventListener('DOMContentLoaded', updateCartBadge);
        window.addEventListener('storage', updateCartBadge); // just in case

        // Hook "Cek Keranjang" button (you can redirect to your cart route)
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('btnCekKeranjang');
            if (btn) btn.addEventListener('click', () => {
                window.location.href = "{{ route('cafe.cart') }}";
            });
        });
    </script>
@endsection
