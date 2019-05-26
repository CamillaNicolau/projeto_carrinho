$(document).ready(function() {

    $('#form_cadastra_promocao').ajaxForm({ 
        dataType:  'json',
        beforeSend: validaForm,
        success:   tratarResultado 
    });
    listaPromocao();

});

function validaForm(){
    if(true){
        alertaFnc("Aguarde", "Salvando dados...", null, true, null);
        return true;
    } else {
        return false;
    }
}

function tratarResultado (retorno) {  
    if(retorno.sucesso == true) {
        resetarFormulario();
        alertaFnc("Sucesso", retorno.mensagem,250, true, "success");
    } else {
        alertaFnc("Erro", retorno.mensagem,null, true, "error"); 
    }
}

function resetarFormulario(){
    $("#form_cadastra_promocao")[0].reset();
    $("#cadastroPromocao").slideUp(function() {
       listaPromocao();
    }); 
    $("#cadastroPromocao").attr('opacity','0');
}

function listaPromocao() {
    $.ajax({
        type: 'POST',
        url: 'promocao',
        data: 'acao=lista',
        dataType: 'json',
        beforeSend: function() {
            alertaFnc("Aguarde", "Carregando...", 250, false, null);
        },  
        success: function(retorno) {
            $('#listaPromocao').html('');
            if (retorno.sucesso == true) {
                $.each(retorno.html,function(i,v){
                    $('#listaPromocao').append('<tr><th class="col text-left">'+v.nome+'</th>'+
                        '<td class="col d-flex">'+
                        '<button onclick="editarPromocao('+v.id+')" class="btn btn-primary mx-2 btn-xs  " data-toggle="modal" data-target="#cadastroPromocao"><i class="fa fa-edit"></i></button>'+
                        '<button onclick="removerPromocao('+v.id+')" class="btn btn-danger mx-2 btn-xs"> <i class="fa fa-trash"></i></ button>'+
                        '</td>'+
                        '</tr>');
                });
            }
        }
    }); 
}

function editarPromocao(idPromocao){
    $.ajax({
        type: 'POST',
        url: 'promocao',
        data: 'acao=buscar_dados_para_edicao&id_promocao='+idPromocao,
        dataType: 'json',
        beforeSend: function() {
          alertaFnc("Aguarde", "Carregando os dados..", 250, false, null);
        },
        success: function(retorno) {
            $("#form_cadastra_promocao #id_promocao").val(retorno.idPromocao);
            $("#nomePromocao").val(retorno.nome);
            $("#condicao").val(retorno.condicao);
            $("#valorAvaliado").val(retorno.valorAvaliado);
            $("#acaoPromocao").val(retorno.acaoPromocao);
            $("#campoCondicionado").val(retorno.campoCondicionado);
            $("#acaoAplicada").val(retorno.acaoAplicada);
            $('#form_cadastra_promocao #acao').val('atualizar');
        }
    });
}

function removerPromocao(idPromocao) {
    $.ajax({    
        type: 'POST',
        url: 'promocao',
        data: 'acao=deletar&id_promocao='+idPromocao,
        dataType:'json',
        beforeSend: function() {
            alertaFnc("Aguarde", "Excluindo...", null, false, null);
        },
        success: function(retorno) {
            if (retorno.sucesso) {
                listaPromocao();
                alertaFnc("Sucesso", retorno.mensagem,2000, true, "success");
            } else {
                alertaFnc("Atenção", retorno.mensagem,2000, true, "error");
            }
        }
    });   
}