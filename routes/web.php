<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MineralsController;

//Route::get('/', function () {
//    return view('home');
//})->name('home');



Route::get('/', function () {
    $minerals = \App\Models\Minerals::with('categoria')->get();
    $categories = \App\Models\Categoria::all();
    return view('home', compact('minerals', 'categories'));
})->name('home');


Route::get('/productes', function () {
    $data = [
        'foto' => request('foto'),
        'nom' => request('nom'),
        'preu' => request('preu'),
        'descripcio' => request('descripcio'),
    ];
    return view('productes', ['mineral' => $data]);
})->name('productes');


//Route::get('/', [MineralsController::class, 'homeProductes'])
//    ->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
