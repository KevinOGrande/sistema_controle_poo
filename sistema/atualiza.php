<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
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
            .container{
                margin-left: 80%;
                margin-top: -3%;
            }
            .formulario{
                display:flex;
                flex-direction:column;
                align-items: center;
                justify-content: center;
            }
            .mb-3{
                width:20%;
            }
            .form-select{
            width:20%;
            }
            .botao{
                margin-top: 1%;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <header>
            <nav class="navbar body-tertiary">
                <img src="image/senai_logo1.png" alt="">
                <div class="container">
                    <?php
                    if(isset($_POST['matricula'])){
                        ?>
                        <form action="pesquisa.php" method="get">
                            <input type="hidden" name="pesquisa" value="<?php echo $_POST['matricula'];?>">
                            <input type="submit" value="Voltar" class="btn btn-secondary">
                        </form>
                        <?php
                    }elseif(isset($_POST['matricula'])){
                        ?>
                        <form action="pesquisa.php" method="get">
                            <input type="hidden" name="pesquisa" value="<?php echo $_POST['cnpj'];?>">
                            <input type="submit" value="Voltar" class="btn btn-secondary">
                        </form>
                        <?php
                    }
                    ?>
                </div>
            </nav>
        </header>
        <p class="fs-1">Atualizar cadastro</p>
        <?php
        if(isset($_POST['cnpj'])){
            ?>
            <form action="atualiza2.php" method="post" class="formulario">
                <input type="hidden" name="cnpj" value="<?php echo $_POST['cnpj'];?>">
                <input type="text" name="usuario" value="<?php echo $_POST['usuario'];?>" require class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <input type="text" name="senha" value="<?php echo $_POST['senha'];?>" require class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <input type="text" name="telefone" value="<?php echo $_POST['telefone'];?>" require class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <input type="submit" value="atualizar">
            </form>
            <?php
        }elseif(isset($_POST['matricula'])){
            ?>
            <form action="atualiza2.php" method="post" class="formulario">
                <input type="hidden" name="matricula" value="<?php echo $_POST['matricula'];?>">
                <div class="mb-3">
                    <input type="text" name="usuario" value="<?php echo $_POST['usuario'];?>" require class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <input type="text" name="senha" value="<?php echo $_POST['senha'];?>" require class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <input type="text" name="telefone" value="<?php echo $_POST['telefone'];?>" require class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <select name="status" id="status" class="form-select">
                    <option value="Aluno">Aluno</option>
                    <option value="Ex-Aluno">Ex-Aluno</option>
                </select>
                <div class="botao">
                    <input type="submit" value="atualizar" class="btn btn-success">
                </div>
                
            </form>
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