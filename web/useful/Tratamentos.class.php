<?php

/**
 * Esta classe possui métodos estáticos para tratamento
 *
 * @author Camilla Nicolau
 * @version 1.0
 * @copyright 2019
 */
class Tratamentos
{

    public static function index($valor) 
    {

        if (preg_match('/_/', $valor)) {
          $valor = str_replace('_', '-', $valor);
        }
        $trata = explode('-', $valor);
        $qte = count($trata);
        for ($i=0; $i < $qte; $i++) { 
            $trata[$i] = ucfirst($trata[$i]);
        }
      return implode('', $trata);
    }
}