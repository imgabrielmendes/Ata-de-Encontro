<?php
require_once 'database.php';
try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser,
$dbpass);
    echo "Conectado a $dbname em $dbhost com sucesso.";
} catch (PDOException $pe) {
    die("Não foi possível se conectar ao banco de dados $dbname :" . $pe
>getMessage());

}

?>