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

// Ruta per afegir minerals (formulari - només admins)
Route::get('/minerals/afegir', [MineralsController::class, 'create'])
    ->middleware(['auth', 'can:administrar'])
    ->name('minerals.create');

// Ruta per guardar el mineral a la base de dades
Route::post('/minerals', [MineralsController::class, 'store'])
    ->middleware(['auth', 'can:administrar'])
    ->name('minerals.store');

// Ruta per editar minerals (formulari - només admins)
Route::get('/minerals/{id}/editar', [MineralsController::class, 'edit'])
    ->middleware(['auth', 'can:administrar'])
    ->name('minerals.edit');

// Ruta per actualitzar minerals a la base de dades
Route::patch('/minerals/{id}', [MineralsController::class, 'update'])
    ->middleware(['auth', 'can:administrar'])
    ->name('minerals.update');

// Ruta per eliminar minerals (només admins)
Route::delete('/minerals/{id}', [MineralsController::class, 'destroy'])
    ->middleware(['auth', 'can:administrar'])
    ->name('minerals.destroy');

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
