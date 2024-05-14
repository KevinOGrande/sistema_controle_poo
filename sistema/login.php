<?php
session_start();
session_destroy();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:wght@100&display=swap" rel="stylesheet">
        <style>
            header{
                background-color: #1B62B7;
            }
            .mb-3{
                width:20%;
            }
            .formulario{
                display:flex;
                flex-direction:column;
                align-items: center;
                justify-content: center;
            }
            .botao{
                margin-top: 1%;
                align-items: center;
            }
            .fs-1{
                text-align: center;
            }
            #cad{
                align-items: center;
            }
        </style>
        <title>Document</title>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
            </nav>
        </header>
        <p class="fs-1">Login</p>
        <form action="login.php" method="post" class="formulario">
            <div class="mb-3">
                <label class="form-label">Usuario:</label>
                <input type="text" name="user" id="usuario" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha:</label>
                <input type="password" name="senha" id="senha" required class="form-control" id="exampleInputPassword1">
            </div>
            <div class="botao">
                <input type="submit" value="Entrar" class="btn btn-primary">
            </div>
        </form>
        <div>
            <a href="cadaluno.php" id="cad">Cadastro de aluno</a>
        </div>
        
    </body>
    </html>
<?php
if(isset($_POST['user']) && isset($_POST['senha'])){
    require_once "usuario.php";
    $login = new Usuario($_POST['user'],$_POST['senha']);
    if($resultado = $login->UserSenai()){
        session_start();
        $_SESSION['nome_usuario'] = $resultado['nome'];
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