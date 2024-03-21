<?php
include 'database.php';
session_start();

// Verifica se a variável 'texto' foi enviada através do método POST
    $facilitadores=$_POST['facilitadores'];
    $data= $_POST['datainic'] . ' '.$_POST['horai'] . ':00';
	$conteudo=$_POST['texto'];
    $horainicio=$_POST['horai'];
    $objetivoSelecionado= $_POST['objetivos'];
    $local= $_POST['local'];

    // $horaterm= $_POST['datainic'] . ' ' .$_POST['horat'] .':00';
    $horaterm=$_POST['horat'].':00';
    // $horaterm='7777-77-77';


    //$objetivoSelecionado= $_POST['objetivos']; NÃO LINKADO AINDA
    if ($facilitadores !=="" && $data !=="" && $horainicio !=="" && $horaterm !=="" && $conteudo !== "" && $objetivoSelecionado !=="" && $local !=="") {

        $enviarbanco = "INSERT INTO assunto (facilitador , data_solicitada, tema,objetivo , hora_inicial, hora_termino, local, status) VALUES ('$facilitadores','$data','$conteudo','$objetivoSelecionado', '$data', '$horaterm','$local','ABERTA')";

        if (mysqli_query($conexao, $enviarbanco)) {

            var_dump($data);
            var_dump($horainicio);
            var_dump($horaterm);
            var_dump ("*Tempo estimado");
            var_dump($objetivoSelecionado);
            var_dump($local);
            var_dump($facilitadores);
            var_dump($conteudo);

            echo '(3) RECEBEU E ENVIOU PRO BANCO';

        } else {
            // var_dump($objetivoSelecionado);
            // var_dump($facilitadores);
            // var_dump($horaterm);
            // var_dump($horainicio);
            echo "(X) A marcação do AJAX não foi identificada";
            
        } 
        
    };

    
?>
