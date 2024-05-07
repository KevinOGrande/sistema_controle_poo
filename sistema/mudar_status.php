<?php
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "solicitacao.php";
    $mudar = new Solicitacao($_POST['id']);
    if($mudar->MudarStatus($_POST['status'])){
        echo "Status Atualizado!";
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>