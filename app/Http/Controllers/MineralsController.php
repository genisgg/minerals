<?php

namespace App\Http\Controllers;

use App\Models\Minerals;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MineralsController extends Controller
{
    public function index()
    {
        $minerals = Minerals::with('categoria')->get();
        return view('minerals.index', compact('minerals'));
    }

    public function homeProductes()
    {
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

    public function create()
    {
        $categories = Categoria::all();
        return view('afegirmineral', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'preu' => 'required|numeric|min:0',
            'descripcio' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categoria,id',
        ]);

        // Guardar la imatge al directori public/img
        $fileName = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('img'), $fileName);

        // Crear un nou registre de mineral
        Minerals::create([
            'nom' => $request->input('nom'),
            'preu' => $request->input('preu'),
            'descripcio' => $request->input('descripcio'),
            'foto' => 'img/' . $fileName, // Guardem el camí complet
            'categoria_id' => $request->input('categoria_id'),
        ]);

        return redirect()->route('home')->with('success', __('Mineral afegit correctament!'));
    }

    public function destroy($id)
    {
        $mineral = Minerals::findOrFail($id);

        // Esborrar la imatge del sistema d'arxius si existeix
        if ($mineral->foto && file_exists(public_path($mineral->foto))) {
            unlink(public_path($mineral->foto));
        }

        // Eliminar el mineral
        $mineral->delete();

        return redirect()->route('home')->with('success', __('Mineral eliminat correctament!'));
    }

    public function edit($id)
    {
        $mineral = Minerals::findOrFail($id);
        $categories = Categoria::all();
        return view('editarmineral', compact('mineral', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'preu' => 'required|numeric|min:0',
            'descripcio' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categoria,id',
        ]);

        $mineral = Minerals::findOrFail($id);

        // Actualitzar camps
        $mineral->nom = $request->input('nom');
        $mineral->preu = $request->input('preu');
        $mineral->descripcio = $request->input('descripcio');
        $mineral->categoria_id = $request->input('categoria_id');

        // Si hi ha una nova foto, substituir l'anterior
        if ($request->hasFile('foto')) {
            // Esborrar la imatge anterior
            if ($mineral->foto && file_exists(public_path($mineral->foto))) {
                unlink(public_path($mineral->foto));
            }

            // Guardar la nova imatge
            $fileName = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('img'), $fileName);
            $mineral->foto = 'img/' . $fileName;
        }

        $mineral->save();

        return redirect()->route('home')->with('success', __('Mineral actualitzat correctament!'));
    }
}
