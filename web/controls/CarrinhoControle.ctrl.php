<?php

/**
 * Gerencia a exibição do carrinho.
 *
 * @author Camilla Nicolau
 * @version 1.0
 * @copyright 2019
 */
class CarrinhoControle
{

    public function tratarAcoes()
    {      
      if(isset($_REQUEST['acao']));
        switch ($_REQUEST['acao']) {
            case 'adicionar':
                try {
                    $id_produto = (int)$_POST['id_produto'];
                    if(isset($_SESSION['carrinho'][$id_produto])){
                        $_SESSION['carrinho'][$id_produto] +=1;
                    }else{
                        $_SESSION['carrinho'][$id_produto] =1;
                    }
                    
                    exit(json_encode(array('sucesso'=>true)));
                } catch (Exception $e) {
                   exit(json_encode(array('sucesso'=>false)));         
                }
            break;
            case 'lista_carrinho':
                try {

                    $html = [];
                    $total = [];
                    $_SESSION['dados'] = [];
                    if(isset($_SESSION['carrinho']))
                    foreach ($_SESSION['carrinho'] as $idProduto =>$quantidade){
                        $ProdutoCarrinho = ProdutoRepositorio::buscaProduto(['id_produto='.$idProduto]);
                        if(count($ProdutoCarrinho)>0){
                            if(isset($ProdutoCarrinho[0]->promocao)){
                                $PromocaoProduto = PromocaoRepositorio::buscaPromocao(['id_promocao='.$ProdutoCarrinho[0]->promocao]);
                                $promocao = $PromocaoProduto[0]->nome;
                            }else{
                                $promocao = "";
                            }
                            $_SESSION['info']['quantidade'] = $quantidade;
                            $_SESSION['info']['subtotal'] = $quantidade * $ProdutoCarrinho[0]->preco;
                            $total[] = PromocaoModelo::calculaPromocao($ProdutoCarrinho[0]->id_produto);
                            $html[] = array('id'=>$ProdutoCarrinho[0]->id_produto,'nome'=>$ProdutoCarrinho[0]->nome,
                                'preco'=>$ProdutoCarrinho[0]->preco,'quatidade'=>$quantidade, 'subtotal'=>PromocaoModelo::calculaPromocao($ProdutoCarrinho[0]->id_produto),
                                'promocao'=>$promocao) ;
                            array_push($_SESSION['dados'], $html);
                        }
                        
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
             * Conteúdo do carrinho
             */
            require PATH_RAIZ . '/view/carrinho.php';

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
