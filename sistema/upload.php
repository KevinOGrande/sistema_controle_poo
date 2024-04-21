<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
    $arquivo = new Arquivo($_POST['identidade']);
    $arquivo->AddArquivo($_FILES['arquivo']);
}else{
    header("location:login.php");
}  
?>