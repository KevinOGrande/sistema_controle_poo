<?php
session_start();
if(isset($_SESSION['login_senai']) && $_SESSION['login_senai'] === true){
    require_once "arquivo.php";
    if(isset($_POST['cnpj'])){
        $lista = new Arquivo($_POST['cnpj']);
        if($resultado = $lista->ListaArquivoEmpresa()){
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
                                        <input type="hidden" name="cnpj" value="<?php echo $_POST['cnpj'];?>">
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
    }elseif(isset($_POST['matricula'])){
        $lista = new Arquivo($_POST['matricula']);
        if($resultado = $lista->ListaArquivoAlunoSolicitacao()){
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
                                    <input type="hidden" name="matricula" value="<?php echo $_POST['matricula'];?>">
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
    }
    
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}
?>