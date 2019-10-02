<?php

namespace NFePHP\NFSe\SIGISS\Factories;

use NFePHP\NFSe\GINFE\Make;
use NFePHP\Common\Strings;
use stdclass;

class Parser{

    public function __construct($version = '3.0.1'){

        $ver = str_replace('.', '', $version);

        $path = realpath(__DIR__ . "/../../storage/txtstructure$ver.json");

        $this->version = $version;

        $this->make = new Make();
    }
}