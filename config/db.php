<?php


$servidor = 'localhost';
$usuario = 'root';
$senha = 'root';
$banco = 'Trabalho';

// Conecta-se ao banco de dados MySQL
$mysqli = new mysqli($servidor, $usuario, $senha, $banco);

// Caso algo tenha dado errado, exibe uma mensagem de erro
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());


// funções php
include("function.php");

?>
