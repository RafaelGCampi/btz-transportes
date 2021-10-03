<form name="motorista_form" onsubmit="store_veiculo(this)" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input hidden class="form-control" name="id" id="id">
    </div>

    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="nome">Nome:</label>
            <input class="form-control" name="nome" id="nome" type="text" required placeholder="Digite o nome">
        </div>
        <div class="form-group col-6">
            <label class="col-form-label" for="placa">Placa:</label>
            <input class="form-control" name="placa" id="placa" type="text" required placeholder="Digite o placa">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="tipo_combustivel_id">Tipo de combustível:</label>
            <select class="form-control form-control-sm" id="tipo_combustivel_id" name="tipo_combustivel_id">
                <option value="" disabled selected>(Selecione o tipo de combustível)</option>
                @include('componentes.selects.tipo-combustivel-select')
            </select>
        </div>
        <div class="form-group col-6">
            <label class="col-form-label" for="fabricante">Fabricante:</label>
            <input class="form-control" name="fabricante" id="fabricante" type="text" required placeholder="Digite o fabricante">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="ano_fabricacao">Ano da fabricação:</label>
            <input class="form-control" name="ano_fabricacao" id="ano_fabricacao" type="text" required placeholder="Digite o ano da fabricação">
        </div>

        <div class="form-group col-6">
            <label class="col-form-label" for="capacidade_tanque">Capacidade do tanque:</label>
            <input class="form-control" name="capacidade_tanque" id="capacidade_tanque" type="text" required
                placeholder="Digite a capacidade do tanque">
        </div>
    </div>

    <div class="alert-danger" id="erro"></div>
    <button type="submit" style="float:right" class="btn btn-primary">Salvar</button>
</form>
