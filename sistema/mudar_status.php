<?php
    require_once "solicitacao.php";
    $mudar = new Solicitacao($_POST['id']);
    if($mudar->MudarStatus($_POST['status'])){
        echo "Status Atualizado!";
    }
    
?>