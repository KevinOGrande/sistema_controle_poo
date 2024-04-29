<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "aluno.php";
    $pesquisa=null;
    $pesquisa = new Aluno($_SESSION['pesquisa_aluno']);
    $resutado = $pesquisa->PesquisaAluno(); 
    if($resutado){
        echo $resutado['nome'];
    }
}else{
    header("location:login.php");
}  
?>