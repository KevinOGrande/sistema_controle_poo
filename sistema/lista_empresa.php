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
        <title>Document</title>
    </head>
    <body>
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
                            <input type="hidden" name="diretorio" value="<?php echo $linha['cnpj'];?>">
                            <input type="submit" value="ver">
                        </form></th>
                        <th>
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="identidade" value="<?php echo $linha['cnpj'];?>">
                            <input type="file" name="arquivo" id="arquivo">
                            <input type="submit" value="enviar">
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