<?php

class Solicitacao{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    protected $identidade = null;

    public function __construct($identidade){
        $this->identidade = $identidade;
    }
}

?>