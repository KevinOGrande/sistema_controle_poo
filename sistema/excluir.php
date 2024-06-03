<?php
session_start();
if((isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true)&&(isset($_POST['aluno'])||isset($_POST['empresa'])||isset($_POST['matricula'])||isset($_POST['cnpj']))){
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
            .formulario{
                display:flex;
                flex-direction:column;
                align-items: center;
                justify-content: center;
                margin-top: 10%;
            }
            .fs-1{
                text-align: center;
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
                    <?php
                    if(isset($_POST['aluno'])){
                        ?>
                        <form action="pesquisa.php" method="get">
                            <input type="hidden" name="pesquisa" value="<?php echo $_POST['aluno']?>">
                            <input type="submit" value="voltar" class="btn btn-secondary">
                        </form>
                        <?php
                    }elseif(isset($_POST['empresa'])){
                        ?>
                        <form action="pesquisa.php" method="get">
                            <input type="hidden" name="pesquisa" value="<?php echo $_POST['empresa']?>">
                            <input type="submit" value="voltar" class="btn btn-secondary">
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
        <p class="fs-1">Permissão para Excluir</p>
        <form action="excluir.php" method="post" class="formulario">
            <?php
            if(isset($_POST['aluno'])){
                ?>
                <input type="hidden" name="matricula" value="<?php echo $_POST['aluno'];?>">
                <?php
            }elseif(isset($_POST['empresa'])){
                ?>
                <input type="hidden" name="cnpj" value="<?php echo $_POST['empresa'];?>">
                <?php
            }
            ?>
            <div class="mb-3">
                <label class="form-label">Usuario:</label>
                <input type="text" name="usuario" id="usuario" require class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>           
            <input type="submit" value="excluir" class="btn btn-danger">
        </form>
    </body>
    </html>
    <?php
    if(isset($_POST['usuario'])){
        if(isset($_POST['cnpj'])){
            require_once "empresa.php";
            $excluir = new Empresa($_POST['cnpj']);
            if($resultado = $excluir->ExcluirEmpresa($_POST['usuario'],$_POST['senha'])){
                header("location:index.php");
            }
        }elseif(isset($_POST['matricula'])){
            require_once "aluno.php";
            $excluir = new Aluno($_POST['matricula']);
            if($resultado = $excluir->ExcluirAluno($_POST['usuario'],$_POST['senha'])){
                header("location:index.php");
            }
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>