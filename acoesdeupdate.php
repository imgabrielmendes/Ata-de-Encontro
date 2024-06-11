<?php
include 'database.php';

session_start();


$data = $_POST['data'];
$hora_inicio = $_POST['hora_inicio'];
$hora_term = $_POST['hora_term'];
$objetivo = $_POST['objetivo'];
$local = $_POST['local'];
$tema = $_POST['tema'];
$texto = $_POST['texto'];
$id_ataenviar = $_POST['id'];
$facilitadoresSelecionados = $_POST['facilitadoresSelecionados'];
$deliberacoes = $_POST['deliberacoes'];
$iddelibe = $_POST['iddelibe'];
var_dump($deliberacoes);
var_dump($iddelibe);

if (!empty($objetivo) && !empty($local) && !empty($hora_inicio) && !empty($hora_term) && !empty($tema)) {

    $enviarbanco_assunto = "UPDATE assunto SET data_solicitada = ?, hora_inicial = ?, hora_termino = ?, objetivo = ?, local = ?, tema = ? WHERE id = ?";
    if ($stmt_assunto = $conexao->prepare($enviarbanco_assunto)) {
        $stmt_assunto->bind_param("ssssssi", $data, $hora_inicio, $hora_term, $objetivo, $local, $tema, $id_ataenviar);
        $stmt_assunto->execute();
        $stmt_assunto->close();
        echo "Dados atualizados com sucesso na tabela 'assunto' do banco de dados principal!";
    } else {
        echo "Erro ao preparar a consulta SQL para a tabela 'assunto' do banco de dados principal: " . $conexao->error;
    }


    $enviarbanco_outro = "UPDATE textoprinc SET texto_princ = ? WHERE id_ata = ?";
    if ($stmt_outro = $conexao->prepare($enviarbanco_outro)) {
        $stmt_outro->bind_param("si", $texto, $id_ataenviar);
        $stmt_outro->execute();
        $stmt_outro->close();
        echo "Dados atualizados com sucesso no outro banco de dados!";
    } else {
        echo "Erro ao preparar a consulta SQL para o outro banco de dados: " . $conexao->error;
    }
} else {
    echo "Algum dos campos está vazio.";
}

foreach ($iddelibe as $id) {
    $enviarbanco_deliberador = "UPDATE deliberacoes SET deliberacoes = ? WHERE id_ata = ? AND id = ? ";
    if ($stmt_deliberador = $conexao->prepare($enviarbanco_deliberador)) {
        $stmt_deliberador->bind_param("sii", $deliberacoes, $id_ataenviar, $id); 
        $stmt_deliberador->execute();
        $stmt_deliberador->close();
        echo "Dados atualizados com sucesso na tabela 'deliberacoes'!";
    } else {
        echo "Erro ao preparar a consulta SQL para a tabela 'deliberacoes': " . $conexao->error;
    }}

foreach ($facilitadoresSelecionados as $facilitador) {

    $sql_insert_facilitador = "INSERT INTO ata_has_fac (id_ata, facilitadores) VALUES (?, ?)";
    if ($stmt_insert_facilitador = $conexao->prepare($sql_insert_facilitador)) {
        $stmt_insert_facilitador->bind_param("ii", $id_ataenviar, $facilitador); 
        $stmt_insert_facilitador->execute();
        $stmt_insert_facilitador->close();
    } else {
        echo "Erro ao preparar a consulta SQL para inserir facilitador: " . $conexao->error;
    }
}

echo "Dados atualizados com sucesso na tabela 'facilitadores'!";