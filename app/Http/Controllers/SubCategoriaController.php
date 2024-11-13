<?php

namespace App\Http\Controllers;

use App\Models\SubCategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SubCategoriaController extends Controller
{
    public function index()
    {
        $subcategorias = SubCategoria::with('categoria')->get();
        return view('subcategorias.index', compact('subcategorias'));
    }

    public function create()
    {
        $categorias = Categoria::all(); // Para popular o dropdown de categorias
        return view('subcategorias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|string|max:255',
        ]);

        SubCategoria::create($request->all());
        return redirect()->route('subcategoria.index')->with('success', 'SubCategoria criada com sucesso!');
    }

    public function show($id)
    {
        $subcategoria = SubCategoria::with('categoria')->findOrFail($id);
        return view('subcategorias.show', compact('subcategoria'));
    }

    public function edit($id)
    {
        $subcategoria = SubCategoria::findOrFail($id);
        $categorias = Categoria::all(); // Para popular o dropdown de categorias
        return view('subcategorias.edit', compact('subcategoria', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|string|max:255',
        ]);

        $subcategoria = SubCategoria::findOrFail($id);
        $subcategoria->update($request->all());
        return redirect()->route('subcategoria.index')->with('success', 'SubCategoria atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $subcategoria = SubCategoria::findOrFail($id);
        $subcategoria->delete();
        return redirect()->route('subcategoria.index')->with('success', 'SubCategoria excluída com sucesso!');
    }
}
