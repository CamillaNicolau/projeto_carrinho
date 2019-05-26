<?php

/**
 * Responsável pelos ações da classe de promoção.
 *
 * @author Camilla Nicolau <camillacoelhonicolau@gmail>
 * @version 1.0
 * @copyright 2019
 */
class PromocaoModelo extends Promocao
{
    const CONDICAO_IGUAL = 'igual';
    const CONDICAO_IGUAL_MAIOR = 'maior_igual';
 
    public static function calculaPromocao($id)
    {
        $ProdutoCarrinho = ProdutoRepositorio::buscaProduto(['id_produto='.$id]);
        if(count($ProdutoCarrinho)>0){
            if(isset($ProdutoCarrinho[0]->promocao)){
                $PromocaoProduto = PromocaoRepositorio::buscaPromocao(['id_promocao='.$ProdutoCarrinho[0]->promocao]);
                switch ($PromocaoProduto[0]->condicao){
                    case self::CONDICAO_IGUAL_MAIOR:
                    case self::CONDICAO_IGUAL:
                        if( $_SESSION["info"][$PromocaoProduto[0]->campo_condicionado]>= $PromocaoProduto[0]->valor_promocao){
                            switch($PromocaoProduto[0]->acao){
                                case 'DescPercent':
                                    $mod = $_SESSION["info"]['quantidade'] % $PromocaoProduto[0]->valor_promocao;
                                    $calc = (($PromocaoProduto[0]->acao_aplicada /100) * (($_SESSION["info"]['quantidade'] - $mod) * $ProdutoCarrinho[0]->preco) );
                                    return ($mod * $ProdutoCarrinho[0]->preco)+ $calc;
                                break;
                                case 'DescFixo':
                                    return ($_SESSION['info']['subtotal'] - $PromocaoProduto[0]->valor_promocao);  
                                break;
                                case 'vlFixo':
                                    $mod = $_SESSION["info"]['quantidade'] % $PromocaoProduto[0]->valor_promocao;
                                    $calc = (($_SESSION["info"]['quantidade'] - $mod) * ($ProdutoCarrinho[0]->preco) );
                                    return ($mod *$ProdutoCarrinho[0]->preco + $PromocaoProduto[0]->acao_aplicada);
                                break;
                            }
                        }else {
                            return $ProdutoCarrinho[0]->preco * $_SESSION["info"]['quantidade'] ;
                        }
                    break;
                }
            } else {
                return $ProdutoCarrinho[0]->preco * $_SESSION["info"]['quantidade'] ;
            }
        }
    }
}