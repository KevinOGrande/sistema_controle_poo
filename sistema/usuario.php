<?php
class Usuario{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    private $usuario = null;
    private $senha = null;
    private $nome = null;

    public function __construct($usuario,$senha){
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    public function __destruct(){}

    public function UserSenai(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT adm, senha, nome FROM usuario WHERE adm= :usuario and senha= :senha";
            $requsicao_user = $corn->prepare($sql);
            $requsicao_user->bindValue(":usuario",$this->usuario);
            $requsicao_user->bindValue(":senha",$this->senha);
            $requsicao_user->execute();
            $linha_usuario = $requsicao_user-> fetch(PDO::FETCH_ASSOC);
            if($linha_usuario){
                return $linha_usuario;
            }    
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }
    }
    public function UserEmpresa(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM empresa WHERE usuario= :usuario and senha= :senha";
            $requsicao_empresa = $corn->prepare($sql);
            $requsicao_empresa->bindValue(":usuario",$this->usuario);
            $requsicao_empresa->bindValue(":senha",$this->senha);
            $requsicao_empresa->execute();
            $linha_empresa = $requsicao_empresa-> fetch(PDO::FETCH_ASSOC);
            if($linha_empresa){
                return $linha_empresa;
            }    
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }
    }
    public function UserAluno(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM aluno WHERE usuario= :usuario and senha= :senha";
            $requsicao_aluno = $corn->prepare($sql);
            $requsicao_aluno->bindValue(":usuario",$this->usuario);
            $requsicao_aluno->bindValue(":senha",$this->senha);
            $requsicao_aluno->execute();
            $linha_aluno = $requsicao_aluno-> fetch(PDO::FETCH_ASSOC);
            if($linha_aluno){
                return $linha_aluno;
            }    
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }
    }
    public function CadastroUsuario(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $duplicidade_senai = $corn->query("SELECT adm FROM usuario WHERE adm ='$this->usuario' ");
            $duplicidade_aluno = $corn->query("SELECT usuario FROM aluno WHERE usuario ='$this->usuario' ");
            $duplicidade_empresa = $corn->query("SELECT usuario FROM empresa WHERE usuario ='$this->usuario' ");
            if(($duplicidade_senai->fetch(PDO::FETCH_ASSOC)) || ($duplicidade_aluno->fetch(PDO::FETCH_ASSOC)) || ($duplicidade_empresa->fetch(PDO::FETCH_ASSOC))){
                return false;
            }else{
                $sql = "INSERT INTO usuario(nome,adm,senha)VALUES(:nome,:usuario,:senha)";
                $cad = $corn->prepare($sql);
                $cad->bindValue(":nome",$this->nome);
                $cad->bindValue(":usuario",$this->usuario);
                $cad->bindValue(":senha",$this->senha);
                if($cad->execute()){
                    return true;
                }
                else{
                    echo "erro";
                }
            }
            
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }
    }
}


?>