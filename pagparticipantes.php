<?php

namespace formulario;

include ("vendor/autoload.php");
include_once ("app/acoesform.php");
include ("conexao.php");


//Puxar local
$facilitadores = $_GET['facilitadores'];
$conteudo = $_GET['conteudo'];
$horainicio = $_GET['horainicio'];
$horaterm = $_GET['horaterm'];
$data = $_GET['data'];
$objetivoSelecionado = $_GET['objetivoSelecionado'];
$local = $_GET['local'];

echo "Facilitadores - $facilitadores, 
      Conteúdo - $conteudo, 
      Horário de Início - $horainicio, 
      Horário de Término - $horaterm, 
      Data - $data, 
      Objetivos - $objetivoSelecionado, 
      Local - $local";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ata de encontro - HRG</title>
  <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

  <!---------------------------------------------------------------->
  <script src="view/js/popper.min.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="view/css/styles.css">
  <link rel="stylesheet" href="view/css/bootstrap.min.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="view/css/bootstrap.css">
  <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">
</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar shadow">
      <div id="container">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
          <h1 id="tittle" class="">Ata de Encontro</h1>
        </div>
      </div>
    </nav>
  </header>

  <!--FORMULÁRIO-->

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8">
        <!--2° LINHA DO FORMULÁRIO DA ATA----------------------->

        <div class="row"> <!---COLUNA NOME + DATA---->

        <h1>DEU BOM, FOI PUXADO</h1>
        <h1>Dados Recebidos:</h1>
    <ul>
        <li><strong>Facilitadores:</strong> <?php echo $facilitadores; ?></li>
        <li><strong>Conteúdo:</strong> <?php echo $conteudo; ?></li>
        <li><strong>Horário de Início:</strong> <?php echo $horainicio; ?></li>
        <li><strong>Horário de Término:</strong> <?php echo $horaterm; ?></li>
        <li><strong>Data:</strong> <?php echo $data; ?></li>
        <li><strong>Objetivos:</strong> <?php echo $objetivoSelecionado; ?></li>
        <li><strong>Local:</strong> <?php echo $local; ?></li>
    </ul>
    <form>

    <div class="row">
        <div class="col">
           </div>
        <script>
            console.log ("PUXOU! TA PUXANDO A PÁG");
            console.log ("O VALOR INSERIDO NO NOME ANTERIORMENTE FOI:");
        </script>
    </form>
        <script>
            
        </script>
        <div class="row">

        </div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>

</html>