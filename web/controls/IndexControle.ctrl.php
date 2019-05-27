<?php

/**
 * Gerencia a exibição da página inicial.
 *
 * @author Camilla Nicolau
 * @version 1.0
 * @copyright 2019
 */
class IndexControle
{

    public function tratarAcoes()
    {
        if(isset($_REQUEST['acao']));
        switch ($_REQUEST['acao']) {
            case 'adicionar':
                try {
                    \Doctrine::beginTransaction();

                    $ProdutoRepositorio = new ProdutoRepositorio();
                    $Produto = new Produto();

                    $Produto->nome = $_POST['nomeProduto'];
                    $Produto->preco = $_POST['precoProduto'];
                    $Produto->promocao = $_POST['promocao'];
           
                    $ProdutoRepositorio->adicionaProduto($Produto);
                    
                    \Doctrine::commit();
                    exit(json_encode(array('sucesso'=>true,'mensagem'=>'Dados adicionados com sucessos')));
                } catch (Exception $e) {
                   exit(json_encode(array('sucesso'=>false,'mensagem'=>'Erro ao adicionador dados.')));         
                }
            break;
            case 'buscar_dados_para_edicao':
                try{
                    $Produto = new Produto($_POST['id_produto']);
                    $saida = array();

                    $saida['idProduto'] = $Produto->idProduto;
                    $saida['nome'] = $Produto->nome;
                    $saida['preco'] = $Produto->preco;
                    $saida['promocao'] = $Produto->promocao;
                    
                    exit(json_encode($saida));
                }catch(Erro $E){
                    exit(json_encode(array('sucesso'=>false)));
                }
            break;
            case 'atualizar':
                try{
                   
                    \Doctrine::beginTransaction();
                    $ProdutoRepositorio = new ProdutoRepositorio();
                    $Produto = new Produto($_POST['id_produto']);

                    $Produto->nome = $_POST['nomeProduto'];
                    $Produto->preco = $_POST['precoProduto'];
                    $Produto->promocao = $_POST['promocao'];
                    $ProdutoRepositorio->atualizaProduto($Produto);
                    \Doctrine::commit();
                    exit(json_encode(array('sucesso'=>true,'mensagem'=>'Dados atualizados com sucessos')));
                } catch (Erro $E) {
                \Doctrine::rollBack();
                 exit(json_encode(array('sucesso'=>false,'mensagem'=>'Erro ao atualizar dados da promoção')));
                }
            break;
            case 'deletar':
                try{
                    \Doctrine::beginTransaction();
                    $ProdutoRepositorio = new ProdutoRepositorio();
                    $Produto = new Produto($_POST['id_produto']);
                   
                    $ProdutoRepositorio->deletaProduto($Produto);
                    \Doctrine::commit();
                    exit(json_encode(array('sucesso'=>true,'mensagem'=>'Produto removido com sucesso')));
                } catch(Erro $E){
                    \Doctrine::rollBack();
                   exit(json_encode(array('sucesso'=>false,'mensagem'=>'Erro ao remover produto')));
                }
            break;
            case 'lista':
                try{
                    $html = [];
                    $ListaProduto = ProdutoRepositorio::buscaProduto();
                    foreach($ListaProduto as $produto) {
                        $preco = number_format($produto->preco,2,",",".");
                        $html[] =  array('id'=>$produto->id_produto,'nome'=>$produto->nome, 'preco'=>$preco) ;
                    }
                    exit(json_encode(array('sucesso'=>true,'html'=>$html)));
                }catch(Erro $E){
                    exit(json_encode(array('sucesso'=>false, "mensagem" => "Desculpe, Ocorreu um erro ao carregar o produto.")));
                }
            break;
            case 'select_promocao':
                try{
                    $htmlPromocao = [];
                    $ListaPromocao = PromocaoRepositorio::buscaPromocao();
                    foreach($ListaPromocao as $promocao){
                       $htmlPromocao[] = array('id'=>$promocao->id_promocao, 'nome'=>$promocao->nome) ;
                    }
                    exit(json_encode(['sucesso'=>true, 'html'=>$htmlPromocao]));
                } catch (Erro $E) {
                    exit(json_encode(['sucesso'=>false]));
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
             * Conteúdo da Index
             */
            require PATH_RAIZ . '/view/index.php';

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
