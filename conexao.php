<?php 

$servename = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'atareu';

// Conectar ao banco de dados
$conexao = new mysqli($servename, $dbusername, $dbpassword, $dbname);

// Verificar a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}



?>