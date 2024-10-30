<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;
use Illuminate\Support\Facades\Route;
use App\Models\SubCategoria;
use App\Models\Categoria;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //CadProduto
    Route::get('/api/subcategorias/{categoria_id}', function ($categoria_id) { // Rota para buscar subcategorias
        return SubCategoria::where('categoria_id', $categoria_id)->get();
    });

    Route::resource('produtos', ProdutoController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('sub-categorias', SubCategoriaController::class);
    Route::get('/home', [SubCategoriaController::class, 'index'])->name('home');

});


require __DIR__ . '/auth.php';
