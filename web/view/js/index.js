$(document).ready(function() {

    $('#form_cadastra_produto').ajaxForm({ 
        dataType:  'json',
        beforeSend: validaForm,
        success:   tratarResultado 
    });
    
    $('#editar-produto').on('click',function(){
        $('#listaProduto .card')
        .toggleClass('border-warning')
        .find('.card-footer')
        .toggle('slideDown');
    });
    
    $('body').on('click','#listaProduto a',function(){
    
        var infoProduto = $(this).attr('id');
        var dadosProduto = infoProduto.split('-');
        $.ajax({
            type: 'POST',
            url: 'carrinho',
            data: 'acao=adicionar&id_produto='+dadosProduto[1],
            dataType: 'json',
            beforeSend: function() {
                alertaFnc("Aguarde", "Carregando...", 250, false, null);
            },  
            success: function(retorno) {
                if (retorno.sucesso == true) {
                    window.location='carrinho';    
                }
            }
        }); 
    });
    montarPromocao();
    listaProduto();
    
    
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
    $("#form_cadastra_produto")[0].reset();
    $("body").removeClass("modal-open").removeAttr('style');
    $("#cadastroProduto").removeClass('show').removeAttr('style').attr('aria-hidden',true).hide();
    $(".modal-backdrop").remove();
    listaProduto(); 
}

function listaProduto() {
    $.ajax({
        type: 'POST',
        url: 'index',
        data: 'acao=lista',
        dataType: 'json',
        beforeSend: function() {
            alertaFnc("Aguarde", "Carregando...", 250, false, null);
        },  
        success: function(retorno) {
            $('#listaProduto').html('');
            if (retorno.sucesso == true) {
                $.each(retorno.html,function(i,v){
                    $('#listaProduto').append(
                        '<div class="col-sm-6 col-md-3 ">'+
                            '<div class="card text-center mb-5">'+
                                    '<div class="card-body">'+
                                        '<h3 class="card-title">'+v.nome+'</h3>'+
                                        '<h5>R$ '+v.preco+'</h5>'+
                                        '<input name="id_produto" value="'+v.id+'" id="id_produto" type="hidden" />'+
                                        '<input name="acao" value="adicionar" id="acao" type="hidden" />'+
                                        '<a href="javascript:;" id="item-'+v.id+'" class="btn btn-secondary px-4 shadow my-2">Comprar</a>'+
                                    '</div>'+
                                    '<div class="card-footer" style="display: none;">'+
                                        '<button onclick="editarProduto('+v.id+')" class="btn btn-primary mx-2" data-toggle="modal" data-target="#cadastroProduto">'+
                                            '<i class="fa fa-edit"></i>'+
                                        '</button>'+
                                        '<button onclick="removerProduto('+v.id+')" class="btn btn-danger mx-2">'+
                                            '<i class="fa fa-trash"></i>'+
                                        '</button>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>');
                });
            }
        }
    }); 
}

function editarProduto(idProduto){
    $.ajax({
        type: 'POST',
        url: 'index',
        data: 'acao=buscar_dados_para_edicao&id_produto='+idProduto,
        dataType: 'json',
        beforeSend: function() {
          alertaFnc("Aguarde", "Carregando os dados..", 250, false, null);
        },
        success: function(retorno) {
            $('#labelModal').text('Editar produto');
            $("#form_cadastra_produto #id_produto").val(retorno.idProduto);
            $("#nomeProduto").val(retorno.nome);
            $("#precoProduto").val(retorno.preco);
            $("#promocao").val(retorno.promocao);
            $('#form_cadastra_produto #acao').val('atualizar');
            
        }
    });
}

function removerProduto(idProduto) {
    $.ajax({    
        type: 'POST',
        url: 'index',
        data: 'acao=deletar&id_produto='+idProduto,
        dataType:'json',
        beforeSend: function() {
            alertaFnc("Aguarde", "Excluindo...", null, false, null);
        },
        success: function(retorno) {
            if (retorno.sucesso) {
                listaProduto();
                alertaFnc("Sucesso", retorno.mensagem,2000, true, "success");
            } else {
                alertaFnc("Atenção", retorno.mensagem,2000, true, "error");
            }
        }
    });   
}

function montarPromocao(){
    $.ajax({
        type: "POST",
        url: "index",
        data: 'acao=select_promocao',
        dataType: 'json',
        beforeSend: function() {
            alertaFnc("Aguarde", "Carregando...", 250, false, null);
        },  
        success: function(retorno) 
        {
            if(retorno.sucesso === true) {
              $.each(retorno.html,function(i,v) {
                var selectPromocao = document.getElementById("promocao");
                var opt0 = document.createElement("option");
                opt0.value = v.id;
                opt0.text = v.nome;
                selectPromocao.add(opt0);
              });
            } 
        } 
    });
}
