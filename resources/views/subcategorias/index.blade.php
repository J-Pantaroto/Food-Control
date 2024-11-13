@extends('layouts.app')

@section('title', 'Lista de SubCategorias')

@section('content')
<div class="container mt-5">
    <h1>SubCategorias</h1>

    <!-- Botão para adicionar nova subcategoria -->
    <a href="{{ route('subcategoria.create') }}" class="btn btn-primary mb-3">+ Adicionar SubCategoria</a>

    <!-- Tabela de SubCategorias -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategorias as $subcategoria)
            <tr>
                <td>{{ $subcategoria->nome }}</td>
                <td>{{ $subcategoria->categoria->nome ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('subcategoria.show', $subcategoria->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                    <a href="{{ route('subcategoria.edit', $subcategoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('subcategoria.destroy', $subcategoria->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta subcategoria?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
