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
            .form-select{
                width:100%;
            }
            .botao{
                margin-top: 1%;
                align-items: center;
            }
            .fs-1{
                text-align: center;
            }
            .container{
                margin-left: 80%;
                margin-top: -3%;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
                <div class="container">
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </nav>
        </header>
        <p class="fs-1">Cadastro de Empresa</p>
        <form action="cad_empresa.php" method="get" class="formulario">
            <div class="mb-3">
                <label class="form-label">CNPJ:</label>
                <input type="text" name="cnpj" id="cnpj" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Nome da Empresa:</label>
                <input type="text" name="nome" id="nome" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Usuario:</label>
                <input type="text" name="usuario" id="usuario" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha:</label>
                <input type="text" name="senha" id="senha" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone:</label>
                <input type="text" name="telefone" id="telefone" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="botao">
                <input type="submit" value="cadastrar" class="btn btn-success">
            </div>
        </form>
    </body>
    </html>
    <?php
    if(isset($_GET['cnpj'])){
        require_once "empresa.php";
        $cad = new Empresa($_GET['cnpj']);
        $cad->__set("nome",$_GET['nome']);
        $cad->__set("usuario",$_GET['usuario']);
        $cad->__set("senha",$_GET['senha']);
        $cad->__set("telefone",$_GET['telefone']);
        if($cad->CadEmpresa()){
            echo "cadastrado";
        }
    }
    
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>