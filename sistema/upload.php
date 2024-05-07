<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
    if(isset($_POST['identidade'])){
        $arquivo = new Arquivo($_POST['identidade']);
        $arquivo->AddArquivo($_FILES['arquivo']);
    }elseif(isset($_POST['matricula'])){
        $arquivo = new Arquivo($_POST['matricula']);
        if($arquivo->AddBoleto($_FILES['arquivo'],$_POST['id'])){
            require_once "solicitacao.php";
            $status = new Solicitacao($_POST['id']);
            $status->MudarStatus("Pagamento Pendente");
        }
        
    }
    
}else{
    header("location:login.php");
}  
?>