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
            <select name="pedido" id="pedido" require>
                <option value="segunda via carteira estudantil">2ª via de carteirinha estudantil - R$ 10,00</option>
                <option value="declaracao de transferencia">Declaração de Transferência - R$ 15,00</option>
                <option value="declaracao de matricula">Declaração de matrícula - Gratuito</option>
                <option value="carta para estagio optativo">Carta de apresentação para estágio optativo - Gratuito</option>
                <option value="Ementa Escolar">Ementa Escolar - R$ 20,00 por disciplina com teto máximo de R$ 100,00</option>
                <option value="Historico Parcial">Histórico Parcial - R$ 15,00</option>
                <option value="recuperacao">Recuperação - R$ 10,00</option>
            </select>
            <input type="text" name="observacao" id="observacao">
            <input type="submit" value="enviar">
        </form>
    </body>
    </html>
    <?php
    if(isset($_GET['pedido'])){
        require_once "solicitacao.php";
        $documento = new Solicitacao($_SESSION['matricula']);
        $envio = $documento->AddSolicitacao($_GET['pedido'],"Em Analise",$_GET['observacao']);
        if($envio){
            echo "solicitação enviada";
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>