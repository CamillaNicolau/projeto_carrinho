<?php

/**
 * Responsável pelos registros dos produtos no banco de dados.
 *
 * @author Camilla Nicolau <camillacoelhonicolau@gmail>
 * @version 1.0
 * @copyright 2019
 */
class ProdutoRepositorio extends Produto
{
    /**
     * Adicionar as informações aramazenadas nos atributos do objeto no banco de dados.
     *
     * @return boolean
     */
    public function adicionaProduto(Produto $Produto)
    {
        if($Produto->idProduto){
            echo('Método adicionaProduto() utilizado em objeto que já é instancia de um produto válido.');
        }
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->insert('produto')
                ->setValue('nome',':nome')
                    ->setValue('preco',':preco')
                    ->setValue('promocao',':promocao')
                    ->setParameter(':nome', $Produto->nome)
                    ->setParameter(':preco',$Produto->preco)
                    ->setParameter(':promocao',$Produto->promocao)
                    ->execute()
                ;
            $Produto->idProduto = $QueryBuilder->getConnection()->lastInsertId();
            return $Produto->idProduto;
        } catch (Exception $ex) {
            echo('Erro ao inserir o produto '.$ex);
        }
    }

    /**
     * Salva as informações aramazenadas nos atributos do objeto no banco de dados.
     *
     * @access public
     * @return string
     */
    public function atualizaProduto(Produto $Produto)
    {
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->update('produto')
                ->set('nome',':nome')
                ->set('preco',':preco')
                ->set('promocao',':promocao')
                ->setParameter(':nome', $Produto->nome)
                ->setParameter(':preco',$Produto->preco)
                ->setParameter(':promocao',$Produto->promocao)
                ->where('id_produto = :id_produto')
                ->setParameter(':id_produto',$Produto->idProduto)
                ->execute()
            ;
        } catch (Exception $ex) {
            echo('Erro ao atualizar os dados do produto '.$ex);
        }
    }

    /**
     * Deleta o registro no banco de dados .
     *
     * @return bool Retorna true ao final da operação com sucesso
     */
    public function deletaProduto(Produto $Produto)
    { 
        if(!$Produto->idProduto){
            echo('Tentativa de deletar um produto inexistente no banco de dados.');
        }
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->delete('produto')
                ->where('id_produto = :id_produto')
                ->setParameter(':id_produto', $Produto->idProduto)
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
    public static function buscaProduto(array $condicoes = [])
    {
        $where = ($condicoes) ? implode('AND', $condicoes) : "";
        try {
            $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
            $QueryBuilder
                ->select('*')
                ->from('produto')
            ;
            if($where != ""){
                $QueryBuilder->where($where);
            }
            return $QueryBuilder->execute()->fetchAll();
        } catch (Exception $j) {
            echo('Erro ao buscar produto '.$j);
        }
    }
}
