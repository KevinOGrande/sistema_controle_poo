<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
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
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </nav>
        </header>
        <?php
        if(isset($_POST['cnpj'])){
            $lista = new Arquivo($_POST['cnpj']);
            if($resultado = $lista->ListaArquivoEmpresa()){
                while(($nome_arquivo = $resultado->read()) !== false){
                    if($nome_arquivo!=="." && $nome_arquivo!==".."){
                        ?>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th><p><?php echo $nome_arquivo;?></p></th>
                                    <th>
                                        <!-- Formulario para excluir o arquivo -->
                                        <form action="excluir_arquivo.php" method="post" class="botao_excluir">
                                            <input type="hidden" name="cnpj" value="<?php echo $_POST['cnpj'];?>">
                                            <input type="hidden" name="nome_arquivo" value="<?php echo $nome_arquivo;?>">
                                            <input type="submit" value="excluir" class="btn btn-danger">
                                        </form>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                }
            }
        }elseif(isset($_POST['matricula'])){
            $lista = new Arquivo($_POST['matricula']);
            if($resultado = $lista->ListaArquivoAlunoSolicitacao()){
                while(($nome_arquivo = $resultado->read()) !== false){
                    if($nome_arquivo!=="." && $nome_arquivo!==".."){
                        ?>
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th><p><?php echo $nome_arquivo;?></p></th>
                                    <th>
                                        <!-- Formulario para excluir o arquivo -->
                                        <form action="excluir_arquivo.php" method="post" class="botao_excluir">
                                        <input type="hidden" name="matricula" value="<?php echo $_POST['matricula'];?>">
                                            <input type="hidden" name="nome_arquivo" value="<?php echo $nome_arquivo;?>">
                                            <input type="submit" value="excluir" class="btn btn-danger">
                                        </form>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                }
            }
        }else{
            header("location:index.php");
        }
        ?>
    </body>
    </html>
    <?php
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>