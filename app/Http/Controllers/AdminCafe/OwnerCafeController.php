<?php

namespace App\Http\Controllers\AdminCafe;

use App\Http\Controllers\Controller;
use App\Models\OwnerCafe;
use Illuminate\Http\Request;

class OwnerCafeController extends Controller
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
    public function show(OwnerCafe $ownerCafe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OwnerCafe $ownerCafe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OwnerCafe $ownerCafe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OwnerCafe $ownerCafe)
    {
        //
    }
}
