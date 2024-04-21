<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "empresa.php";
    $atualiza = new Empresa($_POST['cnpj']);
    if($atualiza->AtualizaEmpresa($_POST['usuario'],$_POST['senha'],$_POST['telefone'])){
        echo "atualizado";
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>