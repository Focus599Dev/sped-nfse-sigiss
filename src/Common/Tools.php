<?php

namespace NFePHP\NFSe\SIGISS\Common;

use NFePHP\NFSe\SIGISS\Soap\Soap;
use NFePHP\Common\Validator;
use DOMDocument;
use DOMNode;
use DOMElement;
use SimpleXMLElement;

class Tools
{

    public $soapUrl;

    public $config;

    public $soap;

    public $pathSchemas;

    public $lastRequest = null;

    public $lastResponse = null;

    public function __construct($configJson)
    {
        $this->pathSchemas = realpath(
            __DIR__ . '/../../schemas'
        ) . '/';

        $this->config = json_decode($configJson);

        if ($this->config->tpAmb == '1') {
            $this->soapUrl = 'https://barretos.sigiss.com.br/barretos/ws/sigiss_ws.php?wsdl';
        } else {
            $this->soapUrl = 'https://testebarretos.sigiss.com.br/testebarretos/ws/sigiss_ws.php?wsdl';
        }
    }

    protected function sendRequest($request, $soapUrl)
    {

        $soap = new Soap;

        $response = $soap->send($request, $soapUrl);

        return (string) $response;
    }

    public function envelopXML($xml, $method)
    {

        $xml = trim(preg_replace("/<\?xml.*?\?>/", "", $xml));

        $this->xml =
            '<urn:' . $method . ' soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">'
            . $xml .
            '</urn:' . $method . '>';

        return $this->xml;
    }

    public function envelopSoapXML($xml)
    {
        $this->xml =
            '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:sigiss_ws">
            <soapenv:Header/>
            <soapenv:Body>'
            . $xml .
            '</soapenv:Body>
        </soapenv:Envelope>';

        return $this->xml;
    }

    public function removeStuffs($xml)
    {

        if (preg_match('/<SOAP-ENV:Body>/', $xml)) {

            $tag = '<SOAP-ENV:Body>';
            $xml = substr($xml, (strpos($xml, $tag) + strlen($tag)), strlen($xml));

            $tag = '</SOAP-ENV:Body>';
            $xml = substr($xml, 0, strpos($xml, $tag));
        }

        $xml = preg_replace('/( xmlns:ns1="urn:sigiss_ws")/', '', $xml);

        $xml = preg_replace('/( xsi:nil="true" xsi:type="tns:tcDadosNota")/', '', $xml);

        $xml = preg_replace('/( xsi:type="tns:tcRetornoNota")/', '', $xml);

        $xml = preg_replace('/( xsi:type="xsd:int")/', '', $xml);

        $xml = preg_replace('/( xsi:type="SOAP-ENC:Array")/', '', $xml);

        $xml = preg_replace('/( xsi:type="xsd:string")/', '', $xml);

        $xml = preg_replace('/( SOAP-ENC:arrayType="tns:tcEstruturaDescricaoErros\[.\]")/', '', $xml);

        $xml = preg_replace('/( xsi:type="tns:tcEstruturaDescricaoErros")/', '', $xml);

        $xml = preg_replace('/( xsi:type="xsd:string")/', '', $xml);

        $xml = preg_replace('/( xsi:type="tns:tcDadosNota")/', '', $xml);

        $xml = preg_replace('/(ns1:)/', '', $xml);

        $xml = trim($xml);

        return $xml;
    }

    public function getLastRequest()
    {
        return $this->lastRequest;
    }

    protected function isValid($body, $method)
    {
        $pathschemes = realpath(__DIR__ . '/../../schemas/') . '/';

        $schema = $pathschemes . $method;

        if (!is_file($schema)) {
            return true;
        }

        return Validator::isValid(
            $body,
            $schema
        );
    }

    protected function addPassword($request)
    {

        $dom = new DOMDocument('1.0', 'UTF-8');

        $dom->loadXML($request, LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);

        $node = $dom->getElementsByTagName('senha')->item(0);

        $node->nodeValue = $this->config->password;

        $request = $dom->saveXML();

        return $request;
    }

    protected function getPassword(){
        return $this->config->password;
    }
}
