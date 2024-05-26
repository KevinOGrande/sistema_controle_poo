<?php
class Arquivo{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    private $identidade = null;
    private $nome_arquivo = null;
    private $id = null;

    public function __construct($identidade){
        $this->identidade = $identidade;
    }
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function AddArquivo($upload){
        $caminho = "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade."/Relatorio_".date("d-m-Y").".pdf";
        move_uploaded_file($upload['tmp_name'],$caminho);
    }
    public function ListaArquivoEmpresa(){
        if($arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade)){
            return $arquivo;
        }
    }
    public function ListaArquivoAlunoSolicitacao(){
        if($arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/solicitacao")){
            return $arquivo;
        }
    }
    public function ListaArquivoAlunoFalta(){
        if($arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/falta")){
            return $arquivo;
        }
    }
    public function ExcluirArquivoEmpresa(){
        if(unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade."/".$this->nome_arquivo)){
            return true;
        }
    }
    public function ExcluirArquivoAlunoSolicitacao(){
        if(unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade."/solicitacao/".$this->nome_arquivo)){
            return true;
        }
    }
    public function ExcluirArquivoAlunoFalta(){
        if(unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade."/falta/".$this->nome_arquivo)){
            return true;
        }
    }
    public function AddBoleto($upload){
        $caminho = "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/solicitacao/Boleto_pedido_".$this->id.".pdf";
        if(move_uploaded_file($upload['tmp_name'],$caminho)){
            return true;
        }
    }
    public function EnvioFalta($upload){
        $caminho = "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/falta/Justificativa_".$this->id."_".date("d-m-Y").".pdf";
        if(move_uploaded_file($upload['tmp_name'],$caminho)){
            return true;
        }
    }
}
?>