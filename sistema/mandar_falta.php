<?php
session_start();
if(isset($_SESSION['login_aluno']) && $_SESSION['login_aluno'] == true){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                text-align: center;
            }
            .formulario{
                display:flex;
                flex-direction:column;
                align-items: center;
                justify-content: center;
            }
            .opcao{
                display: flex;
            }
            #falta{
                width: 20%;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
                <div class="container">
                    <a href="index_aluno.php" class="btn btn-secondary">Voltar</a>
                </div>
            </nav>
        </header>
        <p class="fs-1">Envio de Faltas</p>
        <form action="mandar_falta.php" method="post" enctype="multipart/form-data" class="formulario">
            <label>Sua Justificativa refere-se a:</label>
            <br>
            <div class="opcao">
                <input type="radio" name="justificativa" id="atraso" value="Entrada em atraso">
                <label>Entrada em atraso</label>
            </div>
            <br>
            <div class="opcao">
                <input type="radio" name="justificativa" id="saida" value="Saida antecipada">
                <label>Saida antecipada</label>
            </div>
            <br>
            <div class="opcao">
                <input type="radio" name="justificativa" id="umoumais" value="1 dia ou mais">
                <label>1 dia ou mais</label>
            </div>
            <br>
            <input type="file" name="falta" id="falta" class="form-control">
            <br>
            <div class="mb-3">
                <label class="form-label">Observação:</label>
                <input type="text" name="observacao" id="observacao"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <input type="submit" value="enviar" class="btn btn-success">
        </form>
    </body>
    </html>
    <?php
    if(isset($_FILES['falta'])){
        require_once "falta.php";
        $falta = new Falta($_SESSION['matricula']);
        $falta->__set("data_envio",date("d-m-Y"));
        $falta->__set("justificativa",$_POST['justificativa']);
        $falta->__set("observacao",$_POST['observacao']);
        if($id = $falta->EnvioFalta()){
            require_once "arquivo.php";
            $justificativa = new Arquivo($_SESSION['matricula']);
            $justificativa->__set("id",$id);
            if($justificativa->EnvioFalta($_FILES['falta'])){
                echo "falta enviada";
            }
        }
        
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>