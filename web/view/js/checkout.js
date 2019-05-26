$(document).ready(function() {   
    listaCheckkout(); 
});

function listaCheckkout() {
    $.ajax({
        type: 'POST',
        url: 'checkout',
        data: 'acao=lista',
        dataType: 'json',
        beforeSend: function() {
            alertaFnc("Aguarde", "Carregando...", 250, false, null);
        },  
        success: function(retorno) {

            if (retorno.sucesso == true) {
               $.each(retorno.html,function(i,v){
                    $('#listaCheckout').append('<tr>'+
                        '<th>'+v.quantidade+'</th>'+
                        '<td>'+v.nome+'</td>'+
                        '<td>R$ '+v.subtotal+'</td>'+
                    '</tr>');
                });

                $('#listaCheckout').append(
                        '<tr>'+
                            '<th colspan="1"></th>'+
                            '<th class="pt-5">Total</th>'+
                            '<td class="pt-5">R$ '+retorno.total+'</td>'+
                        '</tr>');
            }
        }
    }); 
}