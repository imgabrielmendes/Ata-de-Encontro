<?php
include 'database.php';
session_start();

// Verifica se a variável 'texto' foi enviada através do método POST
    $caixanome=$_POST['caixaname'];
    $caixadeemail= $_POST['caixadeemail'];
	$caixamatricula=$_POST['caixamatricula'];
  
    if ($caixanome !=="" && $caixadeemail !=="" && $caixamatricula !=="")  
    {

        $enviarbanco = "INSERT INTO facilitadores (nome_facilitador , email_facilitador, matricula) VALUES ('$caixanome', '$caixadeemail','$caixamatricula')";

        if (mysqli_query($conexao, $enviarbanco)) {

            var_dump("(3) RECEBEU E ENVIOU PRO BANCO");
            var_dump($caixanome);
            var_dump($caixadeemail);
            var_dump($caixacargo);
        
        } else {
            
            var_dump($caixanome);
            var_dump($caixadeemail);
            var_dump($caixacargo);
            echo "(X) A marcação do AJAX não foi identificada";
            
        } 
        
    };

    
?>
