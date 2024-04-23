<?php
include 'conexao2.php';
$id = $_GET['updateid'];

if (isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "UPDATE crud SET name='$name', email='$email', mobile='$mobile', password='$password' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    print_r($result);

    if ($result){
        echo "Update bem feito";
        header('location:index.php');
    } else {
        die(mysqli_error($conn));
    }
}
?>
