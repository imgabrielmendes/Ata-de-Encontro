<?php
	include ("conexao.php");

	$facilitador=$_POST['crm'];
	$emailfacilitador=$_POST['nome'];
	
	$sql = "INSERT INTO atareu (nome_facilitador, email_facilitador)
	VALUES ('$facilitador','$emailfacilitador')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>
