<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    if(isset($_POST['cnpj'])){
        require_once "empresa.php";
        $atualiza = new Empresa($_POST['cnpj']);
        if($atualiza->AtualizaEmpresa($_POST['usuario'],$_POST['senha'],$_POST['telefone'])){
            echo "atualizado";
        }
    }elseif(isset($_POST['matricula'])){
        require_once "aluno.php";
        $atualiza = new Aluno($_POST['matricula']);
        $atualiza->__set("usuario",$_POST['usuario']);
        $atualiza->__set("senha",$_POST['senha']);
        $atualiza->__set("telefone",$_POST['telefone']);
        $atualiza->__set("status",$_POST['status']);
        if($atualiza->AtualizarAluno()){
            echo "atualizado";
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>