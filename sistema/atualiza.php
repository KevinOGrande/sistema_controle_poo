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
        <form action="atualiza2.php" method="post">
            <input type="hidden" name="cnpj" value="<?php echo $_POST['cnpj'];?>">
            <input type="text" name="usuario" value="<?php echo $_POST['usuario'];?>" require>
            <input type="text" name="senha" value="<?php echo $_POST['senha'];?>" require>
            <input type="text" name="telefone" value="<?php echo $_POST['telefone'];?>" require>
            <input type="submit" value="atualizar">
        </form>
    </body>
    </html>    
    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>