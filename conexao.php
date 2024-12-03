<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Dados de conexão com o banco de dados
$servidor = 'localhost';
$usuario = 'bryan';
$senha = '1303';
$banco = 'vendaCarros';

// Conectar ao MySQL
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


//$conn->close();





