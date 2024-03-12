<?php

namespace formulario;

include ("vendor/autoload.php");
include_once ("app/acoesform.php");
include ("conexao.php");


//PUXANDO OS VALORES QUE ESTÃO SENDO INSERIDOS NA PÁGINA PRINCIPAL ATRAVÉS DA CHAMADA AJAX NO "gravar.js
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
          <h1 id="tittle" class="text-center">2° FASE</h1>
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

          <div class="col-md-12 text-center">
          <!----<ul>
              <strong>Facilitadores:</strong> <?php echo $facilitadores; ?>
              <br>
              <strong>Tema:</strong> <?php echo $conteudo; ?>
              <br>
              <strong>Horário de Início:</strong> <?php echo $horainicio; ?>
              <strong>Horário de Término:</strong> <?php echo $horaterm; ?>
              <strong>Data:</strong> <?php echo $data; ?>
              <br>
              <strong>Objetivos:</strong> <?php echo $objetivoSelecionado; ?>
              <strong>Local:</strong> <?php echo $local; ?>
              <h3>---------------------------------</h3>
          </ul> --->
          
        </div>
          <!---ABA DE DATA---->
        
          <h3 class="text-center">Informações de Registro</h3>
          
          <div class="col-3">
            <label><b>Data*</b></label>
            <ul class="form-control"> <?php echo $data;  ?> </ul>
          </div>

          <!---ABA DE HORÁRIO INICIO---->
          <div class="col-3">
            <label for="nomeMedico"><b>Horário de Início*:</b></label>
            <br>
            <ul class="form-control"><?php echo $horainicio; ?></ul>
          </div>

 <!---ABA DE HORÁRIO TERMINO---->
          <div class="col-3">
            <label for="form-control"> <b> Horário de Término:</b> </label>
            <ul class="form-control"><?php echo $horaterm; ?></ul>
          </div>

 <!---ABA DE TEMPO ESTIMADO ---->
          <div class="col-3">
            <label for="form-control"> <b> Tempo Estimado (horas):</b> </label>
            <ul class="form-control">Colocar resultado</ul>
          </div>
          <br>

    <div class="row">
            <div class="col-6 ">
              <label><b> Facilitador(res) responsável:</b></label>
              <ul class="form-control"><?php echo $facilitadores; ?></ul>            
            </div>
          
 
          <div class="col-3">
            <label><b>Local:</b></label>
            <ul class="form-control"><?php echo $local; ?></ul>
          </div>

          <div class="col-3">
              <label for="form-control"> <b>Objetivo:</b> </label>
              <label class="form-control">
                <input type="checkbox" disabled checked> <?php echo $objetivoSelecionado; ?>
            </div>

            <div class="col">
              <b>Tema:</b> 
            </div>
              <div class="col-11">
              <ul class="form-control"><?php echo $conteudo; ?></ul>
              </div>
            </div>
          

          </div>

          <!--2° FASE-->
          <div class="row">
          <h1 class="text-center">2° FASE </h1>
          <div class="col-12">
            <label><b>Informe uma descrição:<b></label>
              <div>
              <textarea class="form-control"></textarea>
              </div>
          </div>
        </div>

      <!--BOTÕES-->
      <div class="row">
        <div class="col">
          <div class="btn">
            <button id="botaoregistrar" type="button" class="btn btn-success" data-bs-toggle="modal">
              Continuar ata
            </button>
          <br>
            <button id="botaoregistrar" type="button" class="btn btn-primary" data-bs-toggle="modal">
              Atualizar a ata
            </button>
          </div>
        </div>
      

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>
            console.log ("PUXOU! TA PUXANDO A PÁG");
            console.log ("O VALOR INSERIDO NO NOME ANTERIORMENTE FOI:");
        </script>

</body>

</html>