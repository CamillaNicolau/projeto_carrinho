$(document).ready(function() {
    listaCarrinho();
});

function listaCarrinho() {
    $.ajax({
        type: 'POST',
        url: 'carrinho',
        data: 'acao=lista_carrinho',
        dataType: 'json',
        beforeSend: function() {
            alertaFnc("Aguarde", "Carregando...", 250, false, null);
        },  
        success: function(retorno) {

            if (retorno.sucesso == true) {
                $('#listaCarrinho').html('');
                if((retorno.html).length > 0){
                    $.each(retorno.html,function(i,v){
                       
                        $('#listaCarrinho').append(
                                '<tr>'+
                                    '<th>'+v.nome+'</th>'+
                                    '<td>R$ '+v.preco+'</td>'+
                                    '<td class="col-2">'+
                                        '<div class="input-group">'+
                                            '<div class="input-group-prepend p-0">'+
                                                '<button class="btn btn-dark"><i class="fas fa-minus"></i></button>'+
                                            '</div>'+
                                            '<input value="'+v.quatidade+'" type="text" class="form-control" name="" id="quantidade-'+v.id+'">'+
                                            '<div class="input-group-append p-0">'+
                                                '<button class="btn btn-dark" onclick="contador('+v.id+')"><i class="fas fa-plus"></i></button>'+
                                            '</div>'+
                                        '</div>'+
                                    '</td>'+
                                    '<td>'+v.promocao+'</td><td id="subtotal">R$ '+v.subtotal+'</td>'+
                                '</tr>');   
                    });
                    $('#listaCarrinho').append(
                            '<tr>'+
                                '<th colspan="3"></th>'+
                                '<th class="pt-5">Total</th>'+
                                '<td class="pt-5">R$'+retorno.total+'</td>'+
                            '</tr>');
                }else{
                    $('#carrinho').hide();
                    $('.botoes').hide();
                    $('#carrinho-item').append('<div class="alert alert-warning" role="alert">Carrinho vazio!</div>');
                }
            }
        }
    }); 
}
function contador(id){
        var quantidade = parseInt($('#quantidade-'+id).val());
        quantidade = quantidade +1;
        $.ajax({
            type: 'POST',
            url: 'carrinho',
            data: 'acao=adicionar&id_produto='+id,
            dataType: 'json',
            beforeSend: function() {
                alertaFnc("Aguarde", "Carregando...", 250, false, null);
            },  
            success: function(retorno) {

                if (retorno.sucesso == true) {
                    listaCarrinho();
                }
            }
        }); 
    
}