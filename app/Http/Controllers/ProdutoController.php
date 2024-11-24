<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\SubCategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('subCategoria', 'categoria')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = SubCategoria::all();
        return view('produtos.create', compact('categorias', 'subcategorias'));
    }

    public function getPreco($id)
    {
        $produto = Produto::findOrFail($id);
        return response()->json(['preco' => $produto->preco]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric', // Certifique-se de que preco está validado como obrigatório e numérico
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'desconto' => 'required|boolean',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Lidar com o upload da foto, se estiver presente
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produtos', 'public');
        }

        Produto::create($data);

        return redirect()->route('produto.index')->with('success', 'Produto criado com sucesso!');
    }

    public function show($id)
    {
        $produto = Produto::with('subCategoria', 'categoria')->findOrFail($id);
        return view('produtos.show', compact('produto'));
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $subcategorias = SubCategoria::all();
        return view('produtos.edit', compact('produto', 'categorias', 'subcategorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'quantidade' => 'required|integer',
            'preco' => 'required|numeric', // Certifique-se de que preco está validado
            'categoria_id' => 'required|exists:categorias,id',
            'subcategoria_id' => 'required|exists:subcategorias,id',
            'desconto' => 'required|boolean',
            'foto' => 'nullable|image|max:2048',
        ]);

        $produto = Produto::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produtos', 'public');
        }

        $produto->update($data);

        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produto.index')->with('success', 'Produto excluído com sucesso!');
    }
}
