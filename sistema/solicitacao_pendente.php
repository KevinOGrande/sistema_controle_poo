<?php
session_start();
if(isset($_SESSION['login_aluno']) && $_SESSION['login_aluno'] == true){
    require_once "solicitacao.php";
    $matricula = $_SESSION['matricula'];
    $solicitacao = new Solicitacao($matricula);
    if($resultado = $solicitacao->ListaSolicitacao()){
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
                </style>
            </head>
            <body>
                <header>
                    <nav class="navbar body-tertiary">
                        <img src="image/senai_logo1.png" alt="">
                        <div class="container">
                            <a href="login.php" class="btn btn-secondary">Voltar</a>
                        </div>
                    </nav>
                </header>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><h3>ID</h3></th>
                            <th><h3>Pedido</h3></th>
                            <th><h3>Nome Arquivo</h3></th>
                            <th><h3>Download</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$matricula."/solicitacao");
                        while(($nome_arquivo = $arquivo->read()) !== false){
                            if($nome_arquivo!=="." && $nome_arquivo!==".."){
                                $url = "http://localhost/estudo/sistema_controle_poo/diretorio_aluno/".$matricula."/solicitacao/".$nome_arquivo;
                                ?>
                                <tr>
                                    <th><?php echo $nome_arquivo;?></th>
                                    <th class="botao_download"><a href=<?php echo $url;?> download="<?php echo $nome_arquivo;?>" class="btn btn-success">Download</a></th>
                                </tr>
                                <br>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </body>
            </html>
        <?php
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>