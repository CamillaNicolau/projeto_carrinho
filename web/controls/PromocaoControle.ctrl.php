<?php

/**
 * Gerencia a exibição da página de promoções.
 *
 * @author Camilla Nicolau
 * @version 1.0
 * @copyright 2019
 */
class PromocaoControle
{
    public function tratarAcoes()
    {
        if(isset($_REQUEST['acao']));
        switch ($_REQUEST['acao']) {
            case 'adicionar':
                try {
                    
                    \Doctrine::beginTransaction();

                    $PromocaoRepositorio = new PromocaoRepositorio();
                    $Promocao = new Promocao();

                    $Promocao->nome = $_POST['nomePromocao'];
                    $Promocao->campoCondicionado = $_POST['campoCondicionado'];
                    $Promocao->condicao = $_POST['condicao'];
                    $Promocao->valor = $_POST['valorAvaliado'];
                    $Promocao->acao = $_POST['acaoPromocao'];
                    $Promocao->acaoAplicada = $_POST['acaoAplicada'];
                   
                    $PromocaoRepositorio->adicionaPromocao($Promocao);
                    
                    \Doctrine::commit();
                    exit(json_encode(array('sucesso'=>true,'mensagem'=>'Dados adicionados com sucessos')));
                } catch (Exception $e) {
                            
                }
            break;
            case 'buscar_dados_para_edicao':
                try{
                    $Promocao = new Promocao($_POST['id_promocao']);
                    $saida = array();

                    $saida['idPromocao'] = $Promocao->idPromocao;
                    $saida['nome'] = $Promocao->nome;
                    $saida['campoCondicionado'] = $Promocao->campoCondicionado;
                    $saida['condicao'] = $Promocao->condicao;
                    $saida['valorAvaliado'] = $Promocao->valor;
                    $saida['acaoPromocao'] = $Promocao->acao;
                    $saida['acaoAplicada'] = $Promocao->acaoAplicada;
                    
                    exit(json_encode($saida));
                }catch(Erro $E){
                    exit(json_encode(array('sucesso'=>false)));
                }
            break;
            case 'atualizar':
                try{
                    \Doctrine::beginTransaction();
                    $PromocaoRepositorio = new PromocaoRepositorio();
                    $Promocao = new Promocao($_POST['id_promocao']);
                    $Promocao->nome = $_POST['nomePromocao'];
                    $Promocao->campoCondicionado = $_POST['campoCondicionado'];
                    $Promocao->condicao = $_POST['condicao'];
                    $Promocao->valor = $_POST['valorAvaliado'];
                    $Promocao->acao = $_POST['acaoPromocao'];
                    $Promocao->acaoAplicada = $_POST['acaoAplicada'];
                    
                    $PromocaoRepositorio->atualizaPromocao($Promocao);
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
                    $PromocaoRepositorio = new PromocaoRepositorio();
                    $Promocao = new Promocao($_POST['id_promocao']);
              
                    if(!$PromocaoRepositorio->deletaPromocao($Promocao)){
                        exit(json_encode(array('sucesso'=>false,'mensagem'=>'Promoção ativa em um produto')));
                    }
                    \Doctrine::commit();
                    exit(json_encode(array('sucesso'=>true,'mensagem'=>'Promoção removida com sucessos')));
                } catch(Erro $E){
                    \Doctrine::rollBack();
                   exit(json_encode(array('sucesso'=>false,'mensagem'=>'Erro ao remover promoção')));
                }
            break;
            case 'lista':
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
             * Conteúdo da promoção
             */
            require PATH_RAIZ . '/view/promocao.php';

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
