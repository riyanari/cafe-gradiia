<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pastikan relasi 'alamat' dan 'images' sesuai dengan struktur data kamu
        $cafes = Cafe::with(['alamat', 'images'])->get();

        return view('User.Pages.Cafes.cafe', compact('cafes'));
    }

    public function detail(Cafe $cafe)
    {
        $cafe->load([
            'alamat',
            'images',
            'menus' => function ($query) {
                $query->where('isAvailable', true);
            },
        ]);

        return view('User.Pages.Cafes.Detail.detailCafe', compact('cafe'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = json_decode($request->cart, true);

        if (!$cart || !is_array($cart)) {
            return back()->withErrors('Keranjang kosong atau tidak valid.');
        }

        // Hitung total
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Simpan order
        $order = Order::create([
            'order_code' => strtoupper(Str::random(8)), // kode unik 8 huruf
            'nama' => $request->nama,
            'meja' => $request->meja,
            'catatan' => $request->catatan,
            'total_price' => $total,
        ]);

        // Simpan detail item
        foreach ($cart as $item) {
            $order->items()->create([
                'menu_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'note' => $item['note'] ?? null,
                'image' => $item['image'] ?? null,
            ]);
        }
        return redirect()->route('cafe.orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cafe $cafe)
    {
        //
    }

    public function showOrder(Order $order)
    {
        return view('User.Pages.Cafes.Detail.order', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cafe $cafe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cafe $cafe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cafe $cafe)
    {
        //
    }
}
