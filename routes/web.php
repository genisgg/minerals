<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ComandaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MineralsController;
use Illuminate\Support\Facades\Route;

// Ruta principal - Home
Route::get('/', function () {
    $minerals = \App\Models\Minerals::with('categoria')->get();
    $categories = \App\Models\Categoria::all();
    return view('home', compact('minerals', 'categories'));
})->name('home');

// Mostrar més info dels productes
Route::get('/productes', [MineralsController::class, 'mesInfoProductes'])->name('productes');

// Rutes del carrito utilitzant el ComandaController
Route::get('/carrito', [ComandaController::class, 'index'])->middleware('auth')->name('carrito');
Route::post('/carrito/afegir', [ComandaController::class, 'afegirAlCarrito'])->middleware('auth')->name('carrito.afegir');
Route::post('/carrito/afegir-id', [ComandaController::class, 'afegirAlCarritoPerId'])->middleware('auth')->name('carrito.afegir-id');
Route::post('/carrito/guardar', [ComandaController::class, 'guardarComanda'])->middleware('auth')->name('carrito.guardar');

Route::post('/carrito/actualitzar', [ComandaController::class, 'actualitzarCarrito'])->middleware('auth')->name('carrito.actualitzar');
Route::post('/carrito/borrar', [ComandaController::class, 'borrarDelCarrito'])->middleware('auth')->name('carrito.borrar');

//he de fer una ruta per l'admin poder afegir minerals amb un formulari i em demani nom, preu, descrip i foto. 
//haure de fer també un array de middleware('auth') perque haura d'estar auth i també ser l'admin per poder accedir al formulari
//per afegir el mineral

// Ruta pel dashboard (requereix autenticació)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutes protegides per autenticació
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
