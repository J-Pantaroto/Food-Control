@extends('layouts.clean')

@section('title', 'Food Control - Cardápio')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Cardápio</h1>

    @if($grupos && $grupos->isNotEmpty())
        <div class="botao-cardapio-rolagem mb-4" id="scroll">
            <ul class="nav nav-pills" role="tablist">
                @foreach($grupos as $grupo)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-{{ $grupo->id }}" data-bs-toggle="pill" data-bs-target="#grupo-{{ $grupo->id }}" type="button">
                            {{ $grupo->nome }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content">
            @foreach($grupos as $grupo)
                <div class="tab-pane fade" id="grupo-{{ $grupo->id }}" role="tabpanel">
                    <h2>{{ $grupo->nome }}</h2>
                    @if($grupo->subcategorias && $grupo->subcategorias->isNotEmpty())
                        @foreach($grupo->subcategorias as $subgrupo)
                            <h3 class="mt-4">{{ $subgrupo->nome }}</h3>
                            <div class="row gx-4 gy-4">
                                @foreach($subgrupo->produtos as $produto)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card shadow-sm">
                                            <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $produto->nome }}</h5>
                                                <p class="preco-prato-main-destaque">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p>Não há subcategorias disponíveis para este grupo.</p>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p>Nenhum grupo ou subgrupo disponível no momento.</p>
    @endif

    <div class="ofertas-header mt-5">
        <h2>Ofertas</h2>
    </div>
    <div class="row gx-4 gy-4">
        @if($produtosEmPromocao && $produtosEmPromocao->isNotEmpty())
            @foreach($produtosEmPromocao as $produto)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produto->nome }}</h5>
                            <p class="preco-prato-main-destaque">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-muted">Não há produtos em oferta no momento.</p>
        @endif
    </div>
</div>
@endsection
