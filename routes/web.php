<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MenuController;
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

Route::get('/', [MenuController::class, 'index'])->name('welcome');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('categoria', CategoriaController::class);
    Route::resource('subcategoria', SubCategoriaController::class);
    Route::resource('produto', ProdutoController::class);
    Route::resource('pedido', PedidoController::class);

    Route::get('pedido/{pedido}/item/create', [ItemPedidoController::class, 'create'])->name('itempedido.create');
    Route::post('pedido/{pedido}/item', [ItemPedidoController::class, 'store'])->name('itempedido.store');
    Route::get('item/{item}/edit', [ItemPedidoController::class, 'edit'])->name('itempedido.edit');
    Route::put('item/{item}', [ItemPedidoController::class, 'update'])->name('itempedido.update');
    Route::delete('item/{item}', [ItemPedidoController::class, 'destroy'])->name('itempedido.destroy');

    Route::resource('cliente', ClienteController::class);
    /*Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/categoria', [CategoriaController::class, 'create'])->name('categoria.create');
    Route::get('/categoria/{id}/editar', [CategoriaController::class, 'edit'])->name('categoria.edit');
    Route::put('/categoria/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');*/

    //CadProduto
    /*Route::get('/api/subcategorias/{categoria_id}', function ($categoria_id) { // Rota para buscar subcategorias
        return SubCategoria::where('categoria_id', $categoria_id)->get();
    });

    Route::resource('produtos', ProdutoController::class);
    //Route::resource('categorias', CategoriaController::class);
    Route::resource('sub-categorias', SubCategoriaController::class);
    Route::get('/home', [SubCategoriaController::class, 'index'])->name('home');*/

});

require __DIR__ . '/auth.php';
