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

if (isset($_POST['id_ata']) && isset($_POST['participante'])) {
    $id_ata = $_POST['id_ata'];
    $participante = $_POST['participante'];

    $sql = "SELECT id FROM facilitadores WHERE nome_facilitador = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $participante);
    $stmt->execute();
    $stmt->bind_result($participante_id);
    $stmt->fetch();
    $stmt->close();

    if ($participante_id) {
        $sql = "DELETE FROM participantes WHERE id_ata = ? AND participantes = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_ata, $participante_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Participante excluído com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao excluir participante: ' . $conn->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Participante não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID da ATA ou participante não fornecido.']);
}



$conn->close();
?>
