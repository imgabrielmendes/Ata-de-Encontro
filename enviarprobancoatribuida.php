<?php
include 'database.php';
session_start();
<<<<<<< HEAD
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
=======

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
>>>>>>> origin/area_desenvolvimento_pedro
        $conexao->rollback();
        echo "Erro ao inserir registros.";
    }

<<<<<<< HEAD
    $stmt->close();
=======
    // Fecha a conexão
>>>>>>> origin/area_desenvolvimento_pedro
    $conexao->close();

} else {
    echo "(X) Algum dos campos está vazio.";
}
?>
