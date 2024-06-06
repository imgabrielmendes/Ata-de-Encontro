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

$id_ata = $_POST['id_ata'];
$conteudo = $_POST['conteudo'];

if ($id_ata && $conteudo) {
    // Inicia a transação
    $conn->begin_transaction();

    try {
        $deleteQuery = "DELETE FROM deliberacoes WHERE id_ata = ? AND deliberacoes = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param("is", $id_ata, $conteudo);
        $stmt->execute();
        $stmt->close();

        // Comita a transação
        $conn->commit();
        echo "Deliberação excluída com sucesso.";
    } catch (Exception $e) {
        // Em caso de erro, reverte a transação
        $conn->rollback();
        echo "Erro ao excluir deliberação: " . $e->getMessage();
    }
} else {
    echo "Dados insuficientes para excluir deliberação.";
}

$conn->close();
?>
