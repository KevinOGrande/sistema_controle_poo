<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "solicitacao.php";
    $solicitacao = new Solicitacao(" ");
    if($lista = $solicitacao->ListaSolicitacao()){
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
            .form-select{
                width:50%;
            }
            .botao{
                margin-top: 1%;
                align-items: center;
            }
            .fs-1{
                text-align: center;
            }
            th{
                width: 10%;
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
        <p class="fs-1">Lista de Solicitações</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><h3>ID</h3></th>
                        <th><h3>Matricula</h3></th>
                        <th><h3>Pedido</h3></th>
                        <th><h3>Status Pedido</h3></th>
                        <th><h3>Descrição</h3></th>
                        <th><h3>Mudar Status</h3></th>
                        <th><h3>Enviar documento</h3></th>
                    </tr>
                </thead>
                <br>
                <?php
                foreach($lista->fetchAll(PDO::FETCH_ASSOC) as $linha){
                    ?>
                    <tbody>
                        <tr>
                            <th><?php echo $linha['id'];?></th>
                            <th><?php echo $linha['matricula'];?></th>
                            <th><?php echo $linha['pedido'];?></th>
                            <th><?php echo $linha['status_pedido'];?></th>
                            <th><?php echo $linha['descricao'];?></th>
                            <th>
                                <form action="mudar_status.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $linha['id']?>">
                                    <select name="status" id="status" class="form-select">
                                        <option value="Pronto para retirada">Pronto para Retirada</option>
                                        <option value="Solicitacao negada">Solicitação Negada</option>
                                    </select>
                                    <input type="submit" value="mudar" class="btn btn-dark">
                                </form>
                            </th>
                            <?php
                            if($linha['pedido']!= "carta para estagio optativo" && $linha['pedido']!= "declaracao de matricula" && $linha['status_pedido'] == "Em Analise"){
                                ?>
                                <th>
                                    <form action="upload.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="matricula" value="<?php echo $linha['matricula'];?>">
                                        <input type="hidden" name="id" value="<?php echo $linha['id']?>">
                                        <input type="file" name="arquivo" id="arquivo" class="form-control">
                                        <input type="submit" value="enviar" class="btn btn-dark">
                                    </form>
                                </th>
                            <?php
                            }else{
                                ?>
                                <th> </th>
                                <?php
                            }
                            ?>
                        </tr>
                    </tbody>
                <?php
                }
                ?>
            </table>
            <br>
    </body>
    </html>
        <?php
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>