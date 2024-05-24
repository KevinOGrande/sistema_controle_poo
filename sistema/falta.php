<?php
class Falta{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    private $matricula = null;
    private $justificativa = null;
    private $data_envio = null;
    private $observacao = null;

    public function __construct($matricula){
        $this->matricula = $matricula;
    }
    public function __set($atributo,$valor){
        $this->$atributo = $valor;
    }
    public function EnvioFalta(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $id_random = rand(0,10000);
            $verificacao_id = $corn->query("SELECT id_falta FROM falta WHERE id_falta = '$id_random'");
            if($verificacao_id->fetch(PDO::FETCH_ASSOC)){
                do{
                    $id_random = rand(0,10000);
                    $verificacao_id = $corn->query("SELECT id_falta FROM falta WHERE id_falta = '$id_random'");
                }while($verificacao_id->fetch(PDO::FETCH_ASSOC));
            }
            $sql= "INSERT INTO falta(id_falta,matricula,data_envio,justificativa,observacao)VALUES('$id_random','$this->matricula','$this->data_envio','$this->justificativa',:observacao)";
            $add = $corn->prepare($sql);
            $add->bindValue(":observacao",$this->observacao);
            if($add->execute()){
                $convercao = strval($id_random);
                return $convercao;
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
            if($lista=$corn->query("SELECT * FROM falta WHERE matricula='$this->matricula'")){
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