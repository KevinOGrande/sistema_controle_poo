<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
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
        <title>Document</title>
        <style>
            header{
                background-color: #1B62B7;
                display: flex;
            }
            .fs-1{
                margin-top:3%;
                text-align: center;
                justify-content: center;
            }
            .form-control{
                color: #DCDCDC;
                width: 200%;
                height: 75%;
            }
            .formulario{
                margin-top: 0.8%;
                display: flex;
                align-items: right;
                justify-content: right;
                margin-left: 65%;
            }
            .botao{
                margin-left: 1%;
            }
            #botao{
                width: 140%;
                
            }
            #botao_grupo{
                align-items: center;
                justify-content: center;
                margin-top:2%;
            }
            .sair{
                margin-top: 0.8%;
                margin-left: 2%;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
            </nav>
            <div class="sair">
                <a href="login.php" onclick = "return confirm('Desejar sair?')" class="btn btn-secondary">Sair</a>
            </div>
            <form action="pesquisa.php" method="get" class="formulario">
                <input type="text" name="pesquisa" class="form-control">
                <div class="botao">
                    <input type="submit" value="pesquisar" class="btn btn-success">
                </div>
            </form>
        </header>
        <p class="fs-1">Seja Bem-Vindo <?php echo $_SESSION['nome_usuario']?>!</p>
        <div class="d-grid gap-2 col-6 mx-auto" id="botao_grupo">
            <a href="cad_usuario.php" class="btn btn-primary" id="botao">Cadastro usuario Senai</a>
            <a href="cad_empresa.php" class="btn btn-primary" id="botao">Cadastro empresa</a>
            <a href="lista_empresa.php" class="btn btn-primary" id="botao">Lista Empresa</a>
            <a href="lista_solicitacao.php" class="btn btn-primary" id="botao">lista solicitacao Aluno</a>
        </div>
    </body>
    </html>
    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>