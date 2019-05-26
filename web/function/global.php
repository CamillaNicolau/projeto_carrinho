<?php

/**
 * Função para carregar automaticamente todas as classes.
 * Padrão para as classes [nomeDoArquivo].class.php
 */

require PATH_RAIZ . "/useful/Inicio.class.php";
require PATH_RAIZ . "/useful/Tratamentos.class.php";
require PATH_RAIZ . "/model/entity/Promocao.class.php";
require PATH_RAIZ . "/model/entity/Produto.class.php";
require PATH_RAIZ . "/model/repository/Doctrine.class.php";
require PATH_RAIZ . "/model/repository/PromocaoRepositorio.class.php";
require PATH_RAIZ . "/model/repository/ProdutoRepositorio.class.php";
require PATH_RAIZ . "/model/service/PromocaoModelo.class.php";
require "../library/doctrine/vendor/autoload.php";
