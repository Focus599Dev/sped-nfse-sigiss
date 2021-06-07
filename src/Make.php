<?php

namespace NFePHP\NFSe\SIGISS;

use NFePHP\Common\DOMImproved as Dom;

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

        $this->DescricaoRps = $this->dom->createElement('DescricaoRps');
    }

    public function getXML()
    {
        if (empty($this->xml)) {

            $this->monta();
        }

        return $this->xml;
    }

    public function monta()
    {
        $this->dom->appendChild($this->DescricaoRps);

        $this->xml = $this->dom->saveXML();

        return $this->xml;
    }

    public function buildDescricaoRps($std)
    {

        $this->dom->addChild(
            $this->DescricaoRps,            // pai    
            "ccm",                          // nome
            $std->CCMPrestador,               // valor
            true,                           // se é obrigatorio
            "CCM do prestador de serviço"   // descrição se der catch
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "cnpj",
            $std->prestador->Cnpj,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "senha",
            $std->NumeroLote,
            true,
            "Senha do prestador de serviço"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "crc",
            "",
            true,
            "CRC do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "crc_estado",
            "",
            true,
            "CRC estado do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "aliquota_simples",
            $std->Aliquota,
            true,
            "Alíquota do simples nacional"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "id_sis_legado",
            "",
            true,
            "Código da nota no sistema legado do contribuinte."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "servico",
            $std->CodServico,
            true,
            "Código do serviço utilizado na emissão da nota fiscal da lei 116/03."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "situacao",
            $std->SituacaoNFSE,
            true,
            "Situação da nota fiscal eletrônica:  
                tp – Tributada no prestador;
                tt – Tributada no tomador;
                is – Isenta;
                im – Imune;
                nt – Não tributada."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "valor",
            $std->ValorServicos,
            true,
            "Valor da nota fiscal. Ex:R$100,50 ➔ 100,5 Não utilize ponto (“.”)"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "base",
            $std->BaseCalculo,
            true,
            "Valor da base de calculo. Ex:R$100,50➔ 100,5 Não utilize ponto (“.”)"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "descricaoNF",
            $std->Discriminacao,
            true,
            "Descrição do Serviço Prestado"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_tipo",
            $std->tomador->TomadorTipo,
            true,
            "Tipo do tomador que se quer escriturar:
                1 – PFNI;
                2 – Pessoa Física;
                3 – Jurídica do Município;
                4 – Jurídica de Fora;
                5 – Jurídica de Fora do País"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_cnpj",
            $std->tomador->Cnpj,
            true,
            "CPF ou CNPJ do tomador da nota  fiscal eletrônica"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_email",
            $std->tomador->Email,
            true,
            "Email do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_ie",
            $std->tomador->InscEstadualTomador,
            true,
            "Inscrição Estadual do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_im",
            $std->tomador->InscricaoMunicipal,
            true,
            "Inscrição municipal do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_razao",
            $std->tomador->RazaoSocial,
            true,
            "Razão Social do tomador da nota"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_fantasia",
            $std->tomador->NomeFantasia,
            true,
            "Nome Fantasia do tomador da nota"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_endereco",
            $std->tomador->Endereco,
            true,
            "Endereço do tomador da nota"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_numero",
            $std->tomador->Numero,
            true,
            "Número do endereço do tomador da nota"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_complemento",
            $std->tomador->Complemento,
            true,
            "Complemento do endereço do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_bairro",
            $std->tomador->Bairro,
            true,
            "Bairro do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_CEP",
            $std->tomador->Cep,
            true,
            "CEP do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_cod_cidade",
            $std->tomador->CodigoMunicipio,
            true,
            "Código da cidade do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_fone",
            $std->tomador->Telefone,
            true,
            "Telefone do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_ramal",
            '',
            true,
            "Ramal do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "tomador_fax",
            '',
            true,
            "Fax do tomador da nota."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "rps_num",
            $std->NumeroLote,
            true,
            "Número do recibo provisório de serviços."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "rps_serie",
            $std->Serie,
            true,
            "Série do recibo provisório de serviços."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "rps_dia",
            $std->day,
            true,
            "Dia em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "rps_mes",
            $std->month,
            true,
            "Mês em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "rps_ano",
            $std->year,
            true,
            "Ano em que foi emitido o recibo provisório de serviços."
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "outro_municipio",
            $std->tomador->OutroMunicipio,
            true,
            "Indica se o serviço foi prestado em outro município "
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "cod_outro_municipio",
            $std->tomador->MunicipioFora,
            true,
            "Código do município em que foi prestado o serviço "
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "retencao_iss",
            $std->ValorIssRetido,
            true,
            "Valor da retenção de ISS"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "pis",
            $std->ValorPis,
            true,
            "Valor do PIS"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "cofins",
            $std->ValorCofins,
            true,
            "Valor do COFINS"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "inss",
            $std->ValorInss,
            true,
            "Valor do INSS"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "irrf",
            $std->ValorIr,
            true,
            "Valor do IRRF"
        );

        $this->dom->addChild(
            $this->DescricaoRps,
            "csll",
            $std->ValorCsll,
            true,
            "Valor do CSLL"
        );

        $this->xml = $this->dom->saveXML();

        return $this->xml;
    }

    public function cancelarNota($std, $password)
    {
        $root = $this->dom->createElement('DadosCancelaNota');
        $this->dom->appendChild($root);

        $this->dom->addChild(
            $root,
            "ccm",
            $std->ccm,
            true,
            "CCM do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "cnpj",
            $std->cnpj,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "senha",
            $password,
            true,
            "Senha do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "nota",
            $std->Numero,
            true,
            "Número da NFS-e que deseja que seja cancelada"
        );

        $this->dom->addChild(
            $root,
            "motivo",
            $std->observacao,
            true,
            "Motivo do cancelamento da Nota"
        );

        $this->dom->addChild(
            $root,
            "email",
            $std->email,
            true,
            "Email para onde a notificação da nota cancelada será enviada"
        );

        $this->xml = $this->dom->saveXML();

        return $this->xml;
    }

    public function consultarNotaP($std, $attributes)
    {
        $root = $this->dom->createElement('DadosConsultaNota');
        $this->dom->appendChild($root);

        $this->dom->addChild(
            $root,
            "nota",
            $attributes['nfml_nnf'],
            true,
            "Número da NFS-e que deseja consultar."
        );

        $this->dom->addChild(
            $root,
            "serie",
            $attributes['nfml_serie'],
            true,
            "Série presente na Nota fiscal eletrônica."
        );

        $this->dom->addChild(
            $root,
            "valor",
            $attributes['nfml_total'],
            true,
            "Valor da nota fiscal. Ex:R$100,50 ➔ 100,5 - Não utilize ponto (“.”)"
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
            $std->cnpj,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "autenticidade",
            $attributes['nfml_code_verication'],
            true,
            "(hash). Autenticidade presente na Nota fiscal eletrônica"
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
            $std->ccm,
            true,
            "CCM do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "cnpj",
            $std->cnpj,
            true,
            "CNPJ do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "senha",
            $std->senha,
            true,
            "Senha do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc",
            '',
            true,
            "CRC do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "crc_estado",
            '',
            true,
            "CRC estado do contador do prestador de serviço"
        );

        $this->dom->addChild(
            $root,
            "aliquota_simples",
            $std->aliquota_simples,
            true,
            "Alíquota do simples nacional"
        );

        $root2 = $this->dom->createElement('Nota');
        $this->dom->appendChild($root2);

        $this->dom->addChild(
            $root2,
            "nota",
            $std->rps_num,
            true,
            "Numero da nota ?"
        );

        $this->dom->addChild(
            $root2,
            "serie",
            $std->rps_serie,
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
