<?php
include 'database.php';

session_start();
$conteudo = $_POST['informacao'];

if ($conteudo == "enviar") {

    
    $enviarbanco = "INSERT INTO assunto (texto) VALUES ('$conteudo')";

    if (mysqli_query($conexao, $enviarbanco)) {

		echo '(3) RECEBEU E ENVIOU PRO BANCO';
        echo json_encode(array("statusCode" => 200, "message" => "Comando de envio para o banco funcionou"));

    } else {

		echo "(X) A marcação do AJAX não foi identificada";
        echo json_encode(array("statusCode" => 201, "message" => "Erro ao executar o comando SQL: " . mysqli_error($conexao)));
    }

    mysqli_close($conexao);
} 
?>
