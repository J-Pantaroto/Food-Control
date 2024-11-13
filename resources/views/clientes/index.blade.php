@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
<div class="container mt-5">
    <h1>Lista de Clientes</h1>
    <a href="{{ route('cliente.create') }}" class="btn btn-primary mb-3">Novo Cliente</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nome }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>
                        <a href="{{ route('cliente.show', $cliente->id) }}" class="btn btn-info">Detalhes</a>
                        <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
