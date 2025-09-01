@extends('Auth.layouts')

@section('title', 'Sign In')

@section('content')
    <div class="container-fluid px-3 px-md-4">
        <div class="row">
            {{-- Gambar samping (hanya tampil di layar besar) --}}
            <div class="col-lg-6 d-none d-lg-block p-0">
                <div class="vh-100 position-relative overflow-hidden">
                    <img src="{{ asset('images/sign-cafe.png') }}" class="w-100 h-100 d-block"
                        style="object-fit: cover; object-position: center;" alt="Café illustration">
                </div>
            </div>


            <div class="col-lg-6 d-flex align-items-center justify-content-center vh-100 overflow-auto py-5">
                <div class="mx-auto" style="max-width: 520px;">
                    <div class="mb-5">
                        <span class="fw-bold display-5 text-white">CaféMyU</span>
                    </div>


                    <div class="mb-4">
                        <h1 class="h3 fw-semibold mb-2">Welcome Back</h1>
                        <p class="text-secondary mb-0">
                            Manage your café and restaurant with ease<br>
                            and provide the best service for customers
                        </p>
                    </div>

                    {{-- Global validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger small">
                            <div class="fw-semibold mb-1">There
                                {{ $errors->count() > 1 ? 'were some problems' : 'was a problem' }} with your input:</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Status message (opsional) --}}
                    @if (session('status'))
                        <div class="alert alert-info small">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login-proses') }}" novalidate class="p-3 p-md-4">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password + toggle --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Your password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword"
                                    aria-label="Show password">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Remember me --}}
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-secondary" for="remember">
                                Remember me
                            </label>
                        </div>

                        {{-- Actions --}}
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-small-primary rounded-3 py-2 fw-semibold">
                                Manage Now
                            </button>

                            {{-- Link ke register --}}
                            <a href="" class="btn btn-outline-light rounded-3 py-2 fw-semibold">
                                Create New Account
                            </a>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (function() {
            const input = document.getElementById('password');
            const btn = document.getElementById('togglePassword');
            const icon = document.getElementById('toggleIcon');

            if (btn && input && icon) {
                btn.addEventListener('click', function() {
                    const isText = input.getAttribute('type') === 'text';
                    input.setAttribute('type', isText ? 'password' : 'text');
                    icon.classList.toggle('bi-eye');
                    icon.classList.toggle('bi-eye-slash');
                    btn.setAttribute('aria-label', isText ? 'Show password' : 'Hide password');
                });
            }
        })();
    </script>
@endpush
