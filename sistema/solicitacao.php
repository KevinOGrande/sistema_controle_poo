<?php
class Solicitacao{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    protected $identidade = null;
    private $pedido = null;
    private $status = null;
    private $descricao = null;

    public function __construct($identidade){
        $this->identidade = $identidade;
    }
    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }
    public function AddSolicitacao(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO solicitacao(matricula,pedido,status_pedido,descricao)VALUES(:matricula,:pedido,:status_pedido,:descricao)";
            $add = $corn->prepare($sql);
            $add->bindValue(":matricula",$this->identidade);
            $add->bindValue(":pedido",$this->pedido);
            $add->bindValue(":status_pedido",$this->status);
            $add->bindValue(":descricao",$this->descricao);
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
    public function MudarStatus(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE solicitacao SET status_pedido = :pedido WHERE id= :id";
            $atualiza = $corn->prepare($sql);
            $atualiza->bindValue(":id",$this->identidade);
            $atualiza->bindValue(":pedido",$this->status);
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
}

?>