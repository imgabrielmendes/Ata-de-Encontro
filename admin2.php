<?php

namespace formulario;

include_once("app/acoesform.php");
include("conexao2.php");

$puxarform = new AcoesForm;
$facilitadores = $puxarform->selecionarFacilitadores();
$pegarfa = $puxarform->pegarfacilitador();
$pegarlocal = $puxarform->pegarlocais();

if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "INSERT INTO crud (name, email, mobile, password)
            VALUES('$name', '$email', '$mobile', '$password')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Funciona";
    } else {
        echo "Não funciona";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ATA</title>
    <link rel="icon" href="view/img/Logobordab.png" type="image/x-icon">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-border-hrg shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/">
                <!-- <img src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png" alt="Central de Serviço" style="width: 160px"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarCentral" aria-controls="navBarCentral" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navBarCentral">
                <!-- Adicione aqui os elementos do menu se necessário -->
            </div>
        </div>
    </nav>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Registre-se</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Insira seu nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Insira seu email" required>
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Insira seu telefone" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Insira sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Enviar</button>
            </form>
        </div>
    </div>
</div>



<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
</html>