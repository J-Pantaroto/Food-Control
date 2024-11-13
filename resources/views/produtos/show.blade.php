<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Detalhes do Produto</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nome:</h5>
            <p class="card-text">{{ $produto->nome }}</p>

            <h5 class="card-title">Descrição:</h5>
            <p class="card-text">{{ $produto->descricao }}</p>


            <h5 class="card-title">Preço:</h5>
            <p class="card-text">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>

            <h5 class="card-title">Categoria:</h5>
            <p class="card-text">{{ $produto->categoria->nome ?? 'N/A' }}</p>

            <h5 class="card-title">SubCategoria:</h5>
            <p class="card-text">{{ $produto->subCategoria->nome ?? 'N/A' }}</p>

            <h5 class="card-title">Desconto:</h5>
            <p class="card-text">{{ $produto->desconto ? 'Sim' : 'Não' }}</p>

            @if($produto->foto)
                <h5 class="card-title">Foto:</h5>
                <img src="{{ asset('storage/' . $produto->foto) }}" alt="Foto do Produto" class="img-fluid">
            @endif
        </div>
    </div>

    <a href="{{ route('produto.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
