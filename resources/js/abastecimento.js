window.onload = function() {
    list();
};

function list() {
    $("#list tbody").html('<div class="spinner-border" style="position: absolute;display: block;top: 25%;left: 50%;" role="status"><span class="sr-only">Carregando...</span></div>');
    $.ajax({
        url: '/abastecimento/list',
        type: 'GET',
        success: function(data) {
            console.log(data);
            $("#list tbody").html("");
            if (data.length > 0) {
                data.forEach(function(abastecimento, key) {
                    popula_tabela(abastecimento);
                });
            } else {
                $("#list tbody").html($('<tr>').append($("<td colspan=4>").html($('<center>').html($('<b>').text('Não foram encontrados abastecimentos.')))));
            }
        },
        error: function(data) {
            $("#list tbody").html($('<tr>').append($("<td colspan=4>").html($('<center>').html($('<b>').text('Não foram encontrados abastecimentos.')))));
        }
    });
}

function store_abastecimento(el) {
    event.preventDefault();
    let formData = new FormData(el);
    let button = $(el).find('button');
    button.attr('disabled', true);
    button.html('Salvando...');
    $.ajax({
        url: "/abastecimento/store",
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
            if (!erro.responseJSON) {
                $('#erro').html(erro.responseText);
            } else {
                $('#erro').html('');
                $.each(erro.responseJSON.errors, function(key, value) {
                    $('#erro').attr("hidden", false);
                    $('#erro').append(value + "<br>");
                    // console.log(erro.responseJSON);
                });
                if (erro.responseJSON.error) {
                    $('#erro').append(erro.responseJSON.error);
                }

            }

            button.html('Salvar');
            button.attr('disabled', false);
        }
    });
    return false;
}

function abastecimento_open_create() {
    $('#modal-geral').modal('show');
    $('#modal-body-geral').html('Carregando....');
    $('#modal-geral-title').html('Criação de abastecimento');
    $('.modal-content').css('width', '800px');
    $('#modal-body-geral').load('/abastecimento/form', () => {

    });
}





function limpa_form() {
    $('#id').val('');
    $('#nome').val('');
    $('#cpf').val('');
    $('#data_nascimento').val('');
    $('#numero_cnh').val('');
    $('#cnh').val('');
    $('#categoria_cnh').val('');
}



function popula_tabela(abastecimento) {
    console.log(abastecimento);
    let data = new Date(abastecimento.data).toLocaleString('pt-br', {
        day: 'numeric',
        year: 'numeric',
        month: 'numeric',
    });
    $("#list tbody").append(`<tr>
                        <td>${abastecimento.combustivel.nome}</td>
                        <td>${data}</td>
                        <td>${abastecimento.quantidade_abastecida}</td>
                        <td>${abastecimento.motorista.nome}</td>
                        <td>${abastecimento.veiculo.nome}</td>
                        </tr>`);
}