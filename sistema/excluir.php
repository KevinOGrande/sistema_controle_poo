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
        <form action="excluir.php" method="post">
            <input type="hidden" name="identidade" value="<?php echo $_POST['identidade'];?>">
            <input type="text" name="usuario" id="usuario" require>            
            <input type="password" name="senha" id="senha">
            <input type="submit" value="excluir">
        </form>
    </body>
    </html>
    <?php
    if(isset($_POST['usuario'])){
        require_once "empresa.php";
        $excluir = new Empresa($_POST['identidade']);
        $resultado = $excluir->ExcluirEmpresa($_POST['usuario'],$_POST['senha']);
        if($resultado){
            echo $resultado;
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>