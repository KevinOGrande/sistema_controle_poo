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
    public function AddSolicitacao($pedido,$status,$descricao){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO solicitacao(matricula,pedido,status_pedido,descricao)VALUES(:matricula,:pedido,:status_pedido,:descricao)";
            $add = $corn->prepare($sql);
            $add->bindValue(":matricula",$this->identidade);
            $add->bindValue(":pedido",$pedido);
            $add->bindValue(":status_pedido",$status);
            $add->bindValue(":descricao",$descricao);
            if($add->execute()){
                return true;
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
}

?>