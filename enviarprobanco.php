<?php
include 'database.php';
session_start();

// Recebe os valores do POST e decodifica o JSON para obter o array
$facilitadoresSelecionados = json_decode($_POST['facilitadores']);

$data = $_POST['datainic'] . ' ' . $_POST['horai'] . ':00';
$conteudo = $_POST['texto'];
$objetivoSelecionado = $_POST['objetivos'];
$local = $_POST['local'];
$horaterm = $_POST['horat'] . ':00';

// Verifica se todos os campos estão preenchidos
if ($facilitadoresSelecionados !== null && $data !== "" && $horaterm !== "" && $conteudo !== "" && $objetivoSelecionado !== "" && $local !== "") {

    // Iniciar transação
    $conexao->begin_transaction();

    // Inserir dados na tabela 'assunto'
    $enviarbanco = "INSERT INTO assunto (data_registro, tema, objetivo, hora_inicial, hora_termino, local, status) VALUES (?, ?, ?, ?, ?, ?, 'ABERTA')";
    
    $stmt = $conexao->prepare($enviarbanco);
    $stmt->bind_param("ssssss", $data, $conteudo, $objetivoSelecionado, $data, $horaterm, $local);
    
    // Executar a inserção na tabela 'assunto'
    $stmt->execute();

    if ($stmt) {
        // Obter o ID do último registro inserido em 'assunto'
        $id_ata = $conexao->insert_id;

        foreach ($facilitadoresSelecionados as $facilitador) {
            // Agora, vamos inserir o facilitador na tabela 'ata_has_fac' usando o ID obtido anteriormente
            $enviarbanco2 = "INSERT INTO ata_has_fac (id_ata, facilitadores) VALUES (?, ?)";
            $stmt2 = $conexao->prepare($enviarbanco2);
            $stmt2->bind_param("ss", $id_ata, $facilitador);
            $stmt2->execute();

            if ($stmt2) {
                echo "Registro inserido com sucesso na tabela ata_has_fac para o facilitador: $facilitador <br>";
            } else {
                echo "Erro ao inserir registro na tabela ata_has_fac para o facilitador: $facilitador <br>";
            }

            $stmt2->close();
        }

        // Confirmar a transação
        $conexao->commit();
        echo "Registro inserido com sucesso para o facilitador: $facilitador <br>";
    } else {
        // Reverter a transação em caso de erro
        $conexao->rollback();
        echo "Erro ao inserir registro <br>";
    }

    $stmt->close();
    $conexao->close();

} else {
    echo "(X) Algum dos campos está vazio.";
}

?>
