CREATE TABLE IF NOT EXISTS`produto` (
  `id_produto` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'Identificador do produto',
  `nome` varchar(255) NOT NULL COMMENT 'Nome definido para o produto',
  `preco` decimal(10,2) NOT NULL COMMENT 'Preço definido para o produto',
  `promocao` int(11) DEFAULT NULL COMMENT 'Identificação da promoção adicionada ao produto',
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de criação do produto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de produtos ';

CREATE TABLE IF NOT EXISTS `promocao` (
  `id_promocao` int(11) PRIMARY KEY AUTO_INCREMENT  NOT NULL COMMENT 'Identificador da promoção',
  `nome` varchar(255) NOT NULL COMMENT 'Nome definido para a promoção',
  `campo_condicionado` varchar(25) DEFAULT NULL COMMENT 'campo para definição de condição da promoção(valor ou quantidade)',
  `condicao` varchar(25) DEFAULT NULL COMMENT 'Comparação realizada com o campo condicionado ao valor da promoção.', 
  `valor_promocao` decimal(10,2) DEFAULT NULL COMMENT 'valor definido para quantidade ou o preço da promoção.',
  `acao` varchar(40) DEFAULT NULL COMMENT 'Ação aplicada ao subtotal, caso a condição da regra da promoção seja verdadeira.',
  `acao_aplicada` varchar(25) DEFAULT NULL COMMENT 'Desconto aplicado ao subtotal, caso a condição da regra da promoção seja verdadeira.',
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de criação da promoção'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de promoções ';

ALTER TABLE `produto`
  ADD CONSTRAINT `fkPromocao` FOREIGN KEY (`promocao`) REFERENCES `promocao` (`id_promocao`) ON DELETE NO ACTION ON UPDATE NO ACTION;
