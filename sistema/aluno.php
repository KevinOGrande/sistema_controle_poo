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
            $duplicidade = $corn->query("SELECT * FROM aluno WHERE matricula='$this->identidade' OR usuario='$usuario'");
            $linha = $duplicidade->fetch(PDO::FETCH_ASSOC);
            if($linha){
                return false;
            }else{
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
                        $caminho= "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/falta";
                        if(mkdir($caminho,0777)){
                            $caminho= "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/solicitacao";
                            if(mkdir($caminho,0777)){
                                return true;
                            }
                        }
                    }  
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
    public function ExcluirAluno($usuario,$senha){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM usuario WHERE adm= :usuario and senha= :senha";
            $permissao = $corn->prepare($sql);
            $permissao->bindValue(":usuario",$usuario);
            $permissao->bindValue(":senha",$senha);
            $permissao->execute();
            $linha_permissao = $permissao->fetch(PDO::FETCH_ASSOC);
            if($linha_permissao){
                if($corn->query("DELETE FROM aluno WHERE matricula='$this->identidade'")){
                    $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/falta");
                    while(($nome_arquivo = $arquivo->read())!== false){
                        if($nome_arquivo!=="." && $nome_arquivo!==".."){
                            unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/falta/".$nome_arquivo);
                        }   
                    }
                    if(rmdir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/falta")){
                        $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/solicitacao");
                        while(($nome_arquivo = $arquivo->read())!== false){
                            if($nome_arquivo!=="." && $nome_arquivo!==".."){
                                unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/solicitacao/".$nome_arquivo);
                            }   
                        }
                        if(rmdir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/solicitacao")){
                            if(rmdir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade)){
                                return true;
                            }
                        }
                    }
                    
                }
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
}


?>