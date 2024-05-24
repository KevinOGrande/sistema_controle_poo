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
        <form action="solicitacao_documento.php" method="get">
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
            <input type="text" name="observacao" id="observacao">
            <input type="submit" value="enviar">
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