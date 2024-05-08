<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
    if(isset($_POST['cnpj'])){
        $arquivo = new Arquivo($_POST['cnpj']);
        if($arquivo->ExcluirArquivoEmpresa($_POST['nome_arquivo'])){
            echo "excluido";
        }
    }elseif(isset($_POST['matricula'])){
        $arquivo = new Arquivo($_POST['matricula']);
        if($arquivo->ExcluirArquivoAlunoSolicitacao($_POST['nome_arquivo'])){
            echo "excluido";
        }
    }
    
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>