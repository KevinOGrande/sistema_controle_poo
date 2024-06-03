<?php
session_start();
if(isset($_SESSION['login_aluno']) && $_SESSION['login_aluno'] == true){
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
            }
            .container{
                margin-left: 80%;
                margin-top: -3%;
            }
            .fs-1{
                margin-top:3%;
                text-align: center;
                justify-content: center;
            }
            #botao{
                width: 140%;
                
            }
            #botao_grupo{
                align-items: center;
                justify-content: center;
                margin-top:2%;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
                <div class="container">
                    <a href="login.php" onclick = "return confirm('Desejar sair?')" class="btn btn-secondary">Sair</a>
                </div>
            </nav>
        </header>
        <p class="fs-1">Seja Bem-Vindo (a) <?php echo $_SESSION['nome_aluno']?>!</p>
        <div class="d-grid gap-2 col-6 mx-auto" id="botao_grupo">
            <a href="solicitacao_documento.php" class="btn btn-primary" id="botao">Solicitação de documentos</a>
            <a href="solicitacao_pendente.php" class="btn btn-primary" id="botao">Solicitações Pendentes</a>
            <?php
            if($_SESSION['status'] == "Aluno"){
                ?>
                <a href="mandar_falta.php" class="btn btn-primary" id="botao">Envio de Faltas</a>
                <?php
            }
            ?>
            <form action="lista_solicitacao_aluno.php" method="post">
                <input type="hidden" name="matricula" value="<?php echo $_SESSION['matricula']?>">
                <input type="submit" value="Lista de Solicitações" class="btn btn-primary" id="botao">
            </form>
        </div>
    </body>
    </html>

    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>