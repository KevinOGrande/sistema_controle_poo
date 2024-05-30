<?php
session_start();
if(isset($_SESSION['login_aluno']) && $_SESSION['login_aluno'] == true){
    require_once "solicitacao.php";
    $matricula = $_SESSION['matricula'];
    $solicitacao = new Solicitacao($matricula);
    if($resultado = $solictacao->SolicitacaoAluno()){
        $arquivo = dir("C:/xampp/htdocs/estudo/sistema_controle_poo/diretorio_aluno/".$matricula."/solicitacao");
        while(($nome_arquivo = $arquivo->read()) !== false){
            if($nome_arquivo!=="." && $nome_arquivo!==".."){
                $url = "http://localhost/estudo/sistema_controle_poo/diretorio_aluno/".$matricula."/solicitacao/".$nome_arquivo;
                foreach($resultado->fetchALL(PDO::FETCH_ASSOC) as $linha){

                }
            ?>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th><?php echo $nome_arquivo;?></th>
                            <th class="botao_download"><a href=<?php echo $url;?> download="<?php echo $nome_arquivo;?>" class="btn btn-success">Download</a></th>
                        </tr>
                    </tbody>
                </table>
                
                <br>
            <?php
            }
        }
    }
}else{
    /* Caso a sessão não for iniciada ou o parametro de sessão estiver incorreto, o usuario sera redirecionado para a pagina de login */
    header("location:login.php");
}

?>