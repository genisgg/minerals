<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComandaController extends Controller
{
    /**
     * Mostra els productes del carrito.
     */
    public function index()
    {
        // Obtenim el carrito de la sessió
        $carrito = session('carrito', []); 
        return view('carritu', compact('carrito'));
    }

    /**
     * Afegeix un producte al carrito.
     */
    public function afegirAlCarrito(Request $request)
    {
        // Validem les dades rebudes
        $request->validate([
            'id' => 'required|integer',
            'nom' => 'required|string',
            'preu' => 'required|numeric|min:0',
        ]);

        // Afegim el producte al carrito
        $producte = $request->only(['id', 'nom', 'preu']);
        $carrito = session('carrito', []);
        $carrito[] = $producte;
        session(['carrito' => $carrito]);

        return redirect()->route('carrito')->with('success', 'Producte afegit al carrito!');
    }

    /**
     * Desa la comanda (finalitza el carrito).
     */
    public function guardarComanda(Request $request)
    {
        // Obtenim el carrito de la sessió
        $carrito = session('carrito', []);

        // Comprovem si el carrito està buit
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'El carrito està buit.');
        }

        // Crear nova comanda
        $comanda = new Comanda();
        $comanda->usuari_id = Auth::id(); // Assignem l'usuari logejat
        $comanda->total = collect($carrito)->sum('preu'); // Sumem els preus dels productes
        $comanda->detalls = json_encode($carrito); // Guardem els productes com a JSON
        $comanda->save();

        // Buida el carrito després de desar la comanda
        session()->forget('carrito');

        return redirect()->route('carrito')->with('success', 'Comanda guardada correctament!');
    }
}
