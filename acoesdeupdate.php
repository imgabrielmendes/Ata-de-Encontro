<?php
include 'database.php';
// precisa incluir a conexão do outro banco
session_start();

// texto, facili, delibe é de outro banco de dados, precisa fazer a conexão com o outro também para enviar
$hora_inicio = $_POST['hora_inicio'];
$hora_term = $_POST['hora_term'];
$objetivo = $_POST['objetivo'];
$local = $_POST['local'];
$tema = $_POST['tema'];
$texto = $_POST['texto'];
$id_ataenviar = $_POST['id'];

if (!empty($objetivo) && !empty($local) && !empty($hora_inicio) && !empty($hora_term) && !empty($tema)) {
    // Atualização na tabela "assunto" do banco de dados principal
    $enviarbanco_assunto = "UPDATE assunto SET hora_inicial = ?, hora_termino = ?, objetivo = ?, local = ?, tema = ? WHERE id = ?";
    if ($stmt_assunto = $conexao->prepare($enviarbanco_assunto)) {
        $stmt_assunto->bind_param("sssssi", $hora_inicio, $hora_term, $objetivo, $local, $tema, $id_ataenviar);
        $stmt_assunto->execute();
        $stmt_assunto->close();
        echo "Dados atualizados com sucesso na tabela 'assunto' do banco de dados principal!";
    } else {
        echo "Erro ao preparar a consulta SQL para a tabela 'assunto' do banco de dados principal: " . $conexao->error;
    }

    // Atualização na tabela do outro banco de dados
    $enviarbanco_outro = "UPDATE textoprinc SET textoprincipal = ? WHERE id_ata = ?";
    if ($stmt_outro = $conexao_outro->prepare($enviarbanco_outro)) {
        $stmt_outro->bind_param("si", $texto, $id_ataenviar);
        $stmt_outro->execute();
        $stmt_outro->close();
        echo "Dados atualizados com sucesso no outro banco de dados!";
    } else {
        echo "Erro ao preparar a consulta SQL para o outro banco de dados: " . $conexao_outro->error;
    }
} else {
    echo "Algum dos campos está vazio.";
}
