<?php

namespace App\Http\Controllers;

use App\Models\Minerals;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MineralsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $minerals = Minerals::with('categoria')->get();
        return view('minerals.index', compact('minerals'));
        
    }

    public function homeProductes(){
        $minerals = Minerals::with('categoria')->get();
        return view('home', compact('minerals'));
    }

    public function mesInfoProductes(Request $request)
    {
        $mineralId = $request->input('id');
        $mineral = Minerals::find($mineralId);

        if (!$mineral) {
            return view('productes', ['mineral' => null]);
        }

        return view('productes', ['mineral' => $mineral]);
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
    public function show(Minerals $minerals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Minerals $minerals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Minerals $minerals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Minerals $minerals)
    {
        //
    }
}
