<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\SubCategoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function index()
    {
        // Recupera todos os produtos
        $produtos = Produto::all();

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all(); // Recupera todas as categorias
        $subcategorias = SubCategoria::all(); // Recupera todas as subcategorias
        return view('produtos.create', compact('categorias', 'subcategorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'quantidade' => 'required|integer|min:0',
            'valor' => 'required|numeric|min:0',
            'sub_categoria_id' => 'required|exists:subcategorias,id',
            'foto' => 'nullable|imagem|mimes:jpeg,png,jpg|max:2048',
        ]);

        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->quantidade = $request->quantidade;
        $produto->valor = $request->valor;
        $produto->sub_categoria_id = $request->sub_categoria_id;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('produtos', 'public');
            $produto->foto = $path;
        }
        $produto->save();
        return redirect()->route('home')->with('success', 'Produto cadastrado com sucesso!');

    }
}
