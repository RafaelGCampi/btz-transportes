<form name="motorista_form" onsubmit="store_motorista(this)" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input hidden class="form-control" name="id" id="id">
    </div>

    <div class="row">
        <div class="form-group col-12">
            <label class="col-form-label" for="nome">Nome:</label>
            <input class="form-control" name="nome" id="nome" type="text" required placeholder="Digite o nome">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="data_nascimento">Data de nascimento:</label>
            <input class="form-control" name="data_nascimento" id="data_nascimento" type="date" required>
        </div>
        <div class="form-group col-6">
            <label class="col-form-label" for="cpf">Cpf:</label>
            <input class="form-control" name="cpf" id="cpf" type="text" required placeholder="Digite o cpf" onkeypress="formatar('###.###.###-##', this)" max-length="14"  >
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="numero_cnh">Número da CNH:</label>
            <input class="form-control" name="numero_cnh" id="numero_cnh" type="text" maxlength="11" required placeholder="Digite a CNH">
        </div>

        <div class="form-group col-6">
            <label class="col-form-label" for="categoria_cnh">Categoria da CNH:</label>
            <input class="form-control" name="categoria_cnh" id="categoria_cnh" type="text" required
                placeholder="Digite a categoria de sua CNH">
        </div>
    </div>

    <div class="alert-danger" id="erro"></div>
    <button type="submit" style="float:right" class="btn btn-primary">Salvar</button>
</form>
