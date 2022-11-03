<?php 
require_once 'pessoas.php';
require_once 'conexao.php';

$id_pessoa = $_GET['id_pessoa'];

try{
$pessoa = new Pessoa($id_pessoa);
$pessoa->deletar();

    setcookie("deletado", true);
    header("Location: index.php");
} catch (PDOException $e) {
    echo $query . "<br>" . $e->getMessage();
}


?>