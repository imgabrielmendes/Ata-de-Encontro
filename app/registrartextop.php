<?php 
include 'database.php';
session_start();

$dbhost = 'localhost';
$dbname = 'atareu';  
$dbuser = 'root';  
$dbpass = '';     

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
echo("OK, puxou");

if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

var_dump("OK, puxou");
$textoprincipal = $_POST['textoprincipal'];

$sql = "SELECT id FROM assunto ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $ultimoID = $row["id"];

        $enviarbanco = "INSERT INTO textoprinc (id_ata, texto_princ) VALUES ('$ultimoID', '$textoprincipal')";

        if ($conn->query($enviarbanco) === TRUE) {

            echo "O texto inserido foi:.<br> $textoprincipal";

        } else {
            echo "Erro ao inserir registro para o deliberador $textoprincipal: " . $conn->error . "<br>";
        }
    }

    else {
    echo "Nenhum ID encontrado na tabela assunto.<br>";
    echo "Dados não recebidos.<br>";

}

$conn->close();
?>
