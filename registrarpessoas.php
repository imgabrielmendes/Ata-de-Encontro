<?php
include 'database.php';
session_start();

    $caixanome=$_POST['caixaname'];
    $caixaemail= $_POST['caixaemail'];
	$caixamatricula=$_POST['caixamatricula'];
  
    if ($caixanome !=="" && $caixaemail !=="" && $caixamatricula !=="")  
    {

        $enviarbanco = "INSERT INTO facilitadores (matricula, nome_facilitador , email_facilitador ) VALUES ('$caixamatricula','$caixanome', '$caixaemail')";

        if (mysqli_query($conexao, $enviarbanco)) {

            var_dump("(3) RECEBEU E ENVIOU PRO BANCO");
            var_dump($caixanome);
            var_dump($caixaemail);
            var_dump($caixacargo);
        
        } else {
            
            var_dump($caixanome);
            var_dump($caixaemail);
            var_dump($caixacargo);
            echo "(X) A marcação do AJAX não foi identificada";
            
        } 
        
    };

    
?>
