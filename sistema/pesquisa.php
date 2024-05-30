<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "empresa.php";
    $pesquisa = new Empresa($_GET['pesquisa']);
    if($resutado = $pesquisa->PesquisaEmpresa()){
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
                </nav>
            </header>
            <p><?php echo $resutado['cnpj'];?></p>
            <p><?php echo $resutado['nome_empresa'];?></p>
            <p><?php echo $resutado['telefone'];?></p>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="identidade" value="<?php echo $_GET['pesquisa'];?>">
                <input type="file" name="arquivo" id="arquivo">
                <input type="submit" value="enviar">
            </form>
            <form action="excluir.php" method="post">
                <input type="hidden" name="empresa" value="<?php echo $_GET['pesquisa'];?>">
                <input type="submit" value="excluir">
            </form>
            <form action="atualiza.php" method="post">
                <input type="hidden" name="cnpj" value="<?php echo $resutado['cnpj'];?>">
                <input type="hidden" name="usuario" value="<?php echo $resutado['usuario'];?>">
                <input type="hidden" name="senha" value="<?php echo $resutado['senha'];?>">
                <input type="hidden" name="telefone" value="<?php echo $resutado['telefone'];?>">
                <input type="submit" value="atualizar">
            </form>
            <form action="lista_arquivo.php" method="post">
                <input type="hidden" name="cnpj" value="<?php echo $resutado['cnpj'];?>">
                <input type="submit" value="ver">
            </form>
        </body>
        </html>
        <?php
    }else{
        require_once "aluno.php";
        $pesquisa=null;
        $pesquisa = new Aluno($_GET['pesquisa']);
        if($resutado = $pesquisa->PesquisaAluno()){
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
                        .botoes{
                            margin-top: 10%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        }
                        .formulario{
                            margin-left: 2%;
                        }
                    </style>
                </head>
                <body>
                    <header>
                        <nav class="navbar body-tertiary">
                            <img src="image/senai_logo1.png" alt="">
                        </nav>
                    </header>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><h3>Matricula</h3></th>
                                <th><h3>Nome</h3></th>
                                <th><h3>Status</h3></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?php echo $resutado['matricula'];?></th>
                                <th><?php echo $resutado['nome'];?></th>
                                <th><?php echo $resutado['status_aluno'];?></th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="botoes">
                        <form action="excluir.php" method="post" class="formulario">
                            <input type="hidden" name="aluno" value="<?php echo $_GET['pesquisa'];?>">
                            <input type="submit" value="excluir" class="btn btn-danger">
                        </form>
                        <form action="atualiza.php" method="post" class="formulario">
                            <input type="hidden" name="matricula" value="<?php echo $resutado['matricula'];?>">
                            <input type="hidden" name="usuario" value="<?php echo $resutado['usuario'];?>">
                            <input type="hidden" name="senha" value="<?php echo $resutado['senha'];?>">
                            <input type="hidden" name="telefone" value="<?php echo $resutado['telefone'];?>">
                            <input type="submit" value="atualizar" class="btn btn-info">
                        </form>
                        <form action="lista_arquivo.php" method="post" class="formulario">
                            <input type="hidden" name="diretorio" value="<?php echo $resutado['matricula'];?>">
                            <input type="submit" value="Lista de Faltas" class="btn btn-secondary">
                        </form>
                        <form action="lista_solicitacao_aluno.php" method="post" class="formulario">
                            <input type="hidden" name="matricula" value="<?php echo $resutado['matricula']?>">
                            <input type="submit" value="lista solicitação" class="btn btn-dark">
                        </form>
                        <form action="lista_justificativa.php" method="post" class="formulario">
                            <input type="hidden" name="matricula" value="<?php echo $resutado['matricula']?>">
                            <input type="submit" value="Justificativas de faltas" class="btn btn-dark">
                        </form>
                    </div>
                </body>
                </html>
            <?php
        }else{
            header("location:index.php");
        }
    }
}else{
    header("location:login.php");
}  
?>