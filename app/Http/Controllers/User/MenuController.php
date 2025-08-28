<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCafe;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function customize($id)
    {
        $menu = MenuCafe::with(['cafe', 'customizeMenus' => function($query) {
            $query->where('is_available', true);
        }])->findOrFail($id);

        return view('User/Pages/Cafes/Detail/customizeMenu', [
            'menu' => [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'image' => $menu->img_menu ?: '/images/default_food.jpg',
                'options' => $menu->customizeMenus->map(function($option) {
                    return [
                        'id' => $option->id,
                        'name' => $option->name,
                        'price' => (int)$option->price_sub,
                        'selected' => false,
                    ];
                }),
            ],
            'cafe_slug' => $menu->cafe->slug
        ]);
    }

    public function addToCart(Request $request) {
        $cart = session()->get('cart', []);
        
        // Logika add to cart
        $cart = $this->processCartItem($cart, $request->item);
        
        session()->put('cart', $cart);
        
        return back()->with('success', 'Item added to cart');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuCafe $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuCafe $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuCafe $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuCafe $menu)
    {
        //
    }
}
