<?php 
include 'database.php';
session_start();

// Conexão com o banco de dados
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Consulta para obter o último ID da tabela 'assunto'
$sql = "SELECT id FROM assunto ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimoID = $row["id"];

        $ParticipantesAdicionados = json_decode($_POST['particadd']);

        if (!empty($ParticipantesAdicionados)) {

            foreach ($ParticipantesAdicionados as $participante) {

                $enviarBancoParticipantes = "INSERT INTO participantes (id_ata, participantes) VALUES (?, ?)";
                $stmtParticipantes = $conn->prepare($enviarBancoParticipantes);
                $stmtParticipantes->bind_param("ss", $ultimoID, $participante);
                $stmtParticipantes->execute();

                if ($stmtParticipantes) {
                    echo "Novo registro inserido com sucesso para o participante: $participante <br>";
                } else {
                    echo "Erro ao inserir registro para o participante: $participante <br>";
                }

                $stmtParticipantes->close();
            }
        } else {
            echo "Nenhum participante adicionado.";
        }
    } else {
        echo "Nenhum ID encontrado na tabela 'assunto'";
    }
} else {
    echo "Erro na consulta SQL: " . $conn->error;
}

$conn->close();

?>
