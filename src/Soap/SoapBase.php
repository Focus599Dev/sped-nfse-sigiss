<?php

$wsdl = 'https://barretos.sigiss.com.br/barretos/ws/sigiss_ws.php?wsdl';

$soap = new SoapClient($wsdl);

$method = 'tcDescricaoRps';

$response = $soap->__soapCall($method);

var_dump($response);

?>