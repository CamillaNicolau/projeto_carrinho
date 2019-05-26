<?php

/**
 * Objeto que representa o promoção do sistema.
 *
 * @author Camilla Nicolau <camillacoelhonicolau@gmail>
 * @version 1.0
 * @copyright 2019
 */
class Promocao
{
    /**
     * Chave identificadora do promocao no banco de dados.
     *
     * @var int
     */
    private $idPromocao;
    
    /**
     * Nome da promocao.
     *
     * @var string
     */
    private $nome;
    
    /**
     * Data da criação do registro no banco de dados.
     *
     * @var date
     */
    private $dataCriacao;
    
    /**
     * Campo a ser condicionado a regra da promoção, definido por quantidade ou prço do produto.
     *
     * @var string
     */
    private $campoCondicionado;
    
    /**
     * Comparação realizada com o campo condicionado ao valor da promoção.
     *
     * @var string
     */
    private $condicao;
    
    /**
     * Ação aplicada ao subtotal, caso a condição da regra da promoção seja verdadeira.
     *
     * @var string
     */
    private $acao;
    
    /**
     * Desconto aplicado ao subtotal, caso a condição da regra da promoção seja verdadeira.
     *
     * @var string
     */
    private $acaoAplicada;
    
    /**
     * valor definido para quantidade ou o preço da promoção.
     *
     * @var string
     */
    private $valor;

    /**
     * Instancia uma promoção baseado em sua chave identificadora do banco de dados ou cria uma nova instância.
     *
     * @param int $idPromocao Chave identificadora de um promoção no banco de dados.
     * @return void
     */
    public function __construct($idPromocao = null)
    {
        switch (true){
            case filter_var($idPromocao, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]):
                try{ 
                    $QueryBuilder = \Doctrine::getInstance()->createQueryBuilder();
                    $QueryBuilder
                        ->select('*')
                        ->from('promocao')
                        ->where('id_promocao = ?')
                        ->setParameter(0, $idPromocao, \PDO::PARAM_INT)
                    ;
                    $ObjDados = $QueryBuilder->execute()->fetch();
                    
                    if (!$ObjDados) {
                        echo("Registro de id ". idPromocao . " não encontrado no banco de dados.");
                    }
                    $this->idPromocao = $ObjDados->id_promocao;
                    $this->nome = $ObjDados->nome;
                    $this->campoCondicionado = $ObjDados->campo_condicionado;
                    $this->condicao = $ObjDados->condicao;
                    $this->acao = $ObjDados->acao;
                    $this->valor = $ObjDados->valor_promocao;
                    $this->acaoAplicada = $ObjDados->acao_aplicada;
                    $this->dataCriacao = $ObjDados->data_criacao;
                } catch(Exception $ex){
                  echo ('Erro ao instanciar classe Promoção id $idPromocao. '. $ex->getMessage());
                }
            break;
            case is_null($idPromocao):
                //nada a fazer
            break;
            default:
                echo ('Tentativa de injection na classe '.__CLASS__.', variável $id recebeu o valor '.$idPromocao.' do tipo '.gettype($idPromocao));
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
            case 'idPromocao':
            case 'nome':
            case 'dataCriacao':
            case 'acao':
            case 'valor':
            case 'condicao':
            case 'campoCondicionado':
            case 'acaoAplicada':
                return $this->$atributo;
            break;
            default:
                echo("Atributo '" . $atributo . "'desconhecido, privado ou inválido da classe '" .__CLASS__. "'.");
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
            case 'idPromocao':
            case 'nome':
            case 'acao':
            case 'valor':
            case 'condicao':
            case 'campoCondicionado':
            case 'acaoAplicada':
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
}