<?php
include 'database.php';
session_start();

$dbhost = 'localhost';
$dbname = 'atareu';
$dbuser = 'root';
$dbpass = '';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$id_ata = $_POST['id_ata'];
$status = $_POST['status'];

$sql = "UPDATE assunto SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $status, $id_ata);

if ($stmt->execute()) {
    echo "Status atualizado com sucesso.";
} else {
    echo "Erro ao atualizar status: " . $stmt->error;
}

$stmt->close();
$conn->close();


?>