<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "solicitacao.php";
    $solicitacao = new Solicitacao(" ");
    if($lista = $solicitacao->ListaSolicitacao()){
        foreach($lista->fetchAll(PDO::FETCH_ASSOC) as $linha){
            echo $linha['pedido'];
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>