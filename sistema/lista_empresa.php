<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require "empresa.php";
    $lista = new Empresa(" ");
    $resultado = $lista->ListaEmpresa();
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
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
            </nav>
        </header>
        <p class="fs-1">Lista de Empresas</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><h3>CNPJ</h3></th>
                    <th><h3>Nome/Razão social</h3></th>
                    <th><h3>Telefone</h3></th>
                    <th><h3>Ver arquivos</h3></th>
                    <th><h3>Enviar Arquivo</h3></th>
                </tr>
            </thead>
        </table>
        <?php
        foreach($resultado->fetchALL(PDO::FETCH_ASSOC) as $linha){
            ?>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th><?php echo $linha['cnpj'];?></th>
                        <th><?php echo $linha['nome_empresa'];?></th>
                        <th><?php echo $linha['telefone'];?></th>
                        <th><form action="lista_arquivo.php" method="post">
                            <input type="hidden" name="cnpj" value="<?php echo $linha['cnpj'];?>">
                            <input type="submit" value="ver" class="btn btn-info">
                        </form></th>
                        <th>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="identidade" value="<?php echo $linha['cnpj'];?>">
                            <input type="file" name="arquivo" id="arquivo" class="form-control">
                            <input type="submit" value="enviar" class="btn btn-dark">
                        </form>
                        </th>
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
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>