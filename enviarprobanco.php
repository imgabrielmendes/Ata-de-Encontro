<?php
include 'database.php';
session_start();

// Verifica se a variável 'texto' foi enviada através do método POST

	$conteudo=$_POST['texto'];
    $horainic= $_POST['datainic'] . ' '.$_POST['horai'] . ':00';
    $objetivoSelecionado= $_POST['objetivos'];

    

    if ($conteudo !== "" && $horainic !=="" && $objetivoSelecionado !=="") {

        $enviarbanco = "INSERT INTO assunto (texto, data_solicitada, objetivo) VALUES ('$conteudo', '$horainic', '$objetivoSelecionado')";

        if (mysqli_query($conexao, $enviarbanco)) {

            echo '(3) RECEBEU E ENVIOU PRO BANCO';

        } else {
            var_dump($objetivoSelecionado);
            echo "(X) A marcação do AJAX não foi identificada";
            
        } 
        
    };

    
?>
