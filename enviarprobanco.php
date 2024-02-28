<?php
//	include 'database.php';

	$crm=$_POST['crm'];
	$facilitador=$_POST['nome_facilitadores'];
	$especialidade=$_POST['especialidades'];
	$local=$_POST['local'];

	$sql = "INSERT INTO atareu (nome_med, crm_med, fk_id_esp, local)
	VALUES ('$nomeMedico','$crm','$especialidade','$local')";
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>