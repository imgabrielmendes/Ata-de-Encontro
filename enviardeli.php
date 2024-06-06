<?php
include 'database.php';
session_start();

$dbhost = 'localhost';
$dbname = 'atareu';
$dbuser = 'root';
$dbpass = '';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Recupera o id_ata do POST
$id_ata = $_POST['id_ata'];
$deliberadoresSelecionados = json_decode($_POST['deliberaDores'], true);
$newItem = $_POST['newItem'];

if ($id_ata && $deliberadoresSelecionados && $newItem) {
    // Inicia a transação
    $conn->begin_transaction();

    try {
        foreach ($deliberadoresSelecionados as $deliberadorValue) {
            $enviarbanco = "INSERT INTO deliberacoes (id_ata, deliberacoes, deliberadores) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($enviarbanco);
            $stmt->bind_param("iss", $id_ata, $newItem, $deliberadorValue);
            $stmt->execute();
            $stmt->close();
        }

        // Comita a transação
        $conn->commit();
        echo "Deliberações inseridas com sucesso.";
    } catch (Exception $e) {
        // Em caso de erro, reverte a transação
        $conn->rollback();
        echo "Erro ao inserir deliberações: " . $e->getMessage();
    }
} else {
    echo "Dados insuficientes para inserir deliberações.";
}

$conn->close();
?>
