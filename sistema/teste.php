<?php
    require_once "solicitacao.php";
    $mudar = new Solicitacao($_POST['id']);
    $mudar->MudarStatus($_POST['status']);
?>