<?php
namespace NFePHP\NFSe\SIGISS\Factories;

class Header{
    /**
     * Return header
     * @param string $namespace
     * @param int $cUF
     * @param string $version
     * @return string
     */
    public static function get($version){

        return "<cabecalho "
            . "xmlns=\"http://www.ginfes.com.br/tipos_v03.xsd\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\" versao=\"$version\">"
            . "<versaoDados>$version</versaoDados>"
            . "</cabecalho>";
    }
}