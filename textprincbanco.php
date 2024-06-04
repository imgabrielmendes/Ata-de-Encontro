<?php 
include 'database.php';
session_start();

$dbhost = 'localhost';
$dbname = 'atareu';  
$dbuser = 'root';  
$dbpass = '';     

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Recupera o id_ata enviado via POST
$id_ata = $_POST['id_ata'];

// Recupera o texto principal enviado via POST
$textoprincipal = $_POST['textoprincipal'];

// Atualiza o registro na tabela "textoprinc" com o texto principal para o id_ata especificado
$sqlUpdate = "UPDATE textoprinc SET texto_princ = '$textoprincipal' WHERE id_ata = $id_ata";

if ($conn->query($sqlUpdate) === TRUE) {
    echo "O texto foi atualizado com sucesso para o ID $id_ata.";
} else {
    echo "Erro ao atualizar o texto para o ID $id_ata: " . $conn->error;
}

$conn->close();
?>
