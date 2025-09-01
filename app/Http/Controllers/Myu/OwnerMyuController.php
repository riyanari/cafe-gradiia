<?php

namespace App\Http\Controllers\Myu;

use App\Http\Controllers\Controller;
use App\Models\OwnerMyu;
use Illuminate\Http\Request;

class OwnerMyuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.Pages.CafeMyU.dashboard');
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
    public function show(OwnerMyu $ownerMyu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OwnerMyu $ownerMyu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OwnerMyu $ownerMyu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OwnerMyu $ownerMyu)
    {
        //
    }
}
