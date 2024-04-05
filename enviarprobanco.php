<?php
include 'database.php';
session_start();

// Verifica se a variável 'texto' foi enviada através do método POST
    $facilitadoresSelecionados = $_POST['facilitadores'];
    $data= $_POST['datainic'] . ' '.$_POST['horai'] . ':00';
	$conteudo=$_POST['texto'];
    $horainicio=$_POST['horai'];
    $objetivoSelecionado= $_POST['objetivos'];
    $local= $_POST['local'];
    $horaterm=$_POST['horat'].':00';
    // $tempoes=$_POST['tempoestimado'];

    if ($facilitadoresSelecionados !=="" && $data !=="" && $horainicio !=="" && $horaterm !=="" && $conteudo !== "" && $objetivoSelecionado !=="" && $local !=="")  {

        $enviarbanco = "INSERT INTO assunto (facilitador , data_solicitada, tema,objetivo , hora_inicial, hora_termino, local, status) VALUES ('$facilitadoresSelecionados','$data','$conteudo','$objetivoSelecionado', '$data', '$horaterm','$local','ABERTA')";

        if (mysqli_query($conexao, $enviarbanco)) {

            var_dump($data);
            var_dump($horainicio);
            var_dump($horaterm);
            var_dump ($tempoes);
            var_dump($objetivoSelecionado);
            var_dump($local);
            var_dump($facilitadoresSelecionados);
            var_dump($conteudo);

            var_dump("(3) RECEBEU E ENVIOU PRO BANCO");

        } else {
            var_dump($facilitadoresSelecionados);
            echo "(X) A marcação do AJAX não foi identificada";
            
        } 
        
    };

    
?>
