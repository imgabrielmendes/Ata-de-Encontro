<?php
include 'database.php';
// precisa incluir a conexão do outro banco
session_start();

//Falta atualizar deliberadores. Deliberações está atualizando, porém em todos os campos.

$data = $_POST['data'];
$hora_inicio = $_POST['hora_inicio'];
$hora_term = $_POST['hora_term'];
$objetivo = $_POST['objetivo'];
$local = $_POST['local'];
$tema = $_POST['tema'];
$texto = $_POST['texto'];
$id_ataenviar = $_POST['id'];

if (!empty($objetivo) && !empty($local) && !empty($hora_inicio) && !empty($hora_term) && !empty($tema) ) {
    // Atualização na tabela "assunto" do banco de dados principal
    $enviarbanco_assunto = "UPDATE assunto SET data_solicitada = ?, hora_inicial = ?, hora_termino = ?, objetivo = ?, local = ?, tema = ? WHERE id = ?";
    if ($stmt_assunto = $conexao->prepare($enviarbanco_assunto)) {
        $stmt_assunto->bind_param("ssssssi", $data, $hora_inicio, $hora_term, $objetivo, $local, $tema, $id_ataenviar);
        $stmt_assunto->execute();
        $stmt_assunto->close();
        echo "Dados atualizados com sucesso na tabela 'assunto' do banco de dados principal!";
    } else {
        echo "Erro ao preparar a consulta SQL para a tabela 'assunto' do banco de dados principal: " . $conexao->error;
    }

    // Atualização na tabela "textoprinc"
    $enviarbanco_outro = "UPDATE textoprinc SET texto_princ = ? WHERE id_ata = ?";
    if ($stmt_outro = $conexao->prepare($enviarbanco_outro)) {
        $stmt_outro->bind_param("si", $texto, $id_ataenviar); 
        $stmt_outro->execute();
        $stmt_outro->close();
        echo "Dados atualizados com sucesso na tabela 'textoprinc'!";
    } else {
        echo "Erro ao preparar a consulta SQL para a tabela 'textoprinc': " . $conexao->error;
    }

  // Atualização na tabela "deliberacoes" para cada ID de deliberação
foreach ($iddelibe as $deliberacoes) {
    $enviarbanco_deliberacoes = "UPDATE deliberacoes SET deliberacoes = ? WHERE id_ata = ?";
    if ($stmt_deliberacoes = $conexao->prepare($enviarbanco_deliberacoes)) {
        $stmt_deliberacoes->bind_param("si", $deliberacao, $id_ataenviar);
        $stmt_deliberacoes->execute();
        $stmt_deliberacoes->close();
        echo "Dados atualizados com sucesso na tabela 'deliberacoes' para o ID de deliberação $deliberacoes!<br>";
    } else {
        echo "Erro ao preparar a consulta SQL para a tabela 'deliberacoes' com o ID de deliberação $deliberacoes: " . $conexao->error . "<br>";
    }
}

    
    $enviarbanco_deliberador = "UPDATE facilitadores SET nome_facilitador = ? WHERE id = ?";
    if ($stmt_deliberador = $conexao->prepare($enviarbanco_deliberador)) {
        $stmt_deliberador->bind_param("si", $deliberador, $id_ataenviar); 
        $stmt_deliberador->execute();
        $stmt_deliberador->close();
        echo "Dados atualizados com sucesso na tabela 'facilitadores'!";
    } else {
        echo "Erro ao preparar a consulta SQL para a tabela 'facilitadores': " . $conexao->error;
    }
}
