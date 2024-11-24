@extends('layouts.clean')

@section('title', 'Food Control - Cardápio')

@section('content')
<div class="d-flex">
    <!-- Menu Lateral -->
    <nav class="menu-lateral bg-dark text-white p-3" style="min-width: 200px; height: 100vh; position: sticky; top: 0;">
        <ul class="nav flex-column">
            @foreach($grupos as $grupo)
                <li class="nav-item mb-2">
                    <a class="nav-link text-white btn btn-dark text-start" href="#grupo-{{ $grupo->id }}">{{ $grupo->nome }}</a>
                </li>
            @endforeach
        </ul>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="flex-grow-1 p-4">
        <h1 class="text-center mb-4">Cardápio</h1>

        @if($grupos && $grupos->isNotEmpty())
            @foreach($grupos as $grupo)
                <section id="grupo-{{ $grupo->id }}" class="mb-5">
                    <h2 class="mb-3" style="border-bottom: 2px solid #3b82f6">{{ $grupo->nome }}</h2>
                    @if($grupo->subcategorias && $grupo->subcategorias->isNotEmpty())
                        @foreach($grupo->subcategorias as $subgrupo)
                            <h3 class="mt-4">{{ $subgrupo->nome }}</h3>
                            <div class="row g-4">
                                @foreach($subgrupo->produtos as $produto)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card shadow-sm h-100">
                                            <img src="{{ asset('storage/' . $produto->foto) }}" class="card-img-top" alt="{{ $produto->nome }}">
                                            <div class="card-body d-flex flex-column">
                                                <h5 class="card-title">{{ $produto->nome }}</h5>
                                                <p class="text-danger fs-5 fw-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Não há subcategorias disponíveis para este grupo.</p>
                    @endif
                </section>
            @endforeach
        @else
            <p class="text-center text-muted">Nenhum grupo ou subgrupo disponível no momento.</p>
        @endif
    </div>
</div>
@endsection