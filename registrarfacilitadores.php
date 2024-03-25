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

$sql = "SELECT id,tema FROM assunto ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
var_dump($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $ultimoID = $row["id"];
    $participantesAdicionados = $_POST['particadd'];

    $enviarbanco = "INSERT INTO participantes (id_ata, participantes) VALUES ('$ultimoID', '$participantesAdicionados')";

    $enviar_assuntos = "INSERT INTO assuntos (id_ata, outro_valor) VALUES ('$ultimoID_assunto', 'valor_para_assuntos')";

    if ($conn->query($enviarbanco) === TRUE) {
        echo "Novo registro inserido com sucesso.";
    } 
    
        else {
            echo "Erro ao inserir registro: " . $conn->error;
        }

      } else {
            echo "Nenhum ID encontrado na tabela assunto";
        }

$conn->close();
?>
