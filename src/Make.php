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

        $root = $this->dom->createElement('DescricaoRps');
        $this->dom->appendChild($root);

        $this->dom->addChild(
            $root,                          // pai    
            "ccm",                          // nome
            $std->NumeroLote,               // valor
            true,                           // se é obrigatorio
            "CCM do prestador de serviço"   // descrição se der catch
        );

        $this->dom->addChild(
            $root,
            "cnpj",
            $std->prestador->Cnpj,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "senha",
            $std->NumeroLote,
            true,
            "Senha do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc",
            $std->NumeroLote,
            true,
            "CRC do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc_estado",
            $std->NumeroLote,
            true,
            "CRC estado do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "aliquota_simples",
            $std->Aliquota,
            true,
            "Alíquota do simples nacional"
        );

        $this->dom->addChild(
            $root,
            "id_sis_legado",
            $std->NumeroLote,
            true,
            "Código da nota no sistema legado do contribuinte."
        );

        $this->dom->addChild(
            $root,
            "servico",
            $std->Discriminacao,
            true,
            "Código do serviço utilizado na emissão da nota fiscal da lei 116/03."
        );

        $this->dom->addChild(
            $root,
            "situacao",
            $std->NumeroLote,
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
            $std->ValorServicos,
            true,
            "Valor da nota fiscal. Ex:R$100,50 ➔ 100,5 Não utilize ponto (“.”)"
        );

        $this->dom->addChild(
            $root,
            "base",
            $std->BaseCalculo,
            true,
            "Valor da base de calculo. Ex:R$100,50➔ 100,5 Não utilize ponto (“.”)"
        );

        $this->dom->addChild(
            $root,
            "descricaoNF",
            $std->Discriminacao,
            true,
            "Descrição do Serviço Prestado"
        );

        $this->dom->addChild(
            $root,
            "tomador_tipo",
            $std->NumeroLote,
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
            $std->tomador->Cnpj,
            true,
            "CPF ou CNPJ do tomador da nota  fiscal eletrônica"
        );

        $this->dom->addChild(
            $root,
            "tomador_email",
            $std->tomador->Email,
            true,
            "Email do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_ie",
            $std->NumeroLote,
            true,
            "Inscrição Estadual do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_im",
            $std->tomador->InscricaoMunicipal,
            true,
            "Inscrição municipal do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_razao",
            $std->tomador->RazaoSocial,
            true,
            "Razão Social do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_fantasia",
            $std->tomador->NomeFantasia,
            true,
            "Nome Fantasia do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_endereco",
            $std->tomador->Endereco,
            true,
            "Endereço do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_numero",
            $std->tomador->Numero,
            true,
            "Número do endereço do tomador da nota"
        );

        $this->dom->addChild(
            $root,
            "tomador_complemento",
            $std->tomador->Complemento,
            true,
            "Complemento do endereço do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_bairro",
            $std->tomador->Bairro,
            true,
            "Bairro do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_CEP",
            $std->tomador->Cep,
            true,
            "CEP do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_cod_cidade",
            $std->tomador->CodigoMunicipio,
            true,
            "Código da cidade do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_fone",
            $std->tomador->Telefone,
            true,
            "Telefone do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_ramal",
            '',
            true,
            "Ramal do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "tomador_fax",
            '',
            true,
            "Fax do tomador da nota."
        );

        $this->dom->addChild(
            $root,
            "rps_num",
            $std->NumeroLote,
            true,
            "Número do recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_serie",
            $std->Serie,
            true,
            "Série do recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_dia",
            $std->day,
            true,
            "Dia em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_mes",
            $std->month,
            true,
            "Mês em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "rps_ano",
            $std->year,
            true,
            "Ano em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $root,
            "outro_municipio",
            $std->tomador->OutroMunicipio,
            true,
            "Indica se o serviço foi prestado em outro município "
        );

        $this->dom->addChild(
            $root,
            "cod_outro_municipio",
            $std->tomador->MunicipioFora,
            true,
            "Código do município em que foi prestado o serviço "
        );

        $this->dom->addChild(
            $root,
            "retencao_iss",
            $std->ValorIssRetido,
            true,
            "Valor da retenção de ISS"
        );

        $this->dom->addChild(
            $root,
            "pis",
            $std->ValorPis,
            true,
            "Valor do PIS"
        );

        $this->dom->addChild(
            $root,
            "cofins",
            $std->ValorCofins,
            true,
            "Valor do COFINS"
        );

        $this->dom->addChild(
            $root,
            "inss",
            $std->ValorInss,
            true,
            "Valor do INSS"
        );

        $this->dom->addChild(
            $root,
            "irrf",
            $std->ValorIr,
            true,
            "Valor do IRRF"
        );

        $this->dom->addChild(
            $root,
            "csll",
            $std->ValorCsll,
            true,
            "Valor do CSLL"
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
            "ccm",
            $std->NumeroLote,
            true,
            "CCM do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "cnpj",
            $std->NumeroLote,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "senha",
            $std->NumeroLote,
            true,
            "Senha do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "nota",
            $std->NumeroLote,
            true,
            "Número da NFS-e que deseja que seja cancelada"
        );

        $this->dom->addChild(
            $root,
            "motivo",
            $std->NumeroLote,
            true,
            "Motivo do cancelamento da Nota"
        );

        $this->dom->addChild(
            $root,
            "email",
            $std->NumeroLote,
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
            "ccm",
            $std->NumeroLote,
            true,
            "CCM do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "cnpj",
            $std->NumeroLote,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "senha",
            $std->NumeroLote,
            true,
            "Senha do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc",
            $std->NumeroLote,
            true,
            "CRC do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc_estado",
            $std->NumeroLote,
            true,
            "CRC estado do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "aliquota_simples",
            $std->NumeroLote,
            true,
            "Alíquota do simples nacional"
        );

        $root2 = $this->dom->createElement('Nota');
        $this->dom->appendChild($root2);

        $this->dom->addChild(
            $root2,
            "nota",
            $std->NumeroLote,
            true,
            "Numero da nota ?"
        );

        $this->dom->addChild(
            $root2,
            "serie",
            $std->NumeroLote,
            true,
            "Serie da nota ?"
        );

        $this->xml = $this->dom->saveXML();

        return $this->xml;
    }

    public function geraTeste()
    {
        $xml = '<dado>1</dado>';

        return $xml;
    }
}
