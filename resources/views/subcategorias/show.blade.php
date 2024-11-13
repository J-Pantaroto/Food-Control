<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da SubCategoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Detalhes da SubCategoria</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nome da SubCategoria:</h5>
            <p class="card-text">{{ $subcategoria->nome }}</p>
            <h5 class="card-title">Categoria:</h5>
            <p class="card-text">{{ $subcategoria->categoria->nome }}</p>
        </div>
    </div>

    <a href="{{ route('subcategoria.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
