<?php
namespace NFePHP\NFSe\SIGISS;

use NFePHP\Common\DOMImproved as Dom;
use NFePHP\Common\Strings;
use stdClass;
use RuntimeException;
use DOMElement;
use DateTime;

class Make{
    
    public $dom;

    public $xml;
    
    public function __construct() {
        
        $this->dom = new Dom('1.0', 'UTF-8');

        $this->dom->preserveWhiteSpace = false;
        
        $this->dom->formatOutput = false;
    }

    public function gerarNota(){

        $root = $this->dom->createElement('DescricaoRps');
        $this->dom->appendChild($root);

        $cnpj = $this->dom->createElement('cnpj', ' dados teste ');
        $root->appendChild($cnpj);

        $senha = $this->dom->createElement('senha', ' dados teste ');
        $root->appendChild($senha);

        $crc = $this->dom->createElement('crc', ' dados teste ');
        $root->appendChild($crc);

        $crcEstado = $this->dom->createElement('crc_estado', ' dados teste ');
        $root->appendChild($crcEstado);

        $aliquotaSimples = $this->dom->createElement('aliquota_simples', ' dados teste ');
        $root->appendChild($aliquotaSimples);

        $isSisLegado = $this->dom->createElement('id_sis_legado', ' dados teste ');
        $root->appendChild($isSisLegado);

        $servico = $this->dom->createElement('servico', ' dados teste ');
        $root->appendChild($servico);

        $situacao = $this->dom->createElement('situacao', ' dados teste ');
        $root->appendChild($situacao);

        $valor = $this->dom->createElement('valor', ' dados teste ');
        $root->appendChild($valor);

        $base = $this->dom->createElement('base', ' dados teste ');
        $root->appendChild($base);

        $descricaoNF = $this->dom->createElement('descricaoNF', ' dados teste ');
        $root->appendChild($descricaoNF);

        $tomadorTipo = $this->dom->createElement('tomador_tipo', ' dados teste ');
        $root->appendChild($tomadorTipo);

        $tomadorCnpj = $this->dom->createElement('tomador_cnpj', ' dados teste ');
        $root->appendChild($tomadorCnpj);

        $tomadorEmail = $this->dom->createElement('tomador_email', ' dados teste ');
        $root->appendChild($tomadorEmail);

        $tomadorIe = $this->dom->createElement('tomador_ie', ' dados teste ');
        $root->appendChild($tomadorIe);

        $tomadorIm = $this->dom->createElement('tomador_im', ' dados teste ');
        $root->appendChild($tomadorIm);

        $tomadorRazao = $this->dom->createElement('tomador_razao', ' dados teste ');
        $root->appendChild($tomadorRazao);

        $tomadorFantasia = $this->dom->createElement('tomador_fantasia', ' dados teste ');
        $root->appendChild($tomadorFantasia);

        $tomadorEndereco = $this->dom->createElement('tomador_endereco', ' dados teste ');
        $root->appendChild($tomadorEndereco);

        $tomadorNumero = $this->dom->createElement('tomador_numero', ' dados teste ');
        $root->appendChild($tomadorNumero);

        $tomadorComplemento = $this->dom->createElement('tomador_complemento', ' dados teste ');
        $root->appendChild($tomadorComplemento);

        $tomadorBairro = $this->dom->createElement('tomador_bairro', ' dados teste ');
        $root->appendChild($tomadorBairro);

        $tomadorCep = $this->dom->createElement('tomador_CEP', ' dados teste ');
        $root->appendChild($tomadorCep);

        $tomadorCodCidade = $this->dom->createElement('tomador_cod_cidade', ' dados teste ');
        $root->appendChild($tomadorCodCidade);

        $tomadorFone = $this->dom->createElement('tomador_fone', ' dados teste ');
        $root->appendChild($tomadorFone);

        $tomadorRamal = $this->dom->createElement('tomador_ramal', ' dados teste ');
        $root->appendChild($tomadorRamal);

        $tomadorFax = $this->dom->createElement('tomador_fax', ' dados teste ');
        $root->appendChild($tomadorFax);

        $rpsNum = $this->dom->createElement('rps_num', ' dados teste ');
        $root->appendChild($rpsNum);

        $rpsSerie = $this->dom->createElement('rps_serie', ' dados teste ');
        $root->appendChild($rpsSerie);

        $rpsDia = $this->dom->createElement('rps_dia', ' dados teste ');
        $root->appendChild($rpsDia);

        $rpsMes = $this->dom->createElement('rps_mes', ' dados teste ');
        $root->appendChild($rpsMes);

        $rpsAno = $this->dom->createElement('rps_ano', ' dados teste ');
        $root->appendChild($rpsAno);

        $outroMunicipio = $this->dom->createElement('outro_municipio', ' dados teste ');
        $root->appendChild($outroMunicipio);

        $codOutroMunicipio = $this->dom->createElement('cod_outro_municipio', ' dados teste ');
        $root->appendChild($codOutroMunicipio);

        $retencaoIss = $this->dom->createElement('retencao_iss', ' dados teste ');
        $root->appendChild($retencaoIss);

        $pis = $this->dom->createElement('pis', ' dados teste ');
        $root->appendChild($pis);

        $cofins = $this->dom->createElement('cofins', ' dados teste ');
        $root->appendChild($cofins);

        $inss = $this->dom->createElement('inss', ' dados teste ');
        $root->appendChild($inss);

        $irrf = $this->dom->createElement('irrf', ' dados teste ');
        $root->appendChild($irrf);

        $csll = $this->dom->createElement('csll', ' dados teste ');
        $root->appendChild($csll);

        $tipoObra = $this->dom->createElement('tipo_obra', ' dados teste ');
        $root->appendChild($tipoObra);

        $diaEmissao = $this->dom->createElement('dia_emissao', ' dados teste ');
        $root->appendChild($diaEmissao);

        $mesEmissao = $this->dom->createElement('mes_emissao', ' dados teste ');
        $root->appendChild($mesEmissao);

        $anoEmissao = $this->dom->createElement('ano_emissao', ' dados teste ');
        $root->appendChild($anoEmissao);

        $this->xml = $this->dom->saveXML();

        echo $this->xml;
    }

    public function getXML(){

        if (empty($this->xml)) {

            $this->monta();

        }

        return $this->xml;
    }
}