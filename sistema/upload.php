<?php
session_start();
if((isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true)&&(isset($_POST['identidade']) || isset($_POST['matricula']))){
    require_once "arquivo.php";
    if(isset($_POST['identidade'])){
        $arquivo = new Arquivo($_POST['identidade']);
        $arquivo->AddArquivo($_FILES['arquivo']);
    }elseif(isset($_POST['matricula'])){
        $arquivo = new Arquivo($_POST['matricula']);
        $arquivo->__set("id",$_POST['id']);
        if($arquivo->AddBoleto($_FILES['arquivo'])){
            require_once "solicitacao.php";
            $status = new Solicitacao($_POST['matricula']);
            $status->__set("id",$_POST['id']);
            $status->__set("status","Pagamento Pendente");
            $status->MudarStatus();
        }  
    }
    header("location:index.php");
}else{
    header("location:login.php");
}  
?>