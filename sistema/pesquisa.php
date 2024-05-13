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
            <title>Document</title>
        </head>
        <body>
            <p><?php echo $resutado['cnpj'];?></p>
            <p><?php echo $resutado['nome_empresa'];?></p>
            <p><?php echo $resutado['telefone'];?></p>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="identidade" value="<?php echo $_GET['pesquisa'];?>">
                <input type="file" name="arquivo" id="arquivo">
                <input type="submit" value="enviar">
            </form>
            <form action="excluir.php" method="post">
                <input type="hidden" name="identidade" value="<?php echo $_GET['pesquisa'];?>">
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
                    <title>Document</title>
                </head>
                <body>
                    <p><?php echo $resutado['matricula'];?></p>
                    <p><?php echo $resutado['nome'];?></p>
                    <p><?php echo $resutado['status_aluno'];?></p>
                    
                    <form action="excluir_aluno.php" method="post">
                        <input type="hidden" name="identidade" value="<?php echo $_GET['pesquisa'];?>">
                        <input type="submit" value="excluir">
                    </form>
                    <form action="atualiza.php" method="post">
                        <input type="hidden" name="matricula" value="<?php echo $resutado['matricula'];?>">
                        <input type="hidden" name="usuario" value="<?php echo $resutado['usuario'];?>">
                        <input type="hidden" name="senha" value="<?php echo $resutado['senha'];?>">
                        <input type="hidden" name="telefone" value="<?php echo $resutado['telefone'];?>">
                        <input type="submit" value="atualizar">
                    </form>
                    <form action="lista_arquivo.php" method="post">
                        <input type="hidden" name="diretorio" value="<?php echo $resutado['matricula'];?>">
                        <input type="submit" value="Lista de Faltas">
                    </form>
                    <form action="lista_solicitacao_aluno.php" method="post">
                        <input type="hidden" name="matricula" value="<?php echo $resutado['matricula']?>">
                        <input type="submit" value="lista solicitação">
                    </form>
                    <form action="" method="post">
                        <input type="hidden" name="matricula" value="<?php echo $resutado['matricula']?>">
                        <input type="submit" value="Justificativas de faltas">
                    </form>
                </body>
                </html>
            <?php
        }
    }
}else{
    header("location:login.php");
}  
?>