<?php
include 'database.php';
session_start();

// $id_ata =$_GET['updateid'];

$id_ataenviar = $_POST['id_ata'];
var_dump($id_ataenviar);
$participantesSelecionados = json_decode($_POST['participanteatribu']);

if ($participantesSelecionados !== null) {
    // Inicia a transação
    $conexao->begin_transaction();

    
    foreach ($participantesSelecionados as $facilitador) {

        $enviarbanco = "INSERT INTO participantes (id_ata,participantes) VALUES (?,?)";
        $stmt = $conexao->prepare($enviarbanco);
        
       
        $stmt->bind_param("ss", $id_ataenviar, $facilitador);
        $stmt->execute(); 
        $stmt->close(); // Fecha a declaração após cada execução
    }

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
