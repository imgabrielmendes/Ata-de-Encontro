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

$deliberadoresSelecionados = json_decode($_POST['deliberaDores'], true);
$newItem = $_POST['newItem'];

$sql = "SELECT id FROM assunto ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ultimoID = $row["id"];

    foreach ($deliberadoresSelecionados as $deliberadorValue) {

        $enviarbanco = "INSERT INTO deliberacoes (id_ata, deliberacoes, deliberadores) VALUES ('$ultimoID', '$newItem', '$deliberadorValue')";

        $alterarstatus = "UPDATE assunto SET status = 'FECHADA' WHERE id = $sql";
        print_r($alterarstatus);

        if ($conn->query($enviarbanco) === TRUE) {
            echo "Novo registro inserido com sucesso para o deliberador $deliberadorValue.<br>";
        } else {
            echo "Erro ao inserir registro para o deliberador $deliberadorValue: " . $conn->error . "<br>";
        }
    }
} else {
    echo "Nenhum ID encontrado na tabela assunto.<br>";
    echo "Dados não recebidos.<br>";
}

$conn->close();
?>
