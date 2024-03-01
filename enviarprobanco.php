<?php
include 'database.php';
session_start();

// Verifica se a variável 'texto' foi enviada através do método POST

if (isset($_POST['texto'])) {

    $conteudo = mysqli_real_escape_string($conexao, $_POST['texto']);

    if ($conteudo !== "") {

        $enviarbanco = "INSERT INTO assunto (texto) VALUES ('$conteudo')";

        if (mysqli_query($conexao, $enviarbanco)) {

            echo '(3) RECEBEU E ENVIOU PRO BANCO';

        } else {

            echo "(X) A marcação do AJAX não foi identificada";
            
        } 
           
    } 
} 
?>
