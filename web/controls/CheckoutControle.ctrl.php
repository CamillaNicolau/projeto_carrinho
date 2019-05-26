<?php

/**
 * Gerencia a exibição da página do checkout.
 *
 * @author Camilla Nicolau
 * @version 1.0
 * @copyright 2019
 */
class CheckoutControle
{
    public function tratarAcoes()
    {      
      if(isset($_REQUEST['acao']));
      switch ($_REQUEST['acao']) {
        case 'lista':
                try {

                    $html = [];
                    $total = [];
                    $i=0;
                    foreach ($_SESSION['dados'] as $produtos){
                        $total[] = $produtos[$i]['subtotal'];
                        $html[] = array('id'=>$produtos[$i]['id'],'nome'=>$produtos[$i]['nome'],
                            'quantidade'=>$produtos[$i]['quatidade'], 'subtotal'=>$produtos[$i]['subtotal']) ; 
                        $i++;
                    }
                    
                    exit(json_encode(array('sucesso'=>true,'html'=>$html,'total'=>array_sum($total))));
                } catch (Exception $e) {
                    exit(json_encode(array('sucesso'=>false)));     
                }
            break;
        }
    }
    public function getHtml()
    {
        try
        {
            /*
             * Cabeçalho
             */
            require PATH_RAIZ . '/view/include/menu.php';

            /*
             * Conteúdo do checkout
             */
            require PATH_RAIZ . '/view/checkout.php';

            /*
             * Rodapé
             */
            require PATH_RAIZ . '/view/include/rodape.php';
        }
        catch (Exception $ex)
        {
            echo 'Exceção: ',  $ex->getMessage(), "\n";
        }
		
    }

}

