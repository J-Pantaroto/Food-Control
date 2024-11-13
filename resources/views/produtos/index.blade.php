@extends('layouts.app')

@section('title', 'Lista de Produtos')

@section('content')
<div class="container mt-5">
    <h1>Produtos</h1>

    <!-- Botão para adicionar novo produto -->
    <a href="{{ route('produto.create') }}" class="btn btn-primary mb-3">+ Adicionar Produto</a>

    <!-- Tabela de Produtos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>SubCategoria</th>
                <th>Desconto</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->categoria->nome ?? 'N/A' }}</td>
                <td>{{ $produto->subCategoria->nome ?? 'N/A' }}</td>
                <td>{{ $produto->desconto ? 'Sim' : 'Não' }}</td>
                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('produto.show', $produto->id) }}" class="btn btn-info btn-sm">Visualizar</a>
                    <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
