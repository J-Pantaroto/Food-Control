<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Editar Produto</h1>
    <form action="{{ route('produto.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao">{{ $produto->descricao }}</textarea>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="{{ $produto->preco }}" required>
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select class="form-control" id="categoria_id" name="categoria_id" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $categoria->id == $produto->categoria_id ? 'selected' : '' }}>
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="sub_categoria_id" class="form-label">SubCategoria</label>
            <select class="form-control" id="sub_categoria_id" name="sub_categoria_id" required>
                @foreach($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria->id }}" {{ $subcategoria->id == $produto->sub_categoria_id ? 'selected' : '' }}>
                        {{ $subcategoria->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="desconto" class="form-label">Desconto</label>
            <select class="form-control" id="desconto" name="desconto" required>
                <option value="0" {{ !$produto->desconto ? 'selected' : '' }}>Não</option>
                <option value="1" {{ $produto->desconto ? 'selected' : '' }}>Sim</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto do Produto (opcional)</label>
            <input type="file" class="form-control" id="foto" name="foto">
            @if($produto->foto)
                <img src="{{ asset('storage/' . $produto->foto) }}" alt="Foto Atual do Produto" class="img-fluid mt-2" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Atualizar Produto</button>
        <a href="{{ route('produto.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
