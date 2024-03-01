<?php
include 'database.php';
session_start();

// Verifica se a variável 'texto' foi enviada através do método POST

	$conteudo=$_POST['texto'];
    $horainic= $_POST['datainic'] . ' '.$_POST['horai'] . ':00' ;

    if ($conteudo !== "" && $horainic !=="") {

        $enviarbanco = "INSERT INTO assunto (texto, data_solicitada) VALUES ('$conteudo', '$horainic')";


        if (mysqli_query($conexao, $enviarbanco)) {

            //var_dump($horainic);
            echo '(3) RECEBEU E ENVIOU PRO BANCO';

        } else {

            echo "(X) A marcação do AJAX não foi identificada";
            

        } 
        
    } 
//} 
?>
