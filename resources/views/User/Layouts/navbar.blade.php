<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        {{-- <a class="navbar-brand" href="">Hasantet<span>Bos</span></a> --}}
        <a href="/">
            <div class="logo">
                <img src="/images/CafeMyU.png" alt="CafeMyU" />
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Profile</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cafe.*') ? 'active' : '' }}" href="{{ route('cafe.index') }}">Cafes</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cafe.*') ? 'active' : '' }}" href="cafe/rolet-specta">Cafes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/price">Price</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                {{-- <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary" href="/login">Login</a>
                    </li> --}}
            </ul>
        </div>
    </div>
</nav>
