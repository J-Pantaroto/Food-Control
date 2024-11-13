<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Item ao Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Adicionar Item ao Pedido #{{ $pedido->id }}</h1>
    <form action="{{ route('itempedido.store', $pedido->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select class="form-control" id="produto_id" name="produto_id" required>
                <option value="">Selecione um Produto</option>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" required min="1">
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
        </div>
        <button type="submit" class="btn btn-success">Adicionar Item</button>
        <a href="{{ route('pedido.show', $pedido->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
