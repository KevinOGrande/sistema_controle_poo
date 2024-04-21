<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
    $lista = new Arquivo($_POST['diretorio']);
    if($resultado = $lista->ListaArquivo()){
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
                                    <input type="hidden" name="diretorio" value="<?php echo $_POST['diretorio'];?>">
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
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>