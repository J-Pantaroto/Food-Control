<div class="modal fade" id="subcategoriaModal" tabindex="-1" aria-labelledby="subcategoriaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategoriaModalLabel">Cadastrar Subcategoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sub-categorias.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome da Subcategoria</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                        @error('nome')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoria_id">Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="form-control" required>
                            <option value="">Selecione uma Categoria</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar Subcategoria</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


