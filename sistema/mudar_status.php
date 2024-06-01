<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "solicitacao.php";
    $mudar = new Solicitacao($_POST['matricula']);
    $mudar->__set("id",$_POST['id']);
    $mudar->__set("status",$_POST['status']);
    if($mudar->MudarStatus()){
        echo "Status Atualizado!";
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>