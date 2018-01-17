<?php
require_once ('vendor/autoload.php');

use Carbon\Carbon;
use \MatheusHack\NfLoteRPS\Nf;
use \MatheusHack\NfLoteRPS\Entities\Header;
use \MatheusHack\NfLoteRPS\Entities\Detail;
use \MatheusHack\NfLoteRPS\Entities\Trailler;
use \MatheusHack\NfLoteRPS\Entities\DataFile;

try {
    $dataFile = new DataFile();
    $dataFile->header = new Header();
    $dataFile->header->inscricao_tomador = '99999999';
    $dataFile->header->inicio_periodo_transmissao_arquivo = Carbon::now()->format('Ymd');
    $dataFile->header->fim_periodo_transmissao_arquivo = Carbon::now()->format('Ymd');;

    $totalServicos = 0;
    $totalDeducoes = 0;

    for($i = 1; $i <= 1; $i++) {
        $valorServicos = 500;
        $valorDeducoes = 0;
        $aliquota = 2;

        $detail = new Detail();
        $detail->serie_documento = 'SERIE';
        $detail->numero_documento = $i;
        $detail->data_prestacao = Carbon::now()->format('Ymd');
        $detail->valor_servicos = number_format($valorServicos, 2, ',', '');
        $detail->valor_deducoes = number_format($valorDeducoes, 2, ',', '');
        $detail->codigo_servico_prestado = '9999';
        $detail->aliquota = number_format($aliquota, 2, ',', '');;
        $detail->iss_retido = 1;
        $detail->indicador_documento_prestador = 2;
        $detail->documento_prestador = '09390630000194';
        $detail->razao_social_prestador = 'RAZAO SOCIAL EMPRESA';
        $detail->cep_prestador = '99999999';
        $detail->email_prestador = 'email@dominio.com.br';
        $detail->descriminacao_servico = 'NFTS|Nota fiscal de exemplo';

        $totalServicos = $totalServicos + $valorServicos;
        $totalDeducoes = $totalDeducoes + $valorDeducoes;
        $dataFile->detail[] = $detail;
    }

    $dataFile->trailler = new Trailler();
    $dataFile->trailler->numero_linhas = count($dataFile->detail);
    $dataFile->trailler->valor_total_servicos = number_format($totalServicos, 2, ',', '');
    $dataFile->trailler->valor_total_deducoes = number_format($totalDeducoes, 2, ',', '');

    $nf = new Nf();
    $file = $nf->remessaNFTs($dataFile);

    dd($file);
}catch(Exception $e){
    dd($e->getMessage());
}

