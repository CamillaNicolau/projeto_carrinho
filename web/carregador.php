<?php

/**
 *
 * @author Camilla Nicolau
 * @version 1.0
 * @copyright 2019
 */

# Evitar acesso direto.
if(!defined('PATH_RAIZ')) {
    exit;
}

// Funções globais
require PATH_RAIZ . '/function/global.php';
$valor = ($_GET['acao']) ? Tratamentos::index($_GET['acao']) : 'Index';

// Carrega a aplicação se o $_GET for true.
if(isset($inst)) {
    $IniciaTeste = new Inicio($valor);
}
