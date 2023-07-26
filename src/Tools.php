<?php

namespace NFePHP\NFSe\SIGISS;

use NFePHP\NFSe\SIGISS\Common\Tools as ToolsBase;
use NFePHP\Common\Strings;
use NFePHP\NFSe\SIGISS\Make;
use NFePHP\NFSe\SIGISS\Exception\InvalidArgumentException;

class Tools extends ToolsBase
{
    public function enviaRPS($xml)
    {
        $servico = 'GerarNota';

        if (empty($xml)) {
            throw new InvalidArgumentException('$xml');
        }

        $xml = Strings::clearXmlString($xml);

        $request = $this->addPassword($xml);

        $this->lastRequest = htmlspecialchars_decode($request);

        $request = $this->envelopXML($request, $servico);

        $request = $this->envelopSoapXML($request);

        $response = $this->sendRequest($request, $this->soapUrl);

        $response = $this->removeStuffs($response);

        $response = utf8_encode($response);

        return $response;
    }

    public function CancelaNfse($std)
    {
        $make = new Make();

        $password = $this->getPassword();

        $xml = $make->cancelarNota($std, $password);

        $xml = Strings::clearXmlString($xml);

        $servico = 'CancelarNota';

        $request = $this->envelopXML($xml, $servico);

        $request = $this->envelopSoapXML($request);

        $response = $this->sendRequest($request, $this->soapUrl);

        $response = $this->removeStuffs($response);

        $response = utf8_encode($response);

        return $response;
    }

    public function consultaSituacaoLoteRPS($std, $nnf)
    {
        $make = new Make();

        $xml = $make->consultarNota($std, $nnf);

        $xml = Strings::clearXmlString($xml);

        $servico = 'ConsultarNotaPrestador';

        $request = $this->envelopXML($xml, $servico);

        $request = $this->envelopSoapXML($request);

        $this->lastResponse = $this->sendRequest($request, $this->soapUrl);

        $this->lastResponse = $this->removeStuffs($this->lastResponse);

        $this->lastResponse = htmlspecialchars_decode($this->lastResponse);

        return $this->lastResponse;
    }

    
}
