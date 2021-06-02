<?php

namespace NFePHP\NFSe\SIGISS\Factories;

use NFePHP\NFSe\SIGISS\Make;
use NFePHP\Common\Strings;

class Parser
{

    protected $structure;

    protected $make;

    protected $loteRps;

    protected $tomador;

    protected $std;

    public function __construct($version = '3.0.1')
    {

        $ver = str_replace('.', '', $version);

        $path = realpath(__DIR__ . "/../../storage/txtstructure.json");

        $this->std = new \stdClass();

        $this->DescricaoRps = new \stdClass();

        $this->DescricaoRps->tomador = new \stdClass();

        $this->DescricaoRps->prestador = new \stdClass();

        $this->structure = json_decode(file_get_contents($path), true);

        $this->version = $version;

        $this->make = new Make();
    }

    public function toXml($nota)
    {

        $this->array2xml($nota);

        if ($this->make->monta()) {

            return $this->make->getXML();
        }

        return null;
    }

    protected function array2xml($nota)
    {

        foreach ($nota as $lin) {

            $fields = explode('|', $lin);

            if (empty($fields)) {
                continue;
            }

            $metodo = strtolower(str_replace(' ', '', $fields[0])) . 'Entity';

            if (method_exists(__CLASS__, $metodo)) {

                $struct = $this->structure[strtoupper($fields[0])];

                $std = $this->fieldsToStd($fields, $struct);

                $this->$metodo($std);
            }
        }
    }

    protected function fieldsToStd($dfls, $struct)
    {

        $sfls = explode('|', $struct);

        $len = count($sfls) - 1;

        $std = new \stdClass();

        for ($i = 1; $i < $len; $i++) {

            $name = $sfls[$i];

            if (isset($dfls[$i]))
                $data = $dfls[$i];
            else
                $data = '';

            if (!empty($name)) {

                $std->$name = Strings::replaceSpecialsChars($data);
            }
        }

        return $std;
    }

    private function aEntity($std)
    {
        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);
    }

    private function bEntity($std)
    {
        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);
    }

    private function cEntity($std)
    {
        $this->DescricaoRps->prestador = (object) array_merge((array) $this->DescricaoRps->prestador, (array) $std);
    }

    private function eEntity($std)
    {
        $this->DescricaoRps->tomador = (object) array_merge((array) $this->DescricaoRps->tomador, (array) $std);
    }

    private function e02Entity($std)
    {
        $this->DescricaoRps->tomador = (object) array_merge((array) $this->DescricaoRps->tomador, (array) $std);
    }

    private function fEntity($std)
    {
        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);
    }

    private function hEntity($std)
    {
        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);
    }

    private function h01Entity($std)
    {
        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);
    }

    private function mEntity($std)
    {
        $std->Aliquota = substr($std->Aliquota, -1);

        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);
    }

    private function nEntity($std)
    {
        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);
    }

    private function wEntity($std)
    {
        $this->DescricaoRps = (object) array_merge((array) $this->DescricaoRps, (array) $std);

        if ($this->DescricaoRps->ValorServicos || $this->DescricaoRps->ValorLiquidoNfse || $this->DescricaoRps->BaseCalculo) {

            $this->fixValues();
        }

        $this->fixDate();

        $this->outroMunicipio();

        $this->make->buildDescricaoRps($this->DescricaoRps);
    }

    public function fixValues()
    {
        if ($this->DescricaoRps->ValorServicos) {

            $this->DescricaoRps->ValorServicos = str_replace('.', ',', $this->DescricaoRps->ValorServicos);
        }

        if ($this->DescricaoRps->ValorLiquidoNfse) {

            $this->DescricaoRps->ValorLiquidoNfse =  str_replace('.', ',', $this->DescricaoRps->ValorLiquidoNfse);
        }

        if ($this->DescricaoRps->BaseCalculo) {

            $this->DescricaoRps->BaseCalculo =  str_replace('.', ',', $this->DescricaoRps->BaseCalculo);
        }
    }

    public function fixDate()
    {
        $this->DescricaoRps->day = substr($this->DescricaoRps->DataEmissao, 8, 2);
        $this->DescricaoRps->month = substr($this->DescricaoRps->DataEmissao, 5, 2);
        $this->DescricaoRps->year = substr($this->DescricaoRps->DataEmissao, 0, 4);
    }

    public function outroMunicipio()
    {
        if ($this->DescricaoRps->tomador->MunicipioFora) {
            $this->DescricaoRps->tomador->OutroMunicipio = 1;
        }
    }
}
