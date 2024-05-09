<?php
include 'database.php';
session_start();
$id_ata = isset($_GET['updateid']) ? $_GET['updateid'] : null;

$participantesSelecionados = json_decode($_POST['participanteatribu']);

if ($participantesSelecionados !== null) {

    $conexao->begin_transaction();

    // Preparando a query SQL para inserção dos dados
    $enviarbanco = "INSERT INTO ata_has_fac (id_ata, facilitadores) VALUES (?, ?)";
    $stmt = $conexao->prepare($enviarbanco);
    $stmt->bind_param("ss", $id_ata, $facilitador); // Aqui bind_param espera dois valores, então usamos "ss"

    // Loop pelos participantes selecionados para inserir um por um no banco de dados
    foreach ($participantesSelecionados as $facilitador) {
        $stmt->execute(); // Executa a query SQL para cada participante
    }

    if ($stmt) {
        $conexao->commit();
        echo "Registros inseridos com sucesso.";
    } else {
        $conexao->rollback();
        echo "Erro ao inserir registros.";
    }

    $stmt->close();
    $conexao->close();

} else {
    echo "(X) Algum dos campos está vazio.";
}
?>