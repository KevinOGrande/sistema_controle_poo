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
        <form action="cad_empresa.php" method="get">
            <input type="text" name="cnpj" id="cnpj" require>
            <input type="text" name="nome" id="nome" require>
            <input type="text" name="usuario" id="usuario" require>
            <input type="password" name="senha" id="senha" require>
            <input type="text" name="telefone" id="telefone" require>
            <input type="submit" value="enviar">
        </form>
    </body>
    </html>
    <?php
    if(isset($_GET['cnpj'])){
        require_once "empresa.php";
        $cad = new Empresa($_GET['cnpj']);
        $cad->CadEmpresa($_GET['nome'],$_GET['usuario'],$_GET['senha'],$_GET['telefone']);
    }
    
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>