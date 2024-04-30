<?php
session_start();
session_destroy();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="login.php" method="post">
            <input type="text" name="user">
            <input type="password" name="senha">
            <input type="submit" value="enviar">
        </form>
        <a href="cadaluno.php">Cadastro de aluno</a>
    </body>
    </html>
<?php
if(isset($_POST['user']) && isset($_POST['senha'])){
    require_once "usuario.php";
    $login = new Usuario($_POST['user'],$_POST['senha']);
    if($resultado = $login->UserSenai()){
        session_start();
        $_SESSION['login_senai'] = true;
        header("location:index.php");
    }
    else if($resultado = $login->UserEmpresa()){
        session_start();
        $_SESSION['login_empresa'] = true;
        $_SESSION['empresa'] = $resultado["cnpj"];
        header("location:index_empresa.php");
    }
    else if($resultado = $login->UserAluno()){
        session_start();
        $_SESSION['login_aluno'] = true;
        $_SESSION['matricula'] = $resultado['matricula'];
        header("location:index_aluno.php");
    }
}
?>