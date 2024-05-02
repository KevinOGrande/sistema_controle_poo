<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="cadaluno.php" method="get">
        <input type="text" name="matricula" id="matricula">
        <input type="text" name="nome" id="nome">
        <input type="text" name="telefone" id="telefone">
        <input type="text" name="usuario" id="usuario">
        <input type="password" name="senha" id="senha">
        <select name="status" id="status">
            <option value="aluno">Aluno</option>
            <option value="ex_aluno">Ex Aluno</option>
        </select>
        <input type="submit" value="cadastrar">
    </form>
</body>
</html>
<?php

if(isset($_GET['matricula'])){
    require_once "aluno.php";
    $cadastro = new Aluno($_GET['matricula']);
    if($cadastro->CadAluno($_GET['nome'],$_GET['usuario'],$_GET['senha'],$_GET['telefone'],$_GET['status'])){
        echo "Cadastrado";
    }
    
    
}

?>