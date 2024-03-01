<?php
include 'database.php';
session_start();

// Verifica se a variável 'texto' foi enviada através do método POST
if (isset($_POST['texto'])) {

    $conteudo = mysqli_real_escape_string($conexao, $_POST['texto']);

    // Verifica se a variável $conteudo não está vazia
    if ($conteudo !== "") {

        $enviarbanco = "INSERT INTO assunto (texto) VALUES ('$conteudo')";

        if (mysqli_query($conexao, $enviarbanco)) {
            echo '(3) RECEBEU E ENVIOU PRO BANCO';
            echo json_encode(array("statusCode" => 200, "message" => "Comando de envio para o banco funcionou"));
        } else {
            echo "(X) A marcação do AJAX não foi identificada";
            echo json_encode(array("statusCode" => 201, "message" => "Erro ao executar o comando SQL: " . mysqli_error($conexao)));
        }

        mysqli_close($conexao);
    } else {
        echo json_encode(array("statusCode" => 202, "message" => "O conteúdo está vazio"));
    }
} else {
    echo json_encode(array("statusCode" => 203, "message" => "Variável 'texto' não encontrada na solicitação POST"));
}
?>
