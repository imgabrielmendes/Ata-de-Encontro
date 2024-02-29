<?php
include 'database.php';

	$conteudo=$_POST['texto'];
	

	$sql = "INSERT INTO assunto (texto)
	VALUES ('$conteudo')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>