<?php
session_start();
if(isset($_SESSION['login_aluno']) && $_SESSION['login_aluno'] == true){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <a href="solicitacao_documento.php">Solicitação de documentos</a>
        <a href="solicitacao_pendente.php">Solicitações Pendentes</a>
    </body>
    </html>

    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>