<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Pedido #{{ $pedido->id }}</h1>
    <form action="{{ route('pedido.update', $pedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select class="form-control" id="cliente_id" name="cliente_id" required>
                <option value="">Selecione um Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $pedido->cliente_id == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <h3>Itens do Pedido</h3>
        <div id="itens-pedido">
            @foreach($pedido->itensPedido as $index => $item)
                <div class="item-pedido mb-3 row">
                    <div class="col-md-5">
                        <label for="produto_id" class="form-label">Produto</label>
                        <select class="form-control" name="itens[{{ $index }}][produto_id]" required>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" {{ $item->produto_id == $produto->id ? 'selected' : '' }}>
                                    {{ $produto->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" name="itens[{{ $index }}][quantidade]" required min="1" value="{{ $item->quantidade }}">
                    </div>
                    <div class="col-md-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" name="itens[{{ $index }}][preco]" required value="{{ $item->preco }}">
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="{{ route('pedido.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
