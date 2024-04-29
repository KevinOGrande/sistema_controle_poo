<?php
class Aluno{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    protected $identidade = null;

    public function __construct($identidade){
        $this->identidade = $identidade;
    }
    public function CadAluno($nome,$usuario,$senha,$telefone,$status){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql= "INSERT INTO aluno(matricula,nome,telefone,usuario,senha,status_aluno)VALUES(:matricula,:nome,:telefone,:usuario,:senha,:status_aluno)";
            $cad = $corn->prepare($sql);
            $cad->bindValue(":matricula",$this->identidade);
            $cad->bindValue(":nome",$nome);
            $cad->bindValue(":telefone",$telefone);
            $cad->bindValue(":usuario",$usuario);
            $cad->bindValue(":senha",$senha);
            $cad->bindValue(":status_aluno",$status);
            if($cad->execute()){
                $caminho= "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade;
                if(mkdir($caminho,0777)){
                    return true;
                }  
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
    public function PesquisaAluno(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql= "SELECT * FROM aluno WHERE matricula= :matricula";
            $requisicao_aluno = $corn->prepare($sql);
            $requisicao_aluno->bindValue(":matricula",$this->identidade);
            $requisicao_aluno->execute();
            $linha_pesquisa = $requisicao_aluno->fetch(PDO::FETCH_ASSOC);
            if($linha_pesquisa){
                return $linha_pesquisa;
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
}


?>