<?php
require_once "aluno.php";
$pesquisa=null;
$pesquisa = new Aluno($_GET['pesquisa']);
$resutado = $pesquisa->PesquisaAluno(); 
if($resutado){
    echo $resutado['nome'];
}


?>