<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
    if(isset($_POST['identidade'])){
        $arquivo = new Arquivo($_POST['identidade']);
        $arquivo->AddArquivo($_FILES['arquivo']);
    }elseif(isset($_POST['matricula'])){
        $arquivo = new Arquivo($_POST['matricula']);
    }
    
}else{
    header("location:login.php");
}  
?>