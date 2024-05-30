<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
    if(isset($_POST['cnpj'])){
        $arquivo = new Arquivo($_POST['cnpj']);
        $arquivo->__set("nome_arquivo",$_POST['nome_arquivo']);
        if($arquivo->ExcluirArquivoEmpresa()){
            echo "excluido";
        }
    }elseif(isset($_POST['matricula'])){
        $arquivo = new Arquivo($_POST['matricula']);
        $arquivo->__set("nome_arquivo",$_POST['nome_arquivo']);
        if($arquivo->ExcluirArquivoAlunoSolicitacao()){
            echo "excluido";
        }
    }else{
        header("location:index.php");
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>