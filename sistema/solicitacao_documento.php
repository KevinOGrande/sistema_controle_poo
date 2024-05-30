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
                text-align: center;
            }
            .formulario{
                display:flex;
                flex-direction:column;
                align-items: center;
                justify-content: center;
            }
            .mb-3{
                width:20%;
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
        <p class="fs-1">Solicitação de Documentos</p>
        <form action="solicitacao_documento.php" method="get" class="formulario">
            <input type="radio" name="pedido" id="segunda_via" value="segunda via carteira estudantil">
            <label>2ª via de carteirinha estudantil - R$ 10,00</label>
            <br>
            <input type="radio" name="pedido" id="tranferencia" value="declaracao de transferencia">
            <label>Declaração de Transferência - R$ 15,00</label>
            <br>
            <input type="radio" name="pedido" id="matricula" value="declaracao de matricula">
            <label>Declaração de matrícula - Gratuito</label>
            <br>
            <input type="radio" name="pedido" id="estagio" value="carta para estagio optativo">
            <label>Carta de apresentação para estágio optativo - Gratuito</label>
            <br>
            <input type="radio" name="pedido" id="ementa" value="Ementa Escolar">
            <label>Ementa Escolar - R$ 20,00 por disciplina com teto máximo de R$ 100,00</label>
            <br>
            <input type="radio" name="pedido" id="Historico_Parcial" value="Historico Parcial">
            <label>Histórico Parcial - R$ 15,00</label>
            <br>
            <input type="radio" name="pedido" id="recuperacao" value="recuperacao">
            <label>Recuperação - R$ 10,00</label>
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
    if(isset($_GET['pedido'])){
        require_once "solicitacao.php";
        $documento = new Solicitacao($_SESSION['matricula']);
        $documento->__set("pedido",$_GET['pedido']);
        $documento->__set("status","Em Analise");
        $documento->__set("descricao",$_GET['observacao']);
        $envio = $documento->AddSolicitacao();
        if($envio){
            echo "solicitação enviada";
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>