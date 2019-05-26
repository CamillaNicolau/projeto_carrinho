<?php

/**
 * Configurações gerais do sistema
 * 
 * @author Camilla Nicolau
 * @version 1.0
 * @copyright 2019
 */


# Configurações Gerais.
define('BD_USER','root');
define('BD_PASS','camilla2019');
define('BD_HOST' ,'localhost');
define('BD_NAME','carrinho');
if (!defined('BD_DEBUG')) {
    define('BD_DEBUG', false);
}

if (!defined('BD_PERSISTENT')) {
    define('BD_PERSISTENT', false);
}

define('PATH_RAIZ' , dirname( __FILE__ ));
# URL Raiz do Site.
define('URL_RAIZ_SITE', 'http://localhost/carrinho/web/index');
# Título principal do Sistema.
define("TITULO", "arrinho");

##### constantes #####
define("PATH_PRODUTO", PATH_RAIZ."/view/img/produto");
define("URL_PRODUTO", URL_RAIZ_SITE."/view/img/produto");
/*
 * Nome do sistema para apresentação na página
 */
define("SIS_NOME", "Carrinho - 1.0" );

/**
 * 
 * Carrega o carregador.php, responsável por carregar
 * a aplicação completa.
 */
if(isset($inicio)) {
	$inst = true;
}

require_once PATH_RAIZ . '/carregador.php';
