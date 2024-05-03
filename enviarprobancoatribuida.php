<?php
include 'database.php';
session_start();

$participantesSelecionados = json_decode($_POST['participanteatribu']);

$id = $_GET['updateid'];
echo($id);
if ($participantesSelecionados !== null) {

   

    if ($stmt) {
        
        $id_ata = $conexao->insert_id;

        foreach ($participantesSelecionados as $facilitador) {

            $enviarbanco2 = "INSERT INTO ata_has_fac ($id , facilitadores) VALUES (?, ?) ";
            $stmt2 = $conexao->prepare($enviarbanco2);
            $stmt2->bind_param("ss", $id,  $facilitador);
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
