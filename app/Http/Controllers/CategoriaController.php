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
            'id' => 'required|integer|unique:categoria,id',
            'nom_categoria' => 'required|string|max:255',
            'nom_categoria_en' => 'nullable|string|max:255',
            'nom_categoria_es' => 'nullable|string|max:255',
            'nom_categoria_fr' => 'nullable|string|max:255',
        ]);
    
        Categoria::create($request->all());
    
        return redirect()->route('home')->with('success', __('Categoria afegida correctament!'));
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        // Comprovar si hi ha minerals associats
        if ($categoria->minerals()->count() > 0) {
            return redirect()->back()->with('error', __('No es pot eliminar la categoria perquè té minerals associats.'));
        }

        // Eliminar la categoria
        $categoria->delete();

        return redirect()->route('home')->with('success', __('Categoria eliminada correctament.'));
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
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('editarcategoria', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|integer|unique:categoria,id,' . $id, // Permet canviar l'ID però assegura que sigui únic
            'nom_categoria' => 'required|string|max:255',
        ]);

        $categoria = Categoria::findOrFail($id);

        // Actualitzar l'ID de la categoria si és diferent
        if ($categoria->id != $request->id) {
            $categoria->id = $request->id;
        }

        $categoria->nom_categoria = $request->nom_categoria;
        $categoria->save();

        return redirect()->route('home')->with('success', __('Categoria actualitzada correctament!'));
    }


   
  
}
