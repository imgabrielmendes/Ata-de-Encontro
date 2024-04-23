<?php
include 'conexao2.php';
$id = $_GET['updateid'];

if (isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];

    $sql="UPDATE crud set id='$id', name='$name', email='$email', mobile='$mobile', password='$password'";
    $result=mysqli_query($conn, $sql);

    if ($result){
        echo "Update bem feito";
        // header('location:display.php');

    } 
        else{

            die(mysqli_error($conn));
            
        }
}