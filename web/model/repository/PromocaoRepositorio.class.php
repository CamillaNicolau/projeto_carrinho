<?php

/**
 * Responsável pelos registros das promoções no banco de dados.
 *
 * @author Camilla Nicolau <camillacoelhonicolau@gmail>
 * @version 1.0
 * @copyright 2019
 */
class PromocaoRepositorio extends Promocao
{
    /**
     * Adicionar as informações aramazenadas nos atributos do objeto no banco de dados.
     *
     * @return boolean
     */
    public function adicionaPromocao(Promocao $Promocao)
    {
        if($Promocao->idPromocao){
            echo('Método adicionaPromocao() utilizado em objeto que já é instancia de uma promoção válida.');
        }
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->insert('promocao')
                ->setValue('nome',':nome')
                ->setValue('campo_condicionado',':campo_condicionado')
                ->setValue('condicao',':condicao')
                ->setValue('valor_promocao',':valor_promocao')
                ->setValue('acao',':acao')
                ->setValue('acao_aplicada',':acao_aplicada')
                ->setParameter(':nome', $Promocao->nome)
                ->setParameter(':campo_condicionado', $Promocao->campoCondicionado)
                ->setParameter(':condicao', $Promocao->condicao)
                ->setParameter(':valor_promocao', $Promocao->valor)
                ->setParameter(':acao', $Promocao->acao)
                ->setParameter(':acao_aplicada', $Promocao->acaoAplicada)
                ->execute()
            ;
            $Promocao->idPromocao = $QueryBuilder->getConnection()->lastInsertId();
            return $Promocao->idPromocao;
        } catch (Exception $ex) {
            echo('Erro ao inserir o promocao '.$ex);
        }
    }

    /**
     * Salva as informações aramazenadas nos atributos do objeto no banco de dados.
     *
     * @access public
     * @return string
     */
    public function atualizaPromocao(Promocao $Promocao)
    {
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->update('promocao')
                ->set('nome',':nome')
                ->set('campo_condicionado',':campo_condicionado')
                ->set('condicao',':condicao')
                ->set('valor_promocao',':valor_promocao')
                ->set('acao',':acao')
                ->set('acao_aplicada',':acao_aplicada')
                ->setParameter(':nome', $Promocao->nome)
                ->setParameter(':campo_condicionado', $Promocao->campoCondicionado)
                ->setParameter(':condicao', $Promocao->condicao)
                ->setParameter(':valor_promocao', $Promocao->valor)
                ->setParameter(':acao', $Promocao->acao)
                ->setParameter(':acao_aplicada', $Promocao->acaoAplicada)
                ->where('id_promocao = :id_promocao')
                ->setParameter(':id_promocao',$Promocao->idPromocao)
                ->execute()
            ;
        } catch (Exception $ex) {
            echo('Erro ao atualizar os dados da promoção '.$ex);
        }
    }

    /**
     * Deleta o registro no banco de dados .
     *
     * @return bool Retorna true ao final da operação com sucesso
     */
    public function deletaPromocao(Promocao $Promocao)
    {
        if(!$Promocao->idPromocao){
            echo('Tentativa de deletar uma promoção inexistente no banco de dados.');
        }
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->delete('promocao')
                ->where('id_promocao = :id_promocao')
                ->setParameter(':id_promocao', $Promocao->idPromocao)
                ->execute()
            ; 
        } catch (\Exception $j) {
            echo($j->getMessage());
        }
       return true;
        
    }

    /**
     * Realiza a consulta dos registros presentes no banco de dados de acordo com os termos informados para a pesquisa.
     * 
     * @param array $condicoes
     * @return array
     */
    public static function buscaPromocao(array $condicoes = [])
    {
        $where = ($condicoes) ? implode('AND', $condicoes) : "";
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->select('*')
                ->from('promocao')
            ;
            if($where != ""){
                $QueryBuilder->where($where);
            }
            return $QueryBuilder->execute()->fetchAll();
        } catch (Exception $e) {
            echo('Erro ao buscar promoção '.$e);
        }
    }
}