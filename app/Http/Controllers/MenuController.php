<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\SubCategoria;
use App\Models\Produto;

class MenuController extends Controller
{
    public function index()
    {
        // Carregar as categorias e subcategorias com produtos, garantindo que a coluna correta seja usada
        $grupos = Categoria::with(['subcategorias.produtos'])->get();

        // Carregar produtos em promoção
        $produtosEmPromocao = Produto::where('desconto', true)->get();

        return view('welcome', compact('grupos', 'produtosEmPromocao'));
    }
}
