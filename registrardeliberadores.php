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

    $deliberador = $_POST['deliberaDores'];
    // $deliberacoes =$_POST['deliberAcoes'];
    $newItem = $_POST['newItem'];

    $sql = "SELECT id FROM assunto ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimoID = $row["id"];

        // Insere os dados na tabela participantes
        $enviarbanco = "INSERT INTO deliberacoes (id_ata, deliberacoes, deliberadores) VALUES ('$ultimoID', '$newItem','$deliberador')";

        if ($conn->query($enviarbanco) === TRUE) {

            echo "Novo registro inserido com sucesso.";
            echo $enviarbanco;
            
        } else {

            echo "Erro ao inserir registro: " . $conn->error;
        }
        
    } else {

        echo "Nenhum ID encontrado na tabela assunto";
        echo "Dados não recebidos.";

    }

// Fecha a conexão com o banco de dados
$conn->close();
?>
