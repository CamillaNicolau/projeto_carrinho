<?php

/**
 * Objeto que representa o produto do sistema.
 *
 * @author Camilla Nicolau <camillacoelhonicolau@gmail>
 * @version 1.0
 * @copyright 2019
 */
class Produto
{
    /**
     * Chave identificadora do produto no banco de dados.
     *
     * @var int
     */
    private $idProduto;
    
    /**
     * Nome do produto.
     *
     * @var string
     */
    private $nome;
    
    /**
     * Preço do produto;
     *
     * @var string
     */
    private $preco;
    
    /**
     * Objeto da promoção ao qual criou essa produto.
     *
     * @var promocao
     */
    private $promocao;
    
    /**
     * Data da criação do registro no banco de dados.
     *
     * @var date
     */
    private $dataCriacao;	

    /**
     * Instancia um produto baseado em sua chave identificadora do banco de dados ou cria uma nova instância.
     *
     * @param int $idProduto Chave identificadora de um produto no banco de dados.
     * @return void
     */
    public function __construct($idProduto = null)
    {	
        switch (true){
            case filter_var($idProduto, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]):
                try{
                    $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
                    $QueryBuilder
                        ->select('*')
                        ->from('produto')
                        ->where('id_produto = ?')
                        ->setParameter(0,$idProduto, \PDO::PARAM_INT)
                    ;
                    $ObjDados = $QueryBuilder->execute()->fetch();
                    if(!$ObjDados){
                        echo('Registro de id '.$idProduto.' não encontrado no banco de dados.' );
                    }
                    $this->idProduto = $ObjDados->id_produto;
                    $this->nome = $ObjDados->nome;
                    $this->preco = $ObjDados->preco;
                    $this->promocao = $ObjDados->promocao;
                    $this->dataCriacao = $ObjDados->data_criacao;
                } catch(Exception $ex){
                    echo('Erro ao instanciar a classe '._CLASS_.'.' .$ex.getMessage());
                }
            break;
            case is_null($idProduto):
                //nada a fazer
            break;
            default:
                echo ('Tentativa de injection na classe '.__CLASS__.', variável $id recebeu o valor '.$idProduto.' do tipo '.gettype($idProduto));
            break;
        }
    }

    /**
     * Informa o dado do atributo solicitado ou dispara exceção caso atributo não exista.
     *
     * @param string $atributo Nome do atributo que deseja obter seu respectivo dado.
     * @return mixed Retorna dado do atributo informado.
     */
    public function __get($atributo)
    {
        switch ($atributo) {
            case 'idProduto':
            case 'nome':
            case 'preco':
            case 'promocao':
            case 'dataCriacao':
                return $this->$atributo;
            break;
            default:
                echo("Atributo '" . $atributo ."'desconhecido, privado ou inválido da classe '" .__CLASS__. "'.");
            break;
        }
    }

    /**
     * Atribui o dado ao objeto de acordo com o atributo informado ou dispara exceção caso atributo não exista.
     *
     * @param string $atributo Nome do atributo que receberá o valor desejado.
     * @param mixed $value Dado que o atributo deve receber.
     * @return void
     */
    public function __set($atributo, $valor)
    {
        switch ($atributo) {
            case 'idProduto':
            case 'nome':
            case 'preco':
            case 'promocao':
                $this->$atributo = (($valor || $valor === 0 || $valor === '0') ? $valor : null);
            break;
            case 'dataCriacao':
                echo('A data de criação é um atributo privado da classe Produto.');
            break;
            default:
                echo("Atributo '" . $atributo ."'desconhecido, privado ou inválido da classe '" .__CLASS__. "'.");
            break;
        }
    }

    /**
     * Requisita a promocao
     *
     * @return Promocao
     */
    public function getPromocao()
    {
        return new Promocao($this->promocao);
    }

    /**
     * Define a promocao
     *
     * @param Promocao $Promocao
     * @return void
     */
    public function setPromocao(Promocao $Promocao)
    {
        $this->promocao = $Promocao->idPromocao;
    }
}
