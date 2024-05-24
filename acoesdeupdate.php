<?php
include 'database.php';
session_start();

$objetivo = $_POST['objetivo'];
$local = $_POST['local'];
$id_ataenviar = $_POST['id'];

if (!empty($objetivo) && !empty($local)) {
    $enviarbanco = "UPDATE assunto SET objetivo = ?, local = ? WHERE id = ?";
    if ($stmt = $conexao->prepare($enviarbanco)) {
        $stmt->bind_param("ssi", $objetivo, $local, $id_ataenviar);
        $stmt->execute();
        $stmt->close();
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao preparar a consulta SQL: " . $conexao->error;
    }
} else {
    echo "(X) O objetivo ou o local não foram enviados ou estão vazios.";
}
?>

