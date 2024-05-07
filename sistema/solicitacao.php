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
    public function ListaSolicitacao(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if($lista=$corn->query("SELECT * FROM solicitacao")){
                return $lista;
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=null;
        }
    }
    public function MudarStatus($status_pedido){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE solicitacao SET status_pedido = :pedido WHERE id= :id";
            $atualiza = $corn->prepare($sql);
            $atualiza->bindValue(":id",$this->identidade);
            $atualiza->bindValue(":pedido",$status_pedido);
            if($atualiza->execute()){
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