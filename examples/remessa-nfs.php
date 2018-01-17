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
    $dataFile->header->inscricao_prestador = '36827592';
    $dataFile->header->inicio_periodo_transmissao_arquivo = Carbon::now()->format('Ymd');
    $dataFile->header->fim_periodo_transmissao_arquivo = Carbon::now()->format('Ymd');;

    $totalServicos = 0;
    $totalDeducoes = 0;

    for($i = 1; $i <= 5; $i++) {
        $valorServicos = 500;
        $valorDeducoes = 0;
        $aliquota = 2;

        $detail = new Detail();
        $detail->serie_rps = 'MATHEUS123456';
        $detail->numero_rps = $i;
        $detail->data_emissa_rps = Carbon::now()->format('Ymd');
        $detail->valor_servicos = number_format($valorServicos, 2, ',', '');
        $detail->valor_deducoes = number_format($valorDeducoes, 2, ',', '');
        $detail->codigo_servico_prestado = '07123';
//        $detail->codigo_servico_prestado = '07109';
        $detail->aliquota = number_format($aliquota, 2, ',', '');;
        $detail->iss_retido = 2;
        $detail->indicador_documento_tomador = 2;
        $detail->documento_tomador = '';
        $detail->razao_social_tomador = 'E-HTL RESERVAS ONLINE DE HOTEIS';
        $detail->tipo_endereco_tomador = 'Av';
        $detail->endereco_tomador = 'Ipiranga';
        $detail->numero_endereco_tomador = '104';
        $detail->complemento_endereco_tomador = '4º andar';
        $detail->bairro_tomador = 'Centro';
        $detail->cidade_tomador = 'São Paulo';
        $detail->uf_tomador = 'SP';
        $detail->cep_tomador = '01046010';
        $detail->email_tomador = 'matheus@e-htl.com.br';
        $detail->descriminacao_servico = 'Nota fiscal de exemplo|Tipo CNPJ';

        $totalServicos = $totalServicos + $valorServicos;
        $totalDeducoes = $totalDeducoes + $valorDeducoes;
        $dataFile->detail[] = $detail;
    }

    $dataFile->trailler = new Trailler();
    $dataFile->trailler->numero_linhas = count($dataFile->detail);
    $dataFile->trailler->valor_total_servicos = number_format($totalServicos, 2, ',', '');
    $dataFile->trailler->valor_total_deducoes = number_format($totalDeducoes, 2, ',', '');

    $nf = new Nf();
    $file = $nf->remessaNFs($dataFile);

    dd($file);
}catch(Exception $e){
    dd($e->getMessage());
}