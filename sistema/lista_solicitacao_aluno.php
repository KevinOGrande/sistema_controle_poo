<?php
session_start();
if((isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true) || (isset($_SESSION['login_aluno']) && $_SESSION['login_aluno'] == true) && isset($_POST['matricula'])){
    require_once "solicitacao.php";
    $solicitacao = new Solicitacao($_POST['matricula']);
    if($lista = $solicitacao->SolicitacaoAluno()){
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
                            <th><h3>ID</h3></th>
                            <th><h3>Matricula</h3></th>
                            <th><h3>Pedido</h3></th>
                            <th><h3>Status Pedido</h3></th>
                            <th><h3>Descrição</h3></th>
                        </tr>
                    </thead>
                </table>
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
                            <th><?php echo $linha['pedido'];?></th>
                            <th><?php echo $linha['descricao'];?></th>
                            <?php
                            if(isset($_SESSION['login_senai'])){
                                if($linha['pedido']!= "carta para estagio optativo" && $linha['pedido']!= "declaracao de matricula" && $linha['status_pedido'] == "Em Analise"){
                                    ?>
                                    <th>
                                        <form action="upload.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="matricula" value="<?php echo $linha['matricula'];?>">
                                            <input type="hidden" name="id" value="<?php echo $linha['id']?>">
                                            <input type="file" name="arquivo" id="arquivo">
                                            <input type="submit" value="enviar">
                                        </form>
                                    </th>
                                    <th>
                                        <form action="mudar_status.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $linha['id']?>">
                                            <select name="status" id="status">
                                                <option value="solicitacao negada">Solicitação Negada</option>
                                            </select>
                                            <input type="submit" value="mudar">
                                        </form>
                                    </th>
                                <?php
                                }elseif($linha['status_pedido']!="Solicitacao negada"){
                                    ?>
                                    <th>
                                        <form action="mudar_status.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $linha['id']?>">
                                            <select name="status" id="status">
                                                <option value="Pronto para retirada">Pronto para Retirada</option>
                                                <option value="Solicitacao negada">Solicitação Negada</option>
                                            </select>
                                            <input type="submit" value="mudar">
                                        </form>
                                    </th>
                                    <?php
                                }
                            }
                            ?>
                        </tr>
                    </tbody>
                    <br>
                    <?php
                }
                ?>
            </body>
            </html>
        <?php
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>