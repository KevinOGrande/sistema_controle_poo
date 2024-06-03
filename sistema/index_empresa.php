<?php
session_start();
if(isset($_SESSION['login_empresa']) && $_SESSION['login_empresa'] === true){
    $cnpj = $_SESSION['empresa'];
    $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_empresa/".$cnpj);
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                            <a href="login.php" onclick = "return confirm('Desejar sair?')" class="btn btn-secondary">Sair</a>
                        </div>
                    </nav>
                </header>
                <p class="fs-1">Relatorios de <?php echo $_SESSION['nome_empresa'];?></p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><h3>Nome do Arquivo</h3></th>
                            <th><h3>Download</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while(($nome_arquivo = $arquivo->read()) !== false){
                            if($nome_arquivo!=="." && $nome_arquivo!==".."){
                                $url = "http://localhost/estudo/sistema_controle_poo/diretorio_empresa/".$cnpj."/".$nome_arquivo;
                        ?>
                                <tr>
                                    <th><?php echo $nome_arquivo;?></th>
                                    <th class="botao_download"><a href=<?php echo $url;?> download="<?php echo $nome_arquivo;?>" class="btn btn-success">Download</a></th>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </body>
            </html>
        <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>