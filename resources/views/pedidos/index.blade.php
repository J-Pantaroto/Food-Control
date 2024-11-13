@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="container mt-5">
    <h1>Pedidos</h1>
    <a href="{{ route('pedido.create') }}" class="btn btn-primary mb-3">Novo Pedido</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->nome ?? 'N/A' }}</td>
                    <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('pedido.show', $pedido->id) }}" class="btn btn-info btn-sm">Detalhes</a>
                        <a href="{{ route('pedido.edit', $pedido->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('pedido.destroy', $pedido->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este pedido?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
