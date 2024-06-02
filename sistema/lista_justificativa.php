<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require "falta.php";
    $lista = new Falta($_POST['matricula']);
    $resultado = $lista->ListaFalta();
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
            .fs-1{
                text-align: center;
            }
            th{
                width: 18%;
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
                    <form action="pesquisa.php" method="get">
                        <input type="hidden" name="pesquisa" value="<?php echo $_POST['matricula'];?>">
                        <input type="submit" value="Voltar" class="btn btn-secondary">
                    </form>
                </div>
            </nav>
        </header>
        <p class="fs-1">Justificativas de Faltas</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><h3>Matricula</h3></th>
                    <th><h3>ID</h3></th>
                    <th><h3>Justificativa</h3></th>
                    <th><h3>Observação</h3></th>
                    <th><h3>Download do Arquivo</h3></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($resultado->fetchALL(PDO::FETCH_ASSOC) as $linha){
                    ?>
                    <tr>
                        <th><?php echo $linha['matricula'];?></th>
                        <th><?php echo $linha['id_falta'];?></th>
                        <th><?php echo $linha['justificativa'];?></th>
                        <th><?php echo $linha['observacao'];?></th>
                        <?php
                        require_once "arquivo.php";
                        $arquivo = new Arquivo($linha['matricula']);
                        if($listafalta = $arquivo->ListaArquivoAlunoFalta()){
                            while(($nome_arquivo = $listafalta->read()) !== false){
                                if($nome_arquivo!=="." && $nome_arquivo!==".."){
                                    if(str_contains($nome_arquivo,$linha['id_falta'])){
                                        $url = "http://localhost/estudo/sistema_controle_poo/diretorio_aluno/".$linha['matricula']."/falta/".$nome_arquivo;
                                        ?>
                                            <th class="botao_download"><a href=<?php echo $url;?> download="<?php echo $nome_arquivo;?>" class="btn btn-success">Download</a></th>
                                            <br>
                                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </body>
    </html>
    <?php

}else{
    header("location:login.php");
}  

?>