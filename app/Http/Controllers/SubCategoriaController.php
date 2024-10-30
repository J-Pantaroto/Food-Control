<?php

namespace App\Http\Controllers;

use App\Models\SubCategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    public function index()
    {
        $subCategorias = SubCategoria::all();
        $categorias = Categoria::all();
        return view('home', compact('subCategorias', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all(); // Recupera todas as categorias
        //$subCategorias = SubCategoria::all(); // Recupera todas as Subcategorias
        return view('sub-categorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:30',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $subCategoria = new SubCategoria();
        $subCategoria->nome = $request->nome;
        $subCategoria->categoria_id = $request->categoria_id;
        $subCategoria->save();
        return redirect()->route('home')->with('success', 'SubCategoria cadastrada com sucesso!');
    }
}
