window.onload = function() {
    list();
};

function list() {
    $("#list tbody").html('<div class="spinner-border" style="position: absolute;display: block;top: 25%;left: 50%;" role="status"><span class="sr-only">Carregando...</span></div>');
    $.ajax({
        url: '/veiculo/list',
        type: 'GET',
        success: function(data) {
            console.log(data);
            $("#list tbody").html("");
            if (data.length > 0) {
                data.forEach(function(veiculo, key) {
                    popula_tabela(veiculo);
                });
            } else {
                $("#list tbody").html($('<tr>').append($("<td colspan=4>").html($('<center>').html($('<b>').text('Não foram encontrados veiculos.')))));
            }
        },
        error: function(data) {
            $("#list tbody").html($('<tr>').append($("<td colspan=4>").html($('<center>').html($('<b>').text('Não foram encontrados veiculos.')))));
        }
    });
}

function store_veiculo(el) {
    event.preventDefault();
    let formData = new FormData(el);
    let button = $(el).find('button');
    button.attr('disabled', true);
    button.html('Salvando...');
    $.ajax({
        url: "/veiculo/store",
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(result) {
            alert("Registro salvo com sucesso !");
            // limpa_form();
            button.attr('disabled', false);
            button.html('Salvar');
            if ($('#id').val() >= 1) {
                $('#modal-geral').modal('hide');
            } else {
                limpa_form();
            }
            list();
        },
        error: function(erro) {
            console.log(erro.responseText, !erro.responseJSON);
            if (!erro.responseJSON) {
                console.log(erro.responseText);
                $('#erro').html(erro.responseText);
            } else {
                $('#erro').html('');
                $.each(erro.responseJSON.errors, function(key, value) {
                    $('#erro').attr("hidden", false);
                    $('#erro').append(value + "<br>");
                    // console.log(erro.responseJSON);
                });

            }

            button.html('Salvar');
            button.attr('disabled', false);
        }
    });
    return false;
}

function veiculo_open_create() {
    $('#modal-geral').modal('show');
    $('#modal-body-geral').html('Carregando....');
    $('#modal-geral-title').html('Criação de veiculo');
    $('.modal-content').css('width', '800px');
    $('#modal-body-geral').load('/veiculo/form', () => {

    });
}

function veiculo_open_edit(id) {
    $.ajax({
        url: '/veiculo/edit/' + id,
        type: 'GET',
        success: function(veiculo) {
            console.log(veiculo);
            $('#modal-geral').modal('show');
            $('#modal-body-geral').html('Carregando....');
            $('#modal-geral-title').html('Edição de veiculo');
            $('.modal-content').css('width', '800px');
            $('#modal-body-geral').load('/veiculo/form', () => {
                $('#id').val(veiculo.id);
                $('#nome').val(veiculo.nome);
                $('#placa').val(veiculo.placa);
                $('#fabricante').val(veiculo.fabricante);
                $('#ano_fabricacao').val(veiculo.ano_fabricacao);
                $('#tipo_combustivel_id').val(veiculo.tipo_combustivel_id);
                $('#capacidade_tanque').val(veiculo.capacidade_tanque);
            });
        }
    });
}

function delete_veiculo(id, button) {
    event.preventDefault();
    if (confirm('Deseja excluir veiculo?')) {
        $(button).attr('disabled', true);
        $(button).html('Deletando...');
        $.ajax({
            url: "/veiculo/delete/" + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "DELETE",
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                alert("Registro excluído com sucesso!");
                // limpa_form();
                $(button).attr('disabled', false);
                $(button).html('Deletar');
                list();
            },
            error: function(erro) {
                if (!erro.responseJSON) {
                    console.log(erro.responseText);
                    $('#erro').html(erro.responseText);
                } else {
                    $('#erro').html('');
                    $.each(erro.responseJSON.errors, function(key, value) {
                        $('#erro').attr("hidden", false);
                        $('#erro').append(value + "<br>");
                    });
                }
                $(button).html('Deletar');
                $(button).attr('disabled', false);
            }
        });
    }
    return false;
}

function limpa_form() {
    $('#id').val('');
    $('#nome').val('');
    $('#placa').val('');
    $('#fabricante').val('');
    $('#ano_fabricacao').val('');
    $('#tipo_combustivel').val('');
    $('#capacidade_tanque').val('');
}



function popula_tabela(veiculo) {
    console.log(veiculo);
    $("#list tbody").append(`<tr>
                        <td>${veiculo.nome}</td>
                        <td>${veiculo.placa}</td>
                        <td>${veiculo.fabricante}</td>
                        <td>${veiculo.ano_fabricacao}</td>
                        <td>${veiculo.observacoes!=null?veiculo.observacoes:'-'}</td>
                        <td><button class="btn btn-primary" onclick="veiculo_open_edit(${veiculo.id})">Editar</button>  <button class="btn btn-danger" onclick="delete_veiculo(${veiculo.id},this)">Deletar</button></td>
                        </tr>`);
}