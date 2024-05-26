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
        <form action="mandar_falta.php" method="post" enctype="multipart/form-data">
            <label>Sua Justificativa refere-se a:</label>
            <br>
            <input type="radio" name="justificativa" id="atraso" value="Entrada em atraso">
            <label>Entrada em atraso</label>
            <br>
            <input type="radio" name="justificativa" id="saida" value="Saida antecipada">
            <label>Saida antecipada</label>
            <br>
            <input type="radio" name="justificativa" id="umoumais" value="1 dia ou mais">
            <label>1 dia ou mais</label>
            <br>
            <input type="file" name="falta" id="falta">
            <br>
            <input type="text" name="observacao" id="observacao">
            <input type="submit" value="enviar">
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