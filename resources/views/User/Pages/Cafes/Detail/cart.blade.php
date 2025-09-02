@extends('User.Pages.Cafes.Detail.layouts')

@section('title', 'Keranjang')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container my-4 pb-5" style="max-width:480px">
        <div class="d-flex align-items-center gap-2 mb-3">
            {{-- <a href="{{ route('cafe.index') }}" class="btn btn-link text-decoration-none px-0">&larr;</a> --}}
            <h1 class="h5 mb-0">Keranjang</h1>
        </div>

        {{-- Empty state --}}
        <div id="cartEmpty" class="text-center py-5 d-none">
            <img src="/images/empty_cart.svg" alt="" width="96" class="mb-3"
                onerror="this.style.display='none'">
            <p class="mb-2">Keranjang masih kosong.</p>
            <a href="{{ url()->previous() ?: route('cafe.index') }}" class="btn btn-brown rounded-pill">Pilih Menu</a>
        </div>

        {{-- List item --}}
        <div id="cartList" class="vstack gap-3"></div>

        {{-- Ringkasan --}}
        <div id="cartSummary" class="card mt-3 d-none">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="text-muted small">Total (<span id="cartTotalItems">0</span> item)</span>
                    <strong id="cartTotal">Rp0</strong>
                </div>
                <div class="d-flex justify-content-between small">
                    <span class="text-muted">Pajak & biaya lain</span>
                    <span class="text-muted">Ditampilkan di checkout</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Fixed bottom bar: aksi --}}
    <div class="fixed-bottom bg-white border-top">
        <div class="container py-3 d-flex gap-2 justify-content-center" style="max-width:480px">
            <button id="btnClearCart" class="btn btn-outline-secondary w-25">Kosongkan</button>
            <button id="btnCheckout" class="btn btn-brown flex-grow-1 rounded-pill fw-semibold" disabled>Lanjut ke
                Checkout</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===== Helpers global =====
        const currencyIDR = (num) => new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            })
            .format(Number(num || 0));
        const esc = (s) => String(s ?? '').replace(/[&<>"']/g, c => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        } [c]));

        const getCart = () => {
            try {
                const raw = sessionStorage.getItem('cafeCart');
                return raw && raw !== 'undefined' ? JSON.parse(raw) : [];
            } catch {
                return [];
            }
        };
        const setCart = (cart) => sessionStorage.setItem('cafeCart', JSON.stringify(cart || []));

        function calcCart() {
            const cart = getCart();
            const totalItems = cart.reduce((s, it) => s + (it.quantity || 0), 0);
            const totalPrice = cart.reduce((s, it) => s + (Number(it.price || 0) * (it.quantity || 0)), 0);
            return {
                cart,
                totalItems,
                totalPrice
            };
        }

        // Template untuk item BARU saja (row yang belum ada)
        function tplItem(it) {
            const id = it.id;
            const name = (it.name ?? '').toString();
            const qty = Number(it.quantity || 0);
            const price = Number(it.price || 0);
            const img = it.image || '/images/null_image.png';
            const subtotal = price * qty;

            return `
      <div class="card shadow-sm cart-row" data-id="${id}">
        <div class="card-body">
          <div class="d-flex align-items-start gap-3">
            <img src="${img}" alt="" width="64" height="64"
                 class="rounded object-fit-cover"
                 loading="lazy" decoding="async"
                 onerror="this.src='/images/null_image.png'">
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between align-items-start">
                <div class="fw-semibold">${esc(name)}</div>
                <button class="btn btn-link text-danger p-0 small" data-action="remove" data-id="${id}">Hapus</button>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="btn-group btn-group-sm" role="group" aria-label="Kuantitas">
                  <button class="btn btn-outline-brown" data-action="minus" data-id="${id}" aria-label="Kurangi">-</button>
                  <button class="btn btn-light" disabled style="min-width:2.25rem" data-role="qty">${qty}</button>
                  <button class="btn btn-brown" data-action="plus" data-id="${id}" aria-label="Tambah">+</button>
                </div>
                <strong class="ms-3" data-role="subtotal">${currencyIDR(subtotal)}</strong>
              </div>

              <div class="small text-muted mt-1">@ ${currencyIDR(price)}</div>

              <!-- Catatan -->
              <input
                type="text"
                class="form-control form-control-sm mt-2 cart-note"
                data-id="${id}"
                placeholder="Catatan (opsional, mis. ‘tanpa gula’, pedas, dll)"
                value="${esc(it.note)}">
            </div>
          </div>
        </div>
      </div>
    `;
        }

        // ===== RENDER dengan diff (tanpa re-render img) =====
        function renderCart() {
            const {
                cart,
                totalItems,
                totalPrice
            } = calcCart();
            const list = document.getElementById('cartList');
            const empty = document.getElementById('cartEmpty');
            const summary = document.getElementById('cartSummary');
            const totalEl = document.getElementById('cartTotal');
            const totalItemsEl = document.getElementById('cartTotalItems');
            const btnCheckout = document.getElementById('btnCheckout');

            if (!cart.length) {
                // kosong: bersihkan DOM yang ada
                list.querySelectorAll('.cart-row').forEach(row => row.remove());
                empty.classList.remove('d-none');
                summary.classList.add('d-none');
                totalEl.textContent = 'Rp0';
                totalItemsEl.textContent = '0';
                btnCheckout.disabled = true;
                return;
            }

            empty.classList.add('d-none');
            summary.classList.remove('d-none');
            btnCheckout.disabled = false;

            // 1) Hapus row yang tidak ada lagi di cart
            const idsInCart = new Set(cart.map(it => String(it.id)));
            list.querySelectorAll('.cart-row').forEach(row => {
                const id = row.dataset.id;
                if (!idsInCart.has(String(id))) row.remove();
            });

            // 2) Update atau insert row per item
            cart.forEach(it => {
                const id = String(it.id);
                let row = list.querySelector(`.cart-row[data-id="${CSS.escape(id)}"]`);
                const subtotal = Number(it.price || 0) * Number(it.quantity || 0);

                if (!row) {
                    // belum ada → tambahkan elemen baru (img akan dibuat SEKALI saja)
                    list.insertAdjacentHTML('beforeend', tplItem(it));
                    return;
                }

                // sudah ada → PATCH teks qty & subtotal saja (img TIDAK disentuh)
                const qtyEl = row.querySelector('[data-role="qty"]');
                const subEl = row.querySelector('[data-role="subtotal"]');
                if (qtyEl) qtyEl.textContent = it.quantity;
                if (subEl) subEl.textContent = currencyIDR(subtotal);

                // sinkron note jika input tidak sedang fokus (agar tidak ganggu user mengetik)
                const noteEl = row.querySelector('.cart-note');
                if (noteEl && document.activeElement !== noteEl) {
                    noteEl.value = it.note || '';
                }
            });

            // 3) Update ringkasan
            totalEl.textContent = currencyIDR(totalPrice);
            totalItemsEl.textContent = String(totalItems);
        }

        document.addEventListener('DOMContentLoaded', () => {
            renderCart();

            const list = document.getElementById('cartList');

            // Delegasi plus/minus/hapus → setelah ubah data, panggil renderCart() (patching)
            list.addEventListener('click', (e) => {
                const btn = e.target.closest('[data-action]');
                if (!btn) return;
                const id = btn.dataset.id;
                const action = btn.dataset.action;
                const cart = getCart();
                const idx = cart.findIndex(x => String(x.id) === String(id));
                if (idx === -1) return;

                if (action === 'plus') cart[idx].quantity += 1;
                if (action === 'minus') {
                    cart[idx].quantity -= 1;
                    if (cart[idx].quantity <= 0) cart.splice(idx, 1);
                }
                if (action === 'remove') cart.splice(idx, 1);

                setCart(cart);
                renderCart();
            });

            // Simpan catatan saat diubah (tanpa rerender img)
            list.addEventListener('input', (e) => {
                const noteEl = e.target.closest('.cart-note');
                if (!noteEl) return;
                const id = noteEl.dataset.id;
                const cart = getCart();
                const idx = cart.findIndex(x => String(x.id) === String(id));
                if (idx === -1) return;
                cart[idx].note = (noteEl.value || '').trim();
                setCart(cart);
                // tidak perlu renderCart(); biarkan realtime mengetik tanpa repaint
            });

            // Kosongkan
            document.getElementById('btnClearCart').addEventListener('click', () => {
                setCart([]);
                renderCart();
            });

            // Checkout
            document.getElementById('btnCheckout').addEventListener('click', () => {
                window.location.href = "{{ route('cafe.checkout') }}";
            });
        });
    </script>
@endsection
