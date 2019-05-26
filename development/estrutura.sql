
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `CARRINHO`
--
CREATE DATABASE carrinho;

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL COMMENT 'Identificador do produto',
  `nome` varchar(255) NOT NULL COMMENT 'Nome definido para o produto',
  `preco` decimal(10,2) NOT NULL COMMENT 'Preço definido para o produto',
  `promocao` int(11) DEFAULT NULL COMMENT 'Identificação da promoção adicionada ao produto',
  `url_imagem` varchar(255) DEFAULT NULL COMMENT 'caminho da imagem do produto',
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de criação do produto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de produtos ';

CREATE TABLE `promocao` (
  `id_promocao` int(11) NOT NULL COMMENT 'Identificador da promoção',
  `nome` varchar(255) NOT NULL COMMENT 'Nome definido para a promoção',
  `campo_condicionado` varchar(25) DEFAULT NULL COMMENT 'campo para definição de condição da promoção(valor ou quantidade)',
  `condicao` varchar(25) DEFAULT NULL,
  `valor_promocao` decimal(10,2) DEFAULT NULL,
  `acao` varchar(40) DEFAULT NULL,
  `acao_aplicada` varchar(25) DEFAULT NULL,
  `data_criacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Data de criação da promoção'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Tabela de promoções ';

ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`),
  ADD KEY `fkPromocao` (`promocao`);

ALTER TABLE `promocao`
  ADD PRIMARY KEY (`id_promocao`);

ALTER TABLE `produto`
  ADD CONSTRAINT `fkPromocao` FOREIGN KEY (`promocao`) REFERENCES `promocao` (`id_promocao`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
