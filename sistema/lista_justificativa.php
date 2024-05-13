<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require "empresa.php";
    $lista = new Solicitacao(" ");
    $resultado = $lista->ListaFalta();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
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
        </table>
        <?php
        foreach($resultado->fetchALL(PDO::FETCH_ASSOC) as $linha){
            ?>
            <table class="table table-striped">
                <tbody>
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
                </tbody>
            </table>
            <?php
        }
        ?>
    </body>
    </html>
    <?php

}else{
    header("location:login.php");
}  

?>