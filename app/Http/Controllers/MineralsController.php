<?php

namespace App\Http\Controllers;

use App\Models\Minerals;
use App\Models\Categoria;
use Illuminate\Http\Request;

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
        // Passar categories al formulari
        $categories = Categoria::all();
        return view('afegirmineral', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validar les dades del formulari
        $request->validate([
            'nom' => 'required|string|max:255',
            'preu' => 'required|numeric|min:0',
            'descripcio' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categoria,id',
        ]);

        // Guardar la imatge al sistema d'arxius
        $path = $request->file('foto')->store('public/img');
        $fotoPath = str_replace('public/', '', $path);

        // Crear un nou registre de mineral
        Minerals::create([
            'nom' => $request->input('nom'),
            'preu' => $request->input('preu'),
            'descripcio' => $request->input('descripcio'),
            'foto' => $fotoPath,
            'categoria_id' => $request->input('categoria_id'),
        ]);

        // Redirigir amb un missatge d'èxit
        return redirect()->route('home')->with('success', __('Mineral afegit correctament!'));
    }

    public function destroy($id)
    {
        $mineral = Minerals::findOrFail($id);

        // Eliminar el mineral
        $mineral->delete();

        return redirect()->route('home')->with('success', __('Mineral eliminat correctament!'));
    }
}
