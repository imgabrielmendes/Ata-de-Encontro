<?php 
include 'database.php';
session_start();


/// COMANDO PARA ENVIAR AS INFORMAÇÕES DE REGISTROS DA MODAL PARA O BANCO DE DADOS 

$caixadenome=$_POST['caixaname'];
$caixadeemail=$_POST['caixaemail'];

$participantesAdicionados=$_POST['participantes'];
echo $participantesAdicionados;

if($participantesAdicionados !==""){

    $enviarregistro = "INSERT INTO participantes (participantes) VALUE ('$participantesAdicionados')";
    
    if (mysqli_query($conexao, $enviarregistro)) {

        echo '(3.3) RECEBEU E ENVIOU PRO BANCO';
        echo $participantesAdicionados;

    } else {
        var_dump($enviarregistro);
        echo "(X) A marcação do AJAX não foi identificada";
        
    } 
}

    // if($caixadenome !=="" && $caixadeemail !==""){

    //     $enviarregistro = "INSERT INTO facilitadores (nome_facilitador, email_facilitador) VALUES ('$caixadenome','$caixadeemail')";
        
    //     if (mysqli_query($conexao, $enviarregistro)) {

    //         echo '(3.3) RECEBEU E ENVIOU PRO BANCO';

    //     } else {
    //         var_dump($caixadenome . $caixadeemail);
    //         echo "(X) A marcação do AJAX não foi identificada";
            
    //     } 
    // }

?>