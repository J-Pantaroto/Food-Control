<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Cadastrar Novo Pedido</h1>
    <form action="{{ route('pedido.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select class="form-control" id="cliente_id" name="cliente_id" required>
                <option value="">Selecione um Cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>

        <h3>Itens do Pedido</h3>
        <div id="itens-pedido">
            <div class="item-pedido mb-3 row">
                <div class="col-md-5">
                    <label for="produto_id" class="form-label">Produto</label>
                    <select class="form-control" name="itens[0][produto_id]" required>
                        <option value="">Selecione um Produto</option>
                        @foreach($produtos as $produto)
                            <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="itens[0][quantidade]" required min="1">
                </div>
                <div class="col-md-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" name="itens[0][preco]" required>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger mt-4" onclick="removeItem(this)">X</button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary mb-3" onclick="addItem()">Adicionar Item</button>

        <button type="submit" class="btn btn-success">Salvar Pedido</button>
        <a href="{{ route('pedido.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    let itemIndex = 1;

    function addItem() {
        const itemHtml = `
            <div class="item-pedido mb-3 row">
                <div class="col-md-5">
                    <label for="produto_id" class="form-label">Produto</label>
                    <select class="form-control" name="itens[${itemIndex}][produto_id]" required>
                        <option value="">Selecione um Produto</option>
                        @foreach($produtos as $produto)
                            <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" name="itens[${itemIndex}][quantidade]" required min="1">
                </div>
                <div class="col-md-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="number" step="0.01" class="form-control" name="itens[${itemIndex}][preco]" required>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger mt-4" onclick="removeItem(this)">X</button>
                </div>
            </div>
        `;
        document.getElementById('itens-pedido').insertAdjacentHTML('beforeend', itemHtml);
        itemIndex++;
    }

    function removeItem(button) {
        button.closest('.item-pedido').remove();
    }
</script>
</body>
</html>
