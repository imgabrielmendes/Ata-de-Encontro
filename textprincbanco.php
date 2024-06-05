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

// Recupera o id_ata enviado via POST
$id_ata = $_POST['id_ata'];

// Recupera o texto principal enviado via POST
$textoprincipal = $_POST['textoprincipal'];

// Verifica se já existe um registro com o id_ata
$sqlCheck = "SELECT COUNT(*) as count FROM textoprinc WHERE id_ata = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("i", $id_ata);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();
$rowCheck = $resultCheck->fetch_assoc();
$stmtCheck->close();

if ($rowCheck['count'] > 0) {
    // Se existir, atualiza o registro
    $sqlUpdate = "UPDATE textoprinc SET texto_princ = ? WHERE id_ata = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("si", $textoprincipal, $id_ata);

    if ($stmtUpdate->execute()) {
        echo "O texto foi atualizado com sucesso para o ID $id_ata.";
    } else {
        echo "Erro ao atualizar o texto para o ID $id_ata: " . $stmtUpdate->error;
    }

    $stmtUpdate->close();
} else {
    // Se não existir, insere um novo registro
    $sqlInsert = "INSERT INTO textoprinc (id_ata, texto_princ) VALUES (?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("is", $id_ata, $textoprincipal);

    if ($stmtInsert->execute()) {
        echo "O texto foi inserido com sucesso para o ID $id_ata.";
    } else {
        echo "Erro ao inserir o texto para o ID $id_ata: " . $stmtInsert->error;
    }

    $stmtInsert->close();
}

$conn->close();
?>

