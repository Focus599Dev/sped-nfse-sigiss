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
        
        $this->dom = new Dom();

        $this->dom->preserveWhiteSpace = false;

        $this->dom->formatOutput = false;
    }

    public function gerarNota(){

        $method = 'GerarNota';

        $soapAction = 'urn:sigiss_ws#GerarNota';

        $root = $this->dom->createElement('DescricaoRps');
        $this->dom->appendChild($root);
        $root->setAttribute('xsi:type', 'urn:tcDescricaoRps');

        $ccm = $this->dom->createElement('ccm', '1');
        $root->appendChild($ccm);
        $ccm->setAttribute('xsi:type', 'xsd:string');

        $cnpj = $this->dom->createElement('cnpj', ' dados teste ');
        $root->appendChild($cnpj);
        $cnpj->setAttribute('xsi:type', 'xsd:string');

        $senha = $this->dom->createElement('senha', ' dados teste ');
        $root->appendChild($senha);
        $senha->setAttribute('xsi:type', 'xsd:string');

        // crc e crcEstado são opcionais
        $crc = $this->dom->createElement('crc', ' dados teste ');
        $root->appendChild($crc);
        $crc->setAttribute('xsi:type', 'xsd:string');

        $crcEstado = $this->dom->createElement('crc_estado', ' dados teste ');
        $root->appendChild($crcEstado);
        $crcEstado->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $aliquotaSimples = $this->dom->createElement('aliquota_simples', ' dados teste ');
        $root->appendChild($aliquotaSimples); // não sei o que é
        $aliquotaSimples->setAttribute('xsi:type', 'xsd:string');

        //opcional
        $isSisLegado = $this->dom->createElement('id_sis_legado', ' dados teste ');
        $root->appendChild($isSisLegado); //
        $isSisLegado->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $servico = $this->dom->createElement('servico', ' dados teste ');
        $root->appendChild($servico);
        $servico->setAttribute('xsi:type', 'xsd:int');

        // Situação da nota fiscal eletrônica:
        // tp – Tributada no prestador;
        // tt – Tributada no tomador;
        // is – Isenta;
        // im – Imune;
        // nt – Não tributada.
        $situacao = $this->dom->createElement('situacao', ' dados teste ');
        $root->appendChild($situacao); // não sei o que é
        $situacao->setAttribute('xsi:type', 'xsd:string');

        $valor = $this->dom->createElement('valor', ' dados teste ');
        $root->appendChild($valor);
        $valor->setAttribute('xsi:type', 'xsd:string');

        $base = $this->dom->createElement('base', ' dados teste ');
        $root->appendChild($base);
        $base->setAttribute('xsi:type', 'xsd:string');

        //opcional
        $descricaoNF = $this->dom->createElement('descricaoNF', ' dados teste ');
        $root->appendChild($descricaoNF);
        $descricaoNF->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $tomadorTipo = $this->dom->createElement('tomador_tipo', ' dados teste ');
        $root->appendChild($tomadorTipo);
        $tomadorTipo->setAttribute('xsi:type', 'xsd:int');

        $tomadorCnpj = $this->dom->createElement('tomador_cnpj', ' dados teste ');
        $root->appendChild($tomadorCnpj);
        $tomadorCnpj->setAttribute('xsi:type', 'xsd:string');

        $tomadorEmail = $this->dom->createElement('tomador_email', ' dados teste ');
        $root->appendChild($tomadorEmail);
        $tomadorEmail->setAttribute('xsi:type', 'xsd:string');

        //opcional
        $tomadorIe = $this->dom->createElement('tomador_ie', ' dados teste ');
        $root->appendChild($tomadorIe);
        $tomadorIe->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $tomadorIm = $this->dom->createElement('tomador_im', ' dados teste ');
        $root->appendChild($tomadorIm);
        $tomadorIm->setAttribute('xsi:type', 'xsd:string');

        $tomadorRazao = $this->dom->createElement('tomador_razao', ' dados teste ');
        $root->appendChild($tomadorRazao);
        $tomadorRazao->setAttribute('xsi:type', 'xsd:string');

        //opcional
        $tomadorFantasia = $this->dom->createElement('tomador_fantasia', ' dados teste ');
        $root->appendChild($tomadorFantasia);
        $tomadorFantasia->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $tomadorEndereco = $this->dom->createElement('tomador_endereco', ' dados teste ');
        $root->appendChild($tomadorEndereco);
        $tomadorEndereco->setAttribute('xsi:type', 'xsd:string');

        $tomadorNumero = $this->dom->createElement('tomador_numero', ' dados teste ');
        $root->appendChild($tomadorNumero);
        $tomadorNumero->setAttribute('xsi:type', 'xsd:string');

        //opcional
        $tomadorComplemento = $this->dom->createElement('tomador_complemento', ' dados teste ');
        $root->appendChild($tomadorComplemento);
        $tomadorComplemento->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $tomadorBairro = $this->dom->createElement('tomador_bairro', ' dados teste ');
        $root->appendChild($tomadorBairro);
        $tomadorBairro->setAttribute('xsi:type', 'xsd:string');

        $tomadorCep = $this->dom->createElement('tomador_CEP', ' dados teste ');
        $root->appendChild($tomadorCep);
        $tomadorCep->setAttribute('xsi:type', 'xsd:string');

        $tomadorCodCidade = $this->dom->createElement('tomador_cod_cidade', ' dados teste ');
        $root->appendChild($tomadorCodCidade);
        $tomadorCodCidade->setAttribute('xsi:type', 'xsd:string');

        //opcional
        $tomadorFone = $this->dom->createElement('tomador_fone', ' dados teste ');
        $root->appendChild($tomadorFone);
        $tomadorFone->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $rpsNum = $this->dom->createElement('rps_num', ' dados teste ');
        $root->appendChild($rpsNum);
        $rpsNum->setAttribute('xsi:type', 'xsd:int');

        $rpsSerie = $this->dom->createElement('rps_serie', ' dados teste ');
        $root->appendChild($rpsSerie);
        $rpsSerie->setAttribute('xsi:type', 'xsd:string');

        $rpsDia = $this->dom->createElement('rps_dia', ' dados teste ');
        $root->appendChild($rpsDia);
        $rpsDia->setAttribute('xsi:type', 'xsd:int');

        $rpsMes = $this->dom->createElement('rps_mes', ' dados teste ');
        $root->appendChild($rpsMes);
        $rpsMes->setAttribute('xsi:type', 'xsd:int');

        $rpsAno = $this->dom->createElement('rps_ano', ' dados teste ');
        $root->appendChild($rpsAno);
        $rpsAno->setAttribute('xsi:type', 'xsd:int');

        //opcional
        $outroMunicipio = $this->dom->createElement('outro_municipio', ' dados teste ');
        $root->appendChild($outroMunicipio);
        $outroMunicipio->setAttribute('xsi:type', 'xsd:int');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        $codOutroMunicipio = $this->dom->createElement('cod_outro_municipio', ' dados teste ');
        $root->appendChild($codOutroMunicipio); // Não sei o que é
        $codOutroMunicipio->setAttribute('xsi:type', 'xsd:int');

        //retencao_iss, cofins, inss, irrf, cssl opcionais
        $retencaoIss = $this->dom->createElement('retencao_iss', ' dados teste ');
        $root->appendChild($retencaoIss);
        $retencaoIss->setAttribute('xsi:type', 'xsd:string');

        $pis = $this->dom->createElement('pis', ' dados teste ');
        $root->appendChild($pis);
        $pis->setAttribute('xsi:type', 'xsd:string');

        $cofins = $this->dom->createElement('cofins', ' dados teste ');
        $root->appendChild($cofins);
        $cofins->setAttribute('xsi:type', 'xsd:string');

        $inss = $this->dom->createElement('inss', ' dados teste ');
        $root->appendChild($inss);
        $inss->setAttribute('xsi:type', 'xsd:string');

        $irrf = $this->dom->createElement('irrf', ' dados teste ');
        $root->appendChild($irrf);
        $irrf->setAttribute('xsi:type', 'xsd:string');

        $csll = $this->dom->createElement('csll', ' dados teste ');
        $root->appendChild($csll);
        $csll->setAttribute('xsi:type', 'xsd:string');
        // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        //Dados opcionais abaixo
        $tipoObra = $this->dom->createElement('tipo_obra', ' dados teste ');
        $root->appendChild($tipoObra);
        $tipoObra->setAttribute('xsi:type', 'xsd:int');

        $diaEmissao = $this->dom->createElement('dia_emissao', ' dados teste ');
        $root->appendChild($diaEmissao);
        $diaEmissao->setAttribute('xsi:type', 'xsd:int');

        $mesEmissao = $this->dom->createElement('mes_emissao', ' dados teste ');
        $root->appendChild($mesEmissao);
        $mesEmissao->setAttribute('xsi:type', 'xsd:int');

        $anoEmissao = $this->dom->createElement('ano_emissao', ' dados teste ');
        $root->appendChild($anoEmissao);
        $anoEmissao->setAttribute('xsi:type', 'xsd:int');

        $this->xml = $this->dom->saveXML();

        $pathXSD = '../schemes/GerarNota.xsd';
        
        $ok = Make::checkXML($this->dom, realpath($pathXSD));

        if ($ok) {
            return $this->envelopXML($this->xml, $method);
        }
    }

    public function cancelarNota(){

        $method = 'CancelarNota';

        $soapAction = 'urn:sigiss_ws#CancelarNota';
        
        $root = $this->dom->createElement('DadosCancelaNota');
        $this->dom->appendChild($root);
        $root->setAttribute('xsi:type', 'urn:tcDadosCancelaNota');

        $ccm = $this->dom->createElement('ccm', '1');
        $root->appendChild($ccm);
        $ccm->setAttribute('xsi:type', 'xsd:int');

        $cnpj = $this->dom->createElement('cnpj', ' dados teste ');
        $root->appendChild($cnpj);
        $cnpj->setAttribute('xsi:type', 'xsd:string');

        $senha = $this->dom->createElement('senha', ' dados teste ');
        $root->appendChild($senha);
        $senha->setAttribute('xsi:type', 'xsd:string');

        $nota = $this->dom->createElement('nota', '1');
        $root->appendChild($nota);
        $nota->setAttribute('xsi:type', 'xsd:int');

        $motivo = $this->dom->createElement('motivo', ' dados teste ');
        $root->appendChild($motivo);
        $motivo->setAttribute('xsi:type', 'xsd:string');

        $email = $this->dom->createElement('email', ' dados teste ');
        $root->appendChild($email);
        $email->setAttribute('xsi:type', 'xsd:string');

        $this->xml = $this->dom->saveXML();

        $pathXSD = '../schemes/CancelarNota.xsd';
        
        $ok = Make::checkXML($this->dom, realpath($pathXSD));

        if ($ok) {
            return $this->envelopXML($this->xml, $method);
        }
    }

    public function consultarNotaValida(){

        $method = 'ConsultarNotaValida';

        $soapAction = 'urn:sigiss_ws#ConsultarNotaValida';
        
        $root = $this->dom->createElement('DadosConsultaNota');
        $this->dom->appendChild($root);
        $root->setAttribute('xsi:type', 'urn:tcDadosConsultaNota');

        $nota = $this->dom->createElement('nota', ' dados teste ');
        $root->appendChild($nota);
        $nota->setAttribute('xsi:type', 'xsd:int');

        $serie = $this->dom->createElement('serie', ' dados teste ');
        $root->appendChild($serie);
        $serie->setAttribute('xsi:type', 'xsd:string');

        $valor = $this->dom->createElement('valor', ' dados teste ');
        $root->appendChild($valor);
        $valor->setAttribute('xsi:type', 'xsd:string');

        $prestadorCcm = $this->dom->createElement('prestador_ccm', ' dados teste ');
        $root->appendChild($prestadorCcm);
        $prestadorCcm->setAttribute('xsi:type', 'xsd:int');

        $prestadorCnpj = $this->dom->createElement('prestador_cnpj', ' dados teste ');
        $root->appendChild($prestadorCnpj);
        $prestadorCnpj->setAttribute('xsi:type', 'xsd:string');

        $autenticidade = $this->dom->createElement('autenticidade', ' dados teste ');
        $root->appendChild($autenticidade);
        $autenticidade->setAttribute('xsi:type', 'xsd:string');

        $this->xml = $this->dom->saveXML();

        $pathXSD = '../schemes/ConsultarNotaValida.xsd';
        
        $ok = Make::checkXML($this->dom, realpath($pathXSD));

        if ($ok) {
            return $this->envelopXML($this->xml, $method);
        }
    }

    public function consultarNotaPrestador(){

        $method = 'ConsultarNotaPrestador';

        $soapAction = 'urn:sigiss_ws#ConsultarNotaPrestador';

        $root = $this->dom->createElement('DadosPrestador');
        $this->dom->appendChild($root);
        $root->setAttribute('xsi:type', 'urn:tcDadosPrestador');

        $ccm = $this->dom->createElement('ccm', ' dados teste ');
        $root->appendChild($ccm);
        $ccm->setAttribute('xsi:type', 'xsd:int');

        $cnpj = $this->dom->createElement('cnpj', ' dados teste ');
        $root->appendChild($cnpj);
        $cnpj->setAttribute('xsi:type', 'xsd:string');

        $senha = $this->dom->createElement('senha', ' dados teste ');
        $root->appendChild($senha);
        $senha->setAttribute('xsi:type', 'xsd:string');

        $crc = $this->dom->createElement('crc', ' dados teste ');
        $root->appendChild($crc);
        $crc->setAttribute('xsi:type', 'xsd:int');

        $crcEstado = $this->dom->createElement('crc_estado', ' dados teste ');
        $root->appendChild($crcEstado);
        $crcEstado->setAttribute('xsi:type', 'xsd:string');

        $aliquotaSimples = $this->dom->createElement('aliquota_simples', ' dados teste ');
        $root->appendChild($aliquotaSimples);
        $aliquotaSimples->setAttribute('xsi:type', 'xsd:string');

        $root = $this->dom->createElement('Nota');
        $this->dom->appendChild($root);
        $root->setAttribute('xsi:type', 'urn:tcNotaSerie');

        $nota = $this->dom->createElement('nota', ' dados teste ');
        $root->appendChild($nota);
        $nota->setAttribute('xsi:type', 'xsd:int');

        $serie = $this->dom->createElement('serie', ' dados teste ');
        $root->appendChild($serie);
        $serie->setAttribute('xsi:type', 'xsd:string');

        $this->xml = $this->dom->saveXML();

        $pathXSD = '../schemes/ConsultarNotaPrestador.xsd';

        $ok = Make::checkXML($this->dom, realpath($pathXSD));

        if ($ok) {
            return $this->envelopXML($this->xml, $method);
        }
    }

    public function geraTeste(){

        $method = 'gerateste';

        $soapAction = 'urn:sigiss_ws#gerateste';

        $root = $this->dom->createElement('dado', '1');
        $this->dom->appendChild($root);
        $root->setAttribute('xsi:type', 'xsd:int');
        
        $this->xml = $this->dom->saveXML();

        $pathXSD = '../schemes/gerateste.xsd';

        $ok = Make::checkXML($this->dom, realpath($pathXSD));

        if ($ok) {
            return $this->envelopXML($this->xml, $method);
        }
    }

    public function envelopXML($xml, $method){

        $xml = trim(preg_replace("/<\?xml.*?\?>/", "", $xml));

        $envelope =
        '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sigiss_ws">
        <soapenv:Header/>
            <soapenv:Body>
                <urn:' . $method . ' soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">'
                    . $xml .
                '</urn:' . $method .'>
            </soapenv:Body>
        </soapenv:Envelope>';
        echo $envelope;
        return $envelope;
    }

    public function checkXML($xml, $pathXSD){

        $ok = false;

        try{

            $this->dom->schemaValidate($pathXSD);

            $ok = true;

        } catch (\ErrorException $e){

            $this->errorMessage = $e->getMessage();

            var_dump($this->errorMessage);
        }

        return $ok;
    }
}