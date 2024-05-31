<?php
include 'database.php';
session_start();

//Falta atualizar deliberadores. Deliberações está atualizando, porém em todos os campos.

$data = $_POST['data'];
$hora_inicio = $_POST['hora_inicio'];
$hora_term = $_POST['hora_term'];
$objetivo = $_POST['objetivo'];
$local = $_POST['local'];
$tema = $_POST['tema'];
$texto = $_POST['texto'];
$deliberador = $_POST['deliberador'];
$deliberacao = $_POST['deliberacao'];
$facilitadoresSelecionados = $_POST['facilitadores'];
$id_ataenviar = $_POST['id'];
$iddelibe = $_POST['iddelibe'];

var_dump("aaaaaaaaaaaaaaaa");
    var_dump($iddelibe);




    




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
$sql_delete_facilitadores = "DELETE FROM ata_has_fac WHERE id_ata = ?";
    if ($stmt_delete_facilitadores = $conexao->prepare($sql_delete_facilitadores)) {
        $stmt_delete_facilitadores->bind_param("i", $id_ataenviar); 
        $stmt_delete_facilitadores->execute();
        $stmt_delete_facilitadores->close();
    } else {
        echo "Erro ao preparar a consulta SQL para excluir os facilitadores associados: " . $conexao->error;
    }

    // Em seguida, insira os facilitadores selecionados
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
