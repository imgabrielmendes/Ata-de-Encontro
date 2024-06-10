<?php
include 'database.php';
session_start();

$id_ataenviar = $_POST['id_ata'];
$participantesSelecionados = json_decode($_POST['participanteatribu']);

if ($participantesSelecionados !== null) {
    // Inicia a transação
    $conexao->begin_transaction();

    // Prepare o comando SQL de insert
    $inserirSQL = "INSERT INTO participantes (id_ata, participantes) VALUES (?, ?)";
    $stmt = $conexao->prepare($inserirSQL);

    foreach ($participantesSelecionados as $facilitador) {
        $stmt->bind_param("ss", $id_ataenviar, $facilitador);
        $stmt->execute();
    }

    $stmt->close();

    // Verifica se a inserção foi bem-sucedida
    if ($conexao->commit()) {
        echo "Registros inseridos com sucesso.";
    } else {
        // Reverte a transação em caso de erro
        $conexao->rollback();
        echo "Erro ao inserir registros.";
    }

    // Fecha a conexão
    $conexao->close();
} else {
    echo "(X) Algum dos campos está vazio.";
}
?>
