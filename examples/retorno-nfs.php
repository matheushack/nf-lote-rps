<?php
/**
 * Created by PhpStorm.
 * User: matheus
 * Date: 18/01/18
 * Time: 14:32
 */

require_once ('vendor/autoload.php');

use MatheusHack\NfLoteRPS\Nf;

try{
    $nf = new Nf();
    $file = 'ENDERECO/arquivo.txt';
    $retorno = $nf->retornoNFs($file);

    d($retorno->header);
    d($retorno->detail);
    d($retorno->trailler);

}catch(Exception $e){
    dd($e->getMessage());
}