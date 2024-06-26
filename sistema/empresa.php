<?php
class Empresa{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    protected $identidade = null;
    private $nome = null;
    private $usuario = null;
    private $senha = null;
    private $telefone = null;
    
    public function __construct($identidade){
        $this->identidade = $identidade;
    }
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function CadEmpresa(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $duplicidade_senai = $corn->query("SELECT adm FROM usuario WHERE adm ='$this->usuario'");
            $duplicidade_aluno = $corn->query("SELECT usuario FROM aluno WHERE usuario ='$this->usuario'");
            $duplicidade_empresa = $corn->query("SELECT usuario FROM empresa WHERE usuario ='$this->usuario'");
            if(($duplicidade_senai->fetch(PDO::FETCH_ASSOC)) || ($duplicidade_aluno->fetch(PDO::FETCH_ASSOC)) || ($duplicidade_empresa->fetch(PDO::FETCH_ASSOC))){
                return false;
            }else{
                $sql= "INSERT INTO empresa(cnpj,nome_empresa,telefone,usuario,senha)VALUES(:cnpj,:nome_empresa,:telefone,:usuario,:senha)";
                $cad = $corn->prepare($sql);
                $cad->bindValue(":cnpj",$this->identidade);
                $cad->bindValue(":nome_empresa",$this->nome);
                $cad->bindValue(":telefone",$this->telefone);
                $cad->bindValue(":usuario",$this->usuario);
                $cad->bindValue(":senha",$this->senha);
                if($cad->execute()){
                    $caminho= "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade;
                    if(mkdir($caminho,0777)){
                        return true;
                    }
                }
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
    public function PesquisaEmpresa(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql= "SELECT * FROM empresa WHERE cnpj= :cnpj";
            $requisicao_empresa = $corn->prepare($sql);
            $requisicao_empresa->bindValue(":cnpj",$this->identidade);
            $requisicao_empresa->execute();
            $linha_pesquisa = $requisicao_empresa->fetch(PDO::FETCH_ASSOC);
            if($linha_pesquisa){
                return $linha_pesquisa;
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
    public function ExcluirEmpresa($usuario,$senha){
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
                if($corn->query("DELETE FROM empresa WHERE cnpj='$this->identidade'")){
                    $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade);
                    while(($nome_arquivo = $arquivo->read())!== false){
                        if($nome_arquivo!=="." && $nome_arquivo!==".."){
                            unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade."/".$nome_arquivo);
                        }   
                    }
                    if(rmdir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade)){
                        return "excluido";
                    }
                }
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=NULL;
        }
    }
    public function AtualizaEmpresa(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE empresa SET telefone= :telefone,usuario= :usuario,senha= :senha WHERE cnpj='$this->identidade'";
            $atualiza = $corn->prepare($sql);
            $atualiza->bindValue(":telefone",$this->telefone);
            $atualiza->bindValue(":usuario",$this->usuario);
            $atualiza->bindValue(":senha",$this->senha);
            if($atualiza->execute()){
                return true;
            }
        }catch(PDOException $e){
            echo "tem erro:".$e;
        }finally{
            $corn=null;
        }
    }
    public function ListaEmpresa(){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if($lista=$corn->query("SELECT * FROM empresa")){
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