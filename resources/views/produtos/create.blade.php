@extends('layouts.cadastros')

@section('modals')
<div class="container">
    <h1>Cadastrar Produto</h1>

    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao"></textarea>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" min="0" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="valor" name="valor" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria</label>
            <select class="form-select" id="categoria" name="categoria_id">
                <option value="">Selecione uma Categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sub_categoria" class="form-label">Subcategoria</label>
            <select class="form-select" id="sub_categoria" name="sub_categoria_id" required>
                <option value="">Selecione uma Subcategoria</option>
                <!-- As subcategorias serão carregadas via JavaScript -->
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto do Produto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
    </form>
</div>
<!-- Adicionei um js básico transformar isso dps em uma function separada para ser reutilziada caso necessario -->
<script>
    document.getElementById('categoria').addEventListener('change', function() {
        var categoriaId = this.value;
        var subCategoriaSelect = document.getElementById('sub_categoria');
        
        // Limpar opções anteriores
        subCategoriaSelect.innerHTML = '<option value="">Selecione uma Subcategoria</option>';

        if (categoriaId) {
            fetch(`/api/subcategorias/${categoriaId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subCategoria => {
                        var option = document.createElement('option');
                        option.value = subCategoria.id;
                        option.textContent = subCategoria.nome;
                        subCategoriaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro:', error));
        }
    });
</script>
@endsection
