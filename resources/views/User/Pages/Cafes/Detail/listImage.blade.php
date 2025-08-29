<!-- Menu Cafe -->
            <div class="card">
                <div class="card-header">Menu Cafe</div>
                <div class="card-body p-0">
                    @if ($cafe->menus && count($cafe->menus) > 0)
                        @foreach ($cafe->menus as $menu)
                            <div class="menu-item">
                                @if ($menu->img_menu)
                                    <img src="{{ $menu->img_menu }}" class="menu-image" alt="{{ $menu->name }}"
                                        onerror="this.onerror=null; this.classList.add('error-image'); this.innerHTML='<span>No Image</span>';">
                                @else
                                    <div class="menu-image error-image">
                                        <span>No Image</span>
                                    </div>
                                @endif

                                <div class="menu-content">
                                    <div class="menu-title">
                                        {{ $menu->name }}
                                        @if ($menu->isRecommended)
                                            <span class="recommended-badge">Rekomendasi</span>
                                        @endif
                                    </div>
                                    <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                                    @if ($menu->category)
                                        <div class="menu-desc">Kategori: {{ $menu->category }}</div>
                                    @endif
                                    <div class="quantity-control">
                                        <button class="qty-btn minus" data-item="{{ $menu->id }}">-</button>
                                        <input type="text" class="qty-input" value="0" readonly
                                            data-item="{{ $menu->id }}">
                                        <button class="qty-btn plus" data-item="{{ $menu->id }}">+</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <p class="text-muted">Tidak ada menu tersedia</p>
                        </div>
                    @endif
                </div>
            </div>