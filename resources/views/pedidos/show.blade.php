<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Detalhes do Pedido #{{ $pedido->id }}</h1>
    <p><strong>Cliente:</strong> {{ $pedido->cliente->nome ?? 'N/A' }}</p>
    <p><strong>Valor Total:</strong> R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</p>

    <h3>Itens do Pedido</h3>
    <a href="{{ route('itempedido.create', $pedido->id) }}" class="btn btn-primary mb-3">Adicionar Item</a>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->itensPedido as $item)
                <tr>
                    <td>{{ $item->produto->nome ?? 'N/A' }}</td>
                    <td>{{ $item->quantidade }}</td>
                    <td>R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('itempedido.edit', $item->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('itempedido.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('pedido.index') }}" class="btn btn-secondary mt-3">Voltar aos Pedidos</a>
</div>
</body>
</html>
