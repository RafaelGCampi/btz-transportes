<form name="motorista_form" onsubmit="store_abastecimento(this)" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input hidden class="form-control" name="id" id="id">
    </div>

    <div class="row">
        <div class="form-group col-12">
            <label class="col-form-label" for="veiculo">Veículo:</label>
            <select class="form-control form-control-sm" id="veiculo" name="veiculo_id">
                <option value="" disabled selected>(Selecione um veículo)</option>
                @include('componentes.selects.veiculo-select')
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-12">
            <label class="col-form-label" for="motorista">Motorista:</label>
            <select class="form-control form-control-sm" id="motorista" name="motorista_id">
                <option value="" disabled selected>(Selecione um motorista)</option>
                @include('componentes.selects.motorista-select')
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-4">
            <label class="col-form-label" for="data">Data:</label>
            <input class="form-control" name="data" id="data" type="date" required>
        </div>
        <div class="form-group col-4">
            <label class="col-form-label" for="tipo_combustivel_id">Tipo de combustível:</label>
            <select class="form-control form-control-sm" id="tipo_combustivel_id" name="tipo_combustivel_id">
                <option value="" disabled selected>(Selecione o tipo de combustível)</option>
                @include('componentes.selects.tipo-combustivel-select')
            </select>
        </div>
        <div class="form-group col-4">
            <label class="col-form-label" for="quantidade_abastecida">Quantidade abastecida (Litros):</label>
            <input class="form-control" name="quantidade_abastecida" id="quantidade_abastecida" type="text" required>
        </div>
    </div>
    <div class="alert-danger" id="erro"></div>
    <button type="submit" style="float:right" class="btn btn-primary">Salvar</button>
</form>
