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
        // Calculem el total sumant preu * quantitat
        $total = collect($carrito)->sum(function ($producte) {
            return ($producte['preu'] * ($producte['quantitat'] ?? 1));
        });

        return view('carrito', compact('carrito', 'total'));
    }

    /**
     * Afegeix un producte al carrito utilitzant només l'ID.
     */
    public function afegirAlCarritoPerId(Request $request)
    {
        // Validem que l'ID s'ha passat i existeix a la base de dades
        $request->validate([
            'id' => 'required|integer|exists:minerals,id',
        ]);

        // Busquem el mineral a la base de dades
        $mineral = \App\Models\Minerals::find($request->id);

        if (!$mineral) {
            return redirect()->back()->with('error', 'El mineral no existeix.');
        }

        // Preparem les dades per afegir al carrito
        $producte = [
            'id' => $mineral->id,
            'nom' => $mineral->nom,
            'preu' => $mineral->preu,
            'foto' => $mineral->foto ?? 'img/placeholder.jpg',
            'quantitat' => 1, // Per defecte la quantitat és 1
        ];

        // Afegim el producte al carrito
        $carrito = session('carrito', []);

        // Verifiquem si el producte ja existeix per augmentar-ne la quantitat
        $producteTrobat = false;
        foreach ($carrito as &$item) {
            if ($item['id'] == $producte['id']) {
                $item['quantitat'] += 1;
                $producteTrobat = true;
                break;
            }
        }

        // Si no existeix, l'afegim
        if (!$producteTrobat) {
            $carrito[] = $producte;
        }

        session(['carrito' => $carrito]);

        return redirect()->route('carrito')->with('success', 'Producte afegit al carrito!');
    }

    /**
     * Actualitza la quantitat d'un producte al carrito.
     */
    public function actualitzarCarrito(Request $request)
    {
        $request->validate([
            'index' => 'required|integer',
            'quantitat' => 'required|integer|min:1',
        ]);

        $carrito = session('carrito', []);
        $index = $request->input('index');
        $quantitat = $request->input('quantitat');

        if (isset($carrito[$index])) {
            $carrito[$index]['quantitat'] = $quantitat;
            session(['carrito' => $carrito]);
        }

        return redirect()->route('carrito')->with('success', 'Quantitat actualitzada!');
    }

    /**
     * Esborra un producte del carrito.
     */
    public function borrarDelCarrito(Request $request)
    {
        $request->validate([
            'index' => 'required|integer',
        ]);

        $carrito = session('carrito', []);
        $index = $request->input('index');

        if (isset($carrito[$index])) {
            unset($carrito[$index]);
            session(['carrito' => array_values($carrito)]); // Reorganitza l'índex
        }

        return redirect()->route('carrito')->with('success', 'Producte esborrat del carrito!');
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
        $comanda->total = collect($carrito)->sum(function ($producte) {
            return $producte['preu'] * $producte['quantitat'];
        });
        $comanda->detalls = json_encode($carrito); // Guardem els productes com a JSON
        $comanda->save();

        // Buida el carrito després de desar la comanda
        session()->forget('carrito');

        return redirect()->route('carrito')->with('success', 'Comanda guardada correctament!');
    }
}
