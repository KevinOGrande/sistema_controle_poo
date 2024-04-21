<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="cad_usuario.php" method="get">
            <input type="text" name="nome" require>
            <input type="text" name="user" require>
            <input type="password" name="senha" require>
            <input type="submit" value="enviar">
        </form>
    </body>
    </html>
    <?php
    if(isset($_GET['nome'])){
        require_once "usuario.php";
        $cad = new Usuario($_GET['user'],$_GET['senha']);
        $cad->CadastroUsuario($_GET['nome']);
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>