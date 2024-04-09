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

    // Inserir dados na tabela 'assunto'
    $enviarbanco = "INSERT INTO assunto (facilitador , data_solicitada, tema,objetivo , hora_inicial, hora_termino, local, status) VALUES ('$facilitadoresSelecionados','$data','$conteudo','$objetivoSelecionado', '$data', '$horaterm','$local','ABERTA')";

    $stmt = $conexao->prepare($enviarbanco);
    $stmt->execute();

    // Pegar o ID inserido na primeira consulta
    
    $id_assunto = $conexao->insert_id;

    $enviarbanco2 = "INSERT INTO ata_has_fac (id_ata, facilitadores) VALUES ('$id_assunto', '$facilitadoresSelecionados')";
    $stmt2 = $conexao->prepare($enviarbanco2);
    $stmt2->execute();

    if ($stmt && $stmt2) {
        echo "(3) RECEBEU E ENVIOU PRO BANCO";
    } else {
        echo "(X) A marcação do AJAX não foi identificada";
    }

    $stmt->close();
    $stmt2->close();

    } 
       else { echo "(X) Algum dos campos está vazio.";
    }

?>
