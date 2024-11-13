@extends('layouts.app')

@section('title', 'Lista de Categorias')

@section('content')
<div class="container mt-5">
    <h1>Categorias</h1>
    
    <!-- Botão para adicionar nova categoria -->
    <a href="{{ route('categoria.create') }}" class="btn btn-primary mb-3">+ Adicionar Categoria</a>
    
    <!-- Tabela de Categorias -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nome }}</td>
                <td>
                    <!-- Botão de Visualizar -->
                    <a href="{{ route('categoria.show', $categoria->id) }}" class="btn btn-info btn-sm">Visualizar</a>

                    <!-- Botão de Editar -->
                    <a href="{{ route('categoria.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <!-- Formulário de Exclusão -->
                    <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
