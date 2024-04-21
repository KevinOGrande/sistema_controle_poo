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
        <a href="cad_usuario.php">Cadastro usuario</a>
        <a href="cad_empresa.php">Cadastro empresa</a>
        <a href="lista_empresa.php">Lista Empresa</a>
        <form action="pesquisa.php" method="get">
            <input type="text" name="pesquisa">
            <input type="submit" value="pesquisar">
        </form>
    </body>
    </html>
    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>