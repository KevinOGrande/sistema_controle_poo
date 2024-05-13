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
    public function SolicitacaoAluno(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if($lista=$corn->query("SELECT * FROM solicitacao WHERE matricula = $this->identidade")){
                return $lista;
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=null;
        }
    }
    public function Falta($data,$justificativa,$observacao){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $id_random = rand(0,10000);
            $verificacao_id = $corn->query("SELECT id_falta FROM falta WHERE id_falta = '$id_random'");
            if($verificacao_id->fetch(PDO::FETCH_ASSOC)){
                return false;
            }else{
                $sql= "INSERT INTO falta(id_falta,matricula,data_envio,justificativa,observacao)VALUES('$id_random','$this->identidade','$data','$justificativa',:observacao)";
                $add = $corn->prepare($sql);
                $add->bindValue(":observacao",$observacao);
                if($add->execute()){
                    $convercao = strval($id_random);
                    return $convercao;
                }
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
    public function ListaFalta(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if($lista=$corn->query("SELECT * FROM falta WHERE matricula='$this->identidade'")){
                return $lista;
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=null;
        }
    }
}

?>