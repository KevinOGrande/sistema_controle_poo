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
        <form action="falta.php" method="post" enctype="multipart/form-data">
            <input type="file" name="falta" id="falta">
            <input type="submit" value="enviar">
        </form>
    </body>
    </html>
    <?php
    if(isset($_FILES['falta'])){
        require_once "arquivo.php";
        $falta = new Arquivo($_SESSION['matricula']);
        if($falta->EnvioFalta($_FILES['falta'])){
            echo "falta enviada";
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>