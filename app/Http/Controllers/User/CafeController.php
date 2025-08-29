<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use Illuminate\Http\Request;

class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pastikan relasi 'alamat' dan 'images' sesuai dengan struktur data kamu
        $cafes = Cafe::with(['alamat','images'])->get();

        return view('User.Pages.Cafes.cafe', compact('cafes'));
    }

    public function detail(Cafe $cafe){
        $cafe->load([
            'alamat', 
            'images', 
            'menus' => function($query) {
                $query->where('isAvailable', true);
            }
        ]);
        // dd($cafe);

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cafe $cafe)
    {
        //
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
