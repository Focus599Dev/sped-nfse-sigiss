<?php

namespace NFePHP\NFSe\SIGISS;

use NFePHP\Common\DOMImproved as Dom;
use NFePHP\Common\Strings;
use stdClass;
use RuntimeException;
use DOMElement;
use DateTime;

class Make
{

    public $dom;

    public $xml;

    public $versaoNFSE = '1.00';

    public function __construct()
    {

        $this->dom = new Dom();

        $this->dom->preserveWhiteSpace = false;

        $this->dom->formatOutput = false;
    }

    public function getXML($std)
    {

        if (empty($this->xml)) {

            $this->gerarNota($std);
        }

        return $this->xml;
    }

    public function gerarNota($std)
    {
        var_dump($std);
        $root = $this->dom->createElement('DescricaoRps');
        $this->dom->appendChild($root);

        $this->dom->addChild(
            $root,                          // pai    
            "ccm",                          // nome
            $std->Numero,                      // valor
            true,                           // se é obrigatorio
            "CCM do prestador de serviço"   // descrição se der catch
        );

        $this->dom->addChild(
            $root,
            "cnpj",
            $std->ccm,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "senha",
            $std->ccm,
            true,
            "Senha do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc",
            $std->ccm,
            true,
            "CRC do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc_estado",
            $std->ccm,
            true,
            "CRC estado do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "aliquota_simples",
            $std->ccm,
            true,
            "Alíquota do simples nacional"
        );

        $this->dom->addChild(
            $root,
            "id_sis_legado",
            $std->ccm,
            true,
            "Código da nota no sistema legado do contribuinte."
        );

        $this->dom->addChild(
            $root,
            "servico",
            $std->ccm,
            true,
            "Código do serviço utilizado na  emissão da nota fiscal da lei 116/03."
        );

        $this->dom->addChild(
            $root,
            "situacao",
            $std->ccm,
            true,
            "Situação da nota fiscal eletrônica:  
                tp – Tributada no prestador;
                tt – Tributada no tomador;
                is – Isenta;
                im – Imune;
                nt – Não tributada."
        );

        $this->dom->addChild(
            $root,
            "valor",
            $std->ccm,
            true,
            "Valor da nota fiscal. Ex:R$100,50➔ 100,5 Não utilize ponto (“.”)"
        );

        $this->dom->addChild(
            $root,
            "base",
            $std->ccm,
            true,
            "Valor da base de calculo. Ex:R$100,50➔ 100,5 Não utilize ponto (“.”)"
        );

        $this->dom->addChild(
            $root,
            "descricaoNF",
            $std->ccm,
            true,
            "Descrição do Serviço Prestado"
        );

        $this->dom->addChild(
            $root,
            "tomador_tipo",
            $std->ccm,
            true,
            "Tipo do tomador que se quer escriturar:
                1 – PFNI;
                2 – Pessoa Física;
                3 – Jurídica do Município;
                4 – Jurídica de Fora;
                5 – Jurídica de Fora do País"
        );

        $this->dom->addChild(
            $root,
            "tomador_cnpj",
            $std->ccm,
            true,
            "CPF ou CNPJ do tomador da nota  fiscal eletrônica"
        );

        $this->dom->addChild(
            $root,
            "tomador_email",
            $std->ccm,
            true,
            "Email do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_ie",
            $std->ccm,
            true,
            "Inscrição Estadual do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_im",
            $std->ccm,
            true,
            "Inscrição municipal do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_razao",
            $std->ccm,
            true,
            "Razão Social do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_fantasia",
            $std->ccm,
            true,
            "Nome Fantasia do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_endereco",
            $std->ccm,
            true,
            "Endereço do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_numero",
            $std->ccm,
            true,
            "Número do endereço do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_complemento ",
            $std->ccm,
            true,
            "Complemento do endereço do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_bairro",
            $std->ccm,
            true,
            "Bairro do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_CEP",
            $std->ccm,
            true,
            "CEP do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_cod_cidade",
            $std->ccm,
            true,
            "Código da cidade do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_fone",
            $std->ccm,
            true,
            "Telefone do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_ramal",
            $std->ccm,
            true,
            "Ramal do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_fax",
            $std->ccm,
            true,
            "Fax do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "rps_num",
            $std->ccm,
            true,
            "Número do recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_serie",
            $std->ccm,
            true,
            "Série do recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_dia",
            $std->ccm,
            true,
            "Dia em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_mes",
            $std->ccm,
            true,
            "Mês em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_ano",
            $std->ccm,
            true,
            "Ano em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "outro_municipio",
            $std->ccm,
            true,
            "Indica se o serviço foi prestado em outro município "
        );

        $this->dom->addChild(
            $root,
            "cod_outro_municipio",
            $std->ccm,
            true,
            "Código do município em que foi prestado o serviço "
        );

        $this->dom->addChild(
            $root,
            "retencao_iss",
            $std->ccm,
            true,
            "Valor da retenção de ISS"
        );

        $this->dom->addChild(
            $root,
            "pis",
            $std->ccm,
            true,
            "Valor do PIS"
        );

        $this->dom->addChild(
            $root,
            "cofins",
            $std->ccm,
            true,
            "Valor do COFINS"
        );

        $this->dom->addChild(
            $root,
            "inss",
            $std->ccm,
            true,
            "Valor do INSS"
        );

        $this->dom->addChild(
            $root,
            "irrf",
            $std->ccm,
            true,
            "Valor do IRRF"
        );

        $this->dom->addChild(
            $root,
            "csll",
            $std->ccm,
            true,
            "Valor do CSLL"
        );

        $this->dom->addChild(
            $root,
            "tipo_obra",
            $std->ccm,
            false,
            "Tipo de Obra"
        );

        $this->dom->addChild(
            $root,
            "dia_emissao",
            $std->ccm,
            false,
            "Dia da emissão"
        );

        $this->dom->addChild(
            $root,
            "mes_emissao",
            $std->ccm,
            false,
            "Mês da emissão"
        );

        $this->dom->addChild(
            $root,
            "ano_emissao",
            $std->ccm,
            false,
            "Ano da emissão"
        );

        $this->xml = $this->dom->saveXML();

        return $this->xml;
    }

    public function cancelarNota($std)
    {

        $root = $this->dom->createElement('DadosCancelaNota');
        $this->dom->appendChild($root);

        $this->dom->addChild(
            $root,
            "nota",
            $std->ccm,
            true,
            "Número da NFS-e que deseja que seja cancelada"
        );

        $this->dom->addChild(
            $root,
            "motivo",
            $std->ccm,
            true,
            "Motivo do cancelamento da Nota"
        );

        $this->dom->addChild(
            $root,
            "email",
            $std->ccm,
            true,
            "Email para onde a notificação da nota cancelada será enviada"
        );

        $this->xml = $this->dom->saveXML();

        return $this->xml;
    }

    public function consultarNota($std)
    {

        $root = $this->dom->createElement('DadosPrestador');
        $this->dom->appendChild($root);

        $this->dom->addChild(
            $root,
            "nota",
            $std->ccm,
            true,
            "Número da NFS-e que deseja consultar"
        );

        $this->dom->addChild(
            $root,
            "serie",
            $std->ccm,
            true,
            "Série presente na Nota fiscal eletrônica"
        );

        $this->dom->addChild(
            $root,
            "valor",
            $std->ccm,
            true,
            "Valor da nota fiscal. Ex:R$100,50➔ 100,5 Não utilize ponto (“.”)"
        );

        $this->dom->addChild(
            $root,
            "prestador_ccm",
            $std->ccm,
            true,
            "CCM do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "prestador_cnpj",
            $std->ccm,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "autenticidade",
            $std->ccm,
            true,
            "Autenticidade presente na Nota fiscal eletrônica (hash)"
        );

        $this->xml = $this->dom->saveXML();

        return $this->xml;
    }

    public function geraTeste()
    {
        $xml = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sigiss_ws">
                    <soapenv:Header/>
                    <soapenv:Body>
                       <urn:gerateste soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
                          <dado xsi:type="xsd:int">1</dado>
                       </urn:gerateste>
                    </soapenv:Body>
                </soapenv:Envelope>';

        return $xml;
    }
}
