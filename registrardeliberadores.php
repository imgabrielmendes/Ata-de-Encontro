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

$id_ata = $_POST['id_ata']; // Recebe o id_ata enviado via POST

if (!empty($id_ata)) { // Verifica se o id_ata não está vazio
    $deliberadoresSelecionados = json_decode($_POST['deliberaDores'], true);
    $newItem = $_POST['newItem'];

    foreach ($deliberadoresSelecionados as $deliberadorValue) {
        $enviarbanco = "INSERT INTO deliberacoes (id_ata, deliberacoes, deliberadores) VALUES ('$id_ata', '$newItem', '$deliberadorValue')";
        $alterarstatus = "UPDATE assunto SET status = 'FECHADA' WHERE id = $id_ata";

        if ($conn->query($enviarbanco) === TRUE) {
            echo "Novo registro inserido com sucesso para o deliberador $deliberadorValue.<br>";
        } else {
            echo "Erro ao inserir registro para o deliberador $deliberadorValue: " . $conn->error . "<br>";
        }

        if ($conn->query($alterarstatus) === TRUE) {
            echo "Status da tarefa atualizado para 'FECHADA' com sucesso para o deliberador $deliberadorValue.<br>";
        } else {
            echo "Erro ao atualizar status da tarefa para 'FECHADA' para o deliberador $deliberadorValue: " . $conn->error . "<br>";
        }
    }
} else {
    echo "ID da ATA não recebido.<br>";
}


$conn->close();
?>
