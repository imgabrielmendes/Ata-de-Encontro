<?php
include 'database.php';
session_start();

$facilitadoresSelecionados = json_decode($_POST['facilitadores']);

$data = $_POST['datainic'] . ' ' . $_POST['horai'] . ':00';
$conteudo = $_POST['texto'];
$objetivoSelecionado = $_POST['objetivos'];
$local = $_POST['local'];
$horaterm = $_POST['horat'] . ':00';

if ($facilitadoresSelecionados !== null && $data !== "" && $horaterm !== "" && $conteudo !== "" && $objetivoSelecionado !== "" && $local !== "") {

    $conexao->begin_transaction();

    $enviarbanco = "INSERT INTO assunto (data_solicitada, tema, objetivo, hora_inicial, hora_termino, local, status) VALUES (?, ?, ?, ?, ?, ?, 'ABERTA')";
    
    $stmt = $conexao->prepare($enviarbanco);
    $stmt->bind_param("ssssss", $data, $conteudo, $objetivoSelecionado, $data, $horaterm, $local);
    
    $stmt->execute();

    if ($stmt) {
        
        $id_ata = $conexao->insert_id;

        foreach ($facilitadoresSelecionados as $facilitador) {

            $enviarbanco2 = "INSERT INTO ata_has_fac (id_ata, facilitadores) VALUES (?, ?)";
            $stmt2 = $conexao->prepare($enviarbanco2);
            $stmt2->bind_param("ss", $id_ata, $facilitador);
            $stmt2->execute();

            if ($stmt2) {
                echo "Registro inserido com sucesso na tabela ata_has_fac para o facilitador: $facilitador <br>";
            } else {
                echo "Erro ao inserir registro na tabela ata_has_fac para o facilitador: $facilitador <br>";
            }

            $stmt2->close();
        }

        $conexao->commit();
        echo "Registro inserido com sucesso para o facilitador: $facilitador <br>";
    } else {
        $conexao->rollback();
        echo "Erro ao inserir registro <br>";
    }

    $stmt->close();
    $conexao->close();

} else {
    echo "(X) Algum dos campos está vazio.";
}
if (isset($_POST['id_ata']) && isset($_POST['participante'])) {
    // Obtém o ID da última ATA
    $id_ultima_ata = $puxarform->puxarId();
    
    if ($id_ultima_ata) {
        $participante = $_POST['participante'];
        $sql = "SELECT id FROM facilitadores WHERE nome_facilitador = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $participante);
        $stmt->execute();
        $stmt->bind_result($participante_id);
        $stmt->fetch();
        $stmt->close();
        
        if ($participante_id) {
            $sql = "DELETE FROM participantes WHERE id_ata = ? AND participante_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $id_ultima_ata, $participante_id);

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
        echo json_encode(['success' => false, 'message' => 'ID da última ATA não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID da ATA ou participante não fornecido.']);
}

?>
