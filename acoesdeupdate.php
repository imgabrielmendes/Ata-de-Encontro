<?php
include 'database.php';
session_start();

    $objetivo = $_POST['objetivo'];
    $local = $_POST['local'];
  
    $id_ataenviar = $_POST['id']; 
    var_dump($id_ataenviar);
    if ($objetivo != "" && $local != "") {
        
        $enviarbanco = "UPDATE assunto SET objetivo = ?, local= ? WHERE id = ?";

        $stmt = $conexao->prepare($enviarbanco);
        $stmt->bind_param("ssi", $objetivo, $local, $id_ataenviar); 
        $stmt->execute(); 
        $stmt->close(); 
        echo "Dados atualizados com sucesso!";
        if ($stmt === false) {
            echo "Erro ao preparar a consulta SQL: " . $conexao->error;

        } else {
            $stmt->bind_param("ssi", $objetivo, $local, $id_ataenviar); 
            $stmt->execute(); 
            $stmt->close(); 
            echo "Dados atualizados com sucesso!";
        }

    } else {
        echo "(X) O ID não foi enviado ou está vazio.";
    }

