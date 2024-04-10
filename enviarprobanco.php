<?php
include 'database.php';
session_start();

$facilitadoresSelecionados = $_POST['facilitadores'];
$data = $_POST['datainic'] . ' ' . $_POST['horai'] . ':00';
$conteudo = $_POST['texto'];
$objetivoSelecionado = $_POST['objetivos'];
$local = $_POST['local'];
$horaterm = $_POST['horat'] . ':00';

if ($facilitadoresSelecionados !== "" && $data !== "" && $horaterm !== "" && $conteudo !== "" && $objetivoSelecionado !== "" && $local !== "") {

    $enviarbanco = "INSERT INTO assunto (facilitador , data_solicitada, tema,objetivo , hora_inicial, hora_termino, local, status) VALUES ('$facilitadoresSelecionados','$data','$conteudo','$objetivoSelecionado', '$data', '$horaterm','$local','ABERTA')";
    $stmt = $conexao->prepare($enviarbanco);
    $stmt->execute();

    $id_assunto = $conexao->insert_id;

    foreach ($facilitadoresSelecionados as $facilitador) {
        $enviarbanco2 = "INSERT INTO ata_has_fac (id_ata, facilitadores) VALUES ('$id_assunto', '$facilitador')";
        $stmt2 = $conexao->prepare($enviarbanco2);
        $stmt2->execute();
        $stmt2->close();
    }

    if ($stmt) {
        echo "(3) RECEBEU E ENVIOU PRO BANCO";
    } else {
        echo "(X) A marcação do AJAX não foi identificada";
    }

    $stmt->close();
} else {
    echo "(X) Algum dos campos está vazio.";
}

?>
