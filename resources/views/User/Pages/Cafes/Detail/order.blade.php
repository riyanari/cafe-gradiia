@extends('User.Pages.Cafes.Detail.layouts')

@section('title', 'Pesanan Berhasil')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container my-4 pb-5" style="max-width:480px">
        <div class="text-center mb-4">
            <div class="mb-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size:3rem"></i>
            </div>
            <h1 class="h5 fw-bold">Pesanan Berhasil!</h1>
            <p class="text-muted">Silakan tunjukkan kode pesanan ini ke kasir.</p>
        </div>

        {{-- Kode Pesanan --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body text-center">
                <div class="fw-semibold text-muted mb-2">Kode Pesanan</div>
                <h2 class="fw-bold">{{ $order->order_code }}</h2>
                <div class="mt-3">
                    {!! QrCode::size(150)->generate($order->order_code) !!}
                </div>
            </div>
        </div>

        {{-- Detail Order --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Detail Pesanan</h5>
                <p class="mb-1"><strong>Nama:</strong> {{ $order->nama }}</p>
                <p class="mb-1"><strong>Meja:</strong> {{ $order->meja }}</p>
                <p class="mb-3"><strong>Catatan:</strong> {{ $order->catatan ?? '-' }}</p>

                <ul class="list-group list-group-flush">
                    @foreach ($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <div class="fw-semibold">{{ $item->name }}</div>
                                <div class="small text-muted">{{ $item->quantity }} × Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                            </div>
                            <div class="fw-bold">
                                Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="fw-semibold">Total</span>
                    <span class="fw-bold text-brown">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Aksi --}}
        <div class="text-center mt-4">
            <a href="{{ route('cafe.index') }}" class="btn btn-brown rounded-pill fw-semibold">Kembali ke Menu</a>
        </div>
    </div>
@endsection
