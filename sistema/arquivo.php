<?php
class Arquivo{
    protected $host = "localhost";
    protected $dbname = "sis_controle";
    protected $user = "kevin";
    protected $pass = "1234";
    public $identidade = null;

    public function __construct($identidade){
        $this->identidade = $identidade;
    }
    public function AddArquivo($upload){
        $caminho = "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade."/Relatorio.pdf";
        move_uploaded_file($upload['tmp_name'],$caminho);
    }
    public function ListaArquivo(){
        if($arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade)){
            return $arquivo;
        }
        
    }
    public function ExcluirArquivo($nome_arquivo){
        unlink("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$this->identidade."/".$nome_arquivo);
    }
    public function AddBoleto($upload,$id){
        $caminho = "C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$this->identidade."/solicitacao/Boleto_pedido_".$id.".pdf";
        if(move_uploaded_file($upload['tmp_name'],$caminho)){
            return true;
        }
        
    }
}
?>