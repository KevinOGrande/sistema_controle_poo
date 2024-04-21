<?php
class Aluno{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    protected $tabela = "aluno";
    protected $identidade = null;
    protected $diretorio = "diretorio_empresa";

    public function __construct($identidade){
        $this->identidade = $identidade;
    }
    public function CadEmpresa($nome,$usuario,$senha,$telefone,$status){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO $this->tabela(matricula,nome,telefone,usuario,senha,status_aluno)VALUES(:matricula,:nome_empresa,:telefone,:usuario,:senha,:status_aluno)";
            $cad = $corn->prepare($sql);
            $cad->bindValue(":matricula",$this->identidade);
            $cad->bindValue(":nome_empresa",$nome);
            $cad->bindValue(":telefone",$telefone);
            $cad->bindValue(":usuario",$usuario);
            $cad->bindValue(":senha",$senha);
            $cad->bindValue(":status_aluno",$status);
            if($cad->execute()){
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