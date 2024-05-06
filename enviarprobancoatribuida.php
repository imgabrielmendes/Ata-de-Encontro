<?php
include 'database.php';
include 'pagatribuida.php';
session_start();
$id = isset($_GET['updateid']) ? $_GET['updateid'] : null;
print_r($id);
$participantesSelecionados = json_decode($_POST['participanteatribu']);
var_dump("string jfjfff");
if ($participantesSelecionados !== null) {


    $conexao->begin_transaction();

    $enviarbanco = "INSERT INTO ata_has_fac (id_ata) VALUES (?)";
    
    $stmt = $conexao->prepare($enviarbanco);
    $stmt->bind_param("ssssss", $participantesSelecionados);
    
    $stmt->execute();
   

    if ($stmt) {
        
        $id_ata = $conexao->insert_id;

        foreach ($participantesSelecionados as $facilitador) {

            $enviarbanco2 = "INSERT INTO ata_has_fac ( facilitadores) VALUES (?, ?) ";
            $stmt2 = $conexao->prepare($enviarbanco2);
            $stmt2->bind_param("ss",  $facilitador);
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




?>
