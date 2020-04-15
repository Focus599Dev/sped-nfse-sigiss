<?php 

namespace NFePHP\NFSe\SIGISS\Soap;

use NFePHP\NFSe\SIGISS\Make;

class Soap{

    public function __construct() {

        $obj = new Make;

        $xml = $obj->gerarNota();

        $soapUrl = "https://barretos.sigiss.com.br/barretos/ws/sigiss_ws.php?wsdl";
        
        $headers = array(
                        "Content-type: text/xml;charset=\"utf-8\"",
                        "Accept: text/xml",
                        "Cache-Control: no-cache",
                        "Pragma: no-cache",
                        "SOAPAction: urn:sigiss_ws#gerateste", 
                        "Content-length: ".strlen($xml),
        );

        $this->curl($headers, $xml, $soapUrl);
    }

    public function curl($headers, $xml, $soapUrl){

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURLOPT_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_SSLVERSION, 4);
        curl_setopt($ch, CURLOPT_URL, $soapUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $response = curl_exec($ch);

        curl_close($ch);

        echo $response;
    }
}