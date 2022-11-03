<?php
require_once 'conexao.php';
require_once 'pessoas.php';

// Criando banco de dados
try{
    $conn = Conexao::conectar();
    $sql = "CREATE DATABASE IF NOT EXISTS meuupdo";
    $conn->exec($sql);
    echo "BANCO DE DADOS CRIADO COM SECESSO <br>";
} catch (PDOException $e){
    echo $e->getMessage();
}
$con = null;
//------------------------------------------------------------------------------------------------------
// Criando tabelas
try {
    $conn = Conexao::conectar();
    $sql = "CREATE TABLE  IF NOT EXISTS pessoas (
        id_pessoa INT(6) AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255),
        idade INT(3),
        data_gegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql);
    echo "Tabela Pessoas criada com sucesso <br>";
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
//------------------------------------------------------------------------------------------------------
// listando via classe
if(isset($_GET['busca'])){
    $palavra = $_GET['busca'];
    try {
        $pessoa = new Pessoa();
        $lista = $pessoa->listarPorNome($palavra);
    }catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    try {
        $pessoa = new Pessoa();
        $lista = $pessoa->listar();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/toast.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <div id="exibe"></div>
        <div class="flex-container space-between" id="container_topo">
          <div>
            <button id="btn_criar"><a href="criar_pessoa.php"><span class="material-symbols-outlined">add</span></a></button>
          </div>  
        
        <div id="campo_pesquisa">
        <form action="index.php" class="flex-container">
                 <input type="search"  name="busca" id="busca">
                 <button type="submit" id="btn_pesquisa">
                    <span class="material-symbols-outlined">search</span>
                 </button>
            </form>
        </div>
        </div>

    <?php if(count($lista)>0): ?>
<div class="flex-container">        
        <table>
            <tr>
                <th>id</th>
                <th>nome</th>
                <th>idade</th>
                <th>registro</th>
            </tr>
            <?php foreach($lista as $item):?>
                <tr>
                    <td><?= $item['id_pessoa']?></td>
                    <td><?= $item['nome']?></td>
                    <td><?= $item['idade']?></td>
                    <td><?= $item['data_registro']?></td>
                </tr>

                <td><a href="editar.php?id_pessoa=<?=$item['id_pessoa']?>"><span class="material-symbols-outlined" id="btn_deletee">edit</span></a></td>
                <td><a href="delete.php?id_pessoa=<?=$item['id_pessoa']?>"><span class="material-symbols-outlined" id="btn_delete">delete</span></a></td>

            <?php endforeach ?>
        </table>
</div>
        <?php else: ?>
            <p>
                Não existem pessoas cadastradas
            </p>
            <?php endif ?>
            <script src="css/js/script.js"></script>
</body>
</html>