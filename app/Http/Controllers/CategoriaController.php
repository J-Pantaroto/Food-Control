<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        // Recupera todos os produtos
        $categorias = Categoria::all();
        return view('home', compact('categorias'));
    }

    public function create()
    {
        $categorias = Categoria::all(); // Recupera todas as categorias
        return view('categorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:30',
        ]);

        $categoria = new Categoria();
        $categoria->nome = $request->nome;
        $categoria->save();
        return redirect()->route('home')->with('success', 'Categoria cadastrada com sucesso!');

    }
}
