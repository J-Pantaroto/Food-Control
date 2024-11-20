<div class="col-md-4">
    <div class="card shadow-sm">
        <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{ $produto->nome }}</h5>
            <p class="preco-prato-main-destaque">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
        </div>
    </div>
</div>
