<?php
session_start();
if((isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true)&&(isset($_POST['aluno'])||isset($_POST['empresa'])||isset($_POST['matricula'])||isset($_POST['cnpj']))){
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form action="excluir.php" method="post">
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
            <input type="text" name="usuario" id="usuario" require>            
            <input type="password" name="senha" id="senha">
            <input type="submit" value="excluir">
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