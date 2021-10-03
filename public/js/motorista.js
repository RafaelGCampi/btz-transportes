window.onload = function() {
    list();
};

function list() {
    $("#list tbody").html('<div class="spinner-border" style="position: absolute;display: block;top: 25%;left: 50%;" role="status"><span class="sr-only">Carregando...</span></div>');
    $.ajax({
        url: '/motorista/list',
        type: 'GET',
        success: function(data) {
            console.log(data);
            $("#list tbody").html("");
            if (data.length > 0) {
                data.forEach(function(motorista, key) {
                    popula_tabela(motorista);
                });
            } else {
                $("#list tbody").html($('<tr>').append($("<td colspan=4>").html($('<center>').html($('<b>').text('Não foram encontrados motoristas.')))));
            }
        },
        error: function(data) {
            $("#list tbody").html($('<tr>').append($("<td colspan=4>").html($('<center>').html($('<b>').text('Não foram encontrados motoristas.')))));
        }
    });
}

function store_motorista(el) {
    event.preventDefault();
    let formData = new FormData(el);
    let button = $(el).find('button');
    button.attr('disabled', true);
    button.html('Salvando...');
    $.ajax({
        url: "/motorista/store",
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

function motorista_open_create() {
    $('#modal-geral').modal('show');
    $('#modal-body-geral').html('Carregando....');
    $('#modal-geral-title').html('Criação de motorista');
    $('.modal-content').css('width', '800px');
    $('#modal-body-geral').load('/motorista/form', () => {

    });
}

function motorista_open_edit(id) {
    $.ajax({
        url: '/motorista/edit/' + id,
        type: 'GET',
        success: function(motorista) {
            console.log(motorista);
            $('#modal-geral').modal('show');
            $('#modal-body-geral').html('Carregando....');
            $('#modal-geral-title').html('Edição de motorista');
            $('.modal-content').css('width', '800px');
            $('#modal-body-geral').load('/motorista/form', () => {
                $('#id').val(motorista.id);
                $('#nome').val(motorista.nome);
                $('#cpf').val(motorista.cpf);
                $('#data_nascimento').val(motorista.data_nascimento);
                $('#numero_cnh').val(motorista.numero_cnh);
                $('#cnh').val(motorista.cnh);
                $('#categoria_cnh').val(motorista.categoria_cnh);
            });
        }
    });
}

function delete_motorista(id, button) {
    event.preventDefault();
    if (confirm('Deseja excluir motorista?')) {
        $(button).attr('disabled', true);
        $(button).html('Deletando...');
        $.ajax({
            url: "/motorista/delete/" + id,
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
    $('#cpf').val('');
    $('#data_nascimento').val('');
    $('#numero_cnh').val('');
    $('#cnh').val('');
    $('#categoria_cnh').val('');
}



function popula_tabela(motorista) {
    console.log(motorista);
    $("#list tbody").append(`<tr>
                        <td>${motorista.nome}</td>
                        <td>${motorista.cpf}</td>
                        <td>${motorista.categoria_cnh}</td>
                        <td>${motorista.status?'Ativo':'Inativo'}</td>
                        <td><button class="btn btn-primary" onclick="motorista_open_edit(${motorista.id})">Editar</button>  <button class="btn btn-danger" onclick="delete_motorista(${motorista.id},this)">Deletar</button></td>
                        </tr>`);
}

function formatar(mascara, documento) {
    let i = documento.value.length;
    let saida = mascara.substring(0, 1);
    let texto = mascara.substring(i);

    if (texto.substring(0, 1) != saida) {
        documento.value += texto.substring(0, 1);
    }
}