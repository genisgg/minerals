<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComandaController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MineralsController;

// Ruta principal - Home
Route::get('/', function () {
    $minerals = \App\Models\Minerals::with('categoria')->get();
    $categories = \App\Models\Categoria::all();
    return view('home', compact('minerals', 'categories'));
})->name('home');

// Ruta per mostrar els productes
Route::get('/productes', function () {
    $data = [
        'foto' => request('foto'),
        'nom' => request('nom'),
        'preu' => request('preu'),
        'descripcio' => request('descripcio'),
    ];
    return view('productes', ['mineral' => $data]);
})->name('productes');

// Rutes del carrito utilitzant el ComandaController
Route::get('/carrito', [ComandaController::class, 'index'])->name('carrito');
Route::post('/carrito/afegir', [ComandaController::class, 'afegirAlCarrito'])->name('carrito.afegir');
Route::post('/carrito/guardar', [ComandaController::class, 'guardarComanda'])->name('carrito.guardar');

// Ruta per al dashboard (requereix autenticació)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutes protegides per autenticació
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Incloem les rutes d'autenticació
require __DIR__.'/auth.php';
