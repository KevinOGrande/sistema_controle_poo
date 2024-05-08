<?php
class Empresa{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    protected $tabela = "empresa";
    protected $identidade = null;
    protected $diretorio = "diretorio_empresa";
    

    public function __construct($identidade){
        $this->identidade = $identidade;
    }
    public function CadEmpresa($nome,$usuario,$senha,$telefone){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $duplicidade = $corn->query("SELECT * FROM empresa WHERE cnpj='$this->identidade' OR usuario='$usuario'");
            $linha = $duplicidade->fetch(PDO::FETCH_ASSOC);
            if($linha){
                return false;
            }else{
                $sql= "INSERT INTO $this->tabela(cnpj,nome_empresa,telefone,usuario,senha)VALUES(:cnpj,:nome_empresa,:telefone,:usuario,:senha)";
                $cad = $corn->prepare($sql);
                $cad->bindValue(":cnpj",$this->identidade);
                $cad->bindValue(":nome_empresa",$nome);
                $cad->bindValue(":telefone",$telefone);
                $cad->bindValue(":usuario",$usuario);
                $cad->bindValue(":senha",$senha);
                if($cad->execute()){
                    $caminho= "C:/xampp/htdocs/estudo/sistema_controle_poo/".$this->diretorio."/".$this->identidade;
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
            $sql= "SELECT * FROM $this->tabela WHERE cnpj= :cnpj";
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
                if($corn->query("DELETE FROM $this->tabela WHERE cnpj='$this->identidade'")){
                    $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/".$this->diretorio."/".$this->identidade);
                    while(($nome_arquivo = $arquivo->read())!== false){
                        if($nome_arquivo!=="." && $nome_arquivo!==".."){
                            unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/".$this->diretorio."/".$this->identidade."/".$nome_arquivo);
                        }   
                    }
                    if(rmdir("C:/xampp/htdocs/estudo/sistema_controle_poo/".$this->diretorio."/".$this->identidade)){
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
    public function AtualizaEmpresa($usuario,$senha,$telefone){
        try{
            $corn = new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->pass);
            $corn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE $this->tabela SET telefone= :telefone,usuario= :usuario,senha= :senha WHERE cnpj='$this->identidade'";
            $atualiza = $corn->prepare($sql);
            $atualiza->bindValue(":telefone",$telefone);
            $atualiza->bindValue(":usuario",$usuario);
            $atualiza->bindValue(":senha",$senha);
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
            if($lista=$corn->query("SELECT * FROM $this->tabela")){
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