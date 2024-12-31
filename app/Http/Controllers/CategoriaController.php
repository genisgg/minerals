<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Minerals;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function homeProductesCateg()
    {
        $categories = Categoria::all();;
        return view('home', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('afegircategoria');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_categoria' => 'required|string|max:255',
            'nom_categoria_en' => 'nullable|string|max:255',
            'nom_categoria_es' => 'nullable|string|max:255',
            'nom_categoria_fr' => 'nullable|string|max:255',
        ]);

        Categoria::create($request->all());

        return redirect()->route('home')->with('success', __('Categoria afegida correctament!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
