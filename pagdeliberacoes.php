<?php

namespace formulario;

//PUXANDO OS VALORES QUE ESTÃO SENDO INSERIDOS NA PÁGINA PRINCIPAL ATRAVÉS DA CHAMADA AJAX NO "gravar.js
$facilitadores = $_GET['facilitadores'];
$conteudo = $_GET['conteudo'];
$horainicio = $_GET['horainicio'];
$horaterm = $_GET['horaterm'];
$data = $_GET['data'];
$objetivoSelecionado = $_GET['objetivoSelecionado'];
$local = $_GET['local'];

// echo "Facilitadores - $facilitadores, 
//       Conteúdo - $conteudo, 
//       Horário de Início - $horainicio, 
//       Horário de Término - $horaterm, 
//       Data - $data, 
//       Objetivos - $objetivoSelecionado, 
//       Local - $local";

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
    <nav class="navbar shadow ">
      <div id="container">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php"  style="background-color: #20315f;">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"  style="background-color: #20315f;"></a>
          <h1 id="tittle" class="text-center">Deliberações</h1>
        </div>
      </div>
    </nav>
  </header>

  <!--FORMULÁRIO-->

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8">
        <div class="row"> 
          
    <div class="accordion" id="accordionPanelsStayOpenExample">

      <div class="accordion-item shadow">
        <h2 class="accordion-header">
          <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #001f3f;">
            <h5>Informações de Registro</h5>
            <i class="fas fa-plus"></i>
          </button>
        </h2>

    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
          <div class="col-md-12 text-center">         
                
          </div>     

          <!---- PRIMEIRA LINHA DO REGISTRO ---->
          <div class="row">
            <br>
                  <div class="col-3">
                    <label>Data*</label>
                    <ul class="form-control bg-body-secondary"> <?php echo $data;  ?> </ul>
                  </div>
          
                  <!---ABA DE HORÁRIO INICIO---->
                  <div class="col-3">
                    <label for="nomeMedico">Horário de Início*:</label>
                    <br>
                    <ul class="form-control bg-body-secondary"><?php echo $horainicio; ?></ul>
                  </div>

                  <!---ABA DE HORÁRIO TERMINO---->
                  <div class="col-3">
                    <label for="form-control"> <b> Horário de Término:</b> </label>
                    <ul class="form-control bg-body-secondary"><?php echo $horaterm; ?></ul>
                  </div>

                  <!---ABA DE TEMPO ESTIMADO ---->
                  <div class="col-3">
                    <label for="form-control"> <b>Tempo Estimado:</b> </label>
                    <ul class="form-control bg-body-secondary">Colocar resultado</ul>
                  </div>
          </div>

          <div class="row">
            <div class="col-6 ">
              <label><b> Facilitador(res) responsável:</b></label>
              <ul class="form-control bg-body-secondary"><?php echo $facilitadores; ?></ul>            
            </div>
          
 
          <div class="col-3">
            <label><b>Local:</b></label>
            <ul class="form-control bg-body-secondary border rounded"><?php echo $local; ?></ul>
          </div>

          <div class="col-3">
              <label for="form-control"> <b>Objetivo:</b> </label>
              <label class="form-control bg-body-secondary border rounded">
                <input type="checkbox" disabled checked> <?php echo $objetivoSelecionado; ?>
            </div>

            <div class="row">
                <div class="col">
                  <b>Tema:</b> 
                </div>
                <div class="row">
                <div class="col-12">
                  <ul class="form-control bg-body-secondary"><?php echo $conteudo; ?></ul>
                  </div></div>       
            </div>

    
            </div>
    </div>
</div>

<div class="accordion" id="accordionPanelsStayOpenExample">

<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #1c8f69;">
      <h5>Participantes Adicionados</h5>
      <i class="fas fa-plus"></i>
    </button>
  </h2>

<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
<div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
    <div class="col-md-12 text-center">         
          
    </div>     

    <!---- PRIMEIRA LINHA DO REGISTRO ---->
    <div class="row">
      <br>
            <div class="col-3">
              <label>Data*</label>
              <ul class="form-control bg-body-secondary"> <?php echo $data;  ?> </ul>
            </div>
    
            <!---ABA DE HORÁRIO INICIO---->
            <div class="col-3">
              <label for="nomeMedico">Horário de Início*:</label>
              <br>
              <ul class="form-control bg-body-secondary"><?php echo $horainicio; ?></ul>
            </div>
   
      </div>


      </div>
</div>
</div>
</div>
  </div>

<!-----------------------------2° FASE-------------------------------->
<br>
  
        <div class="box box-primary">
        <h1>asasasasasas</h1>
        <form id="addForm">
        <div class="form-group">
            <ul id="items" class="list-group"></ul>
            <br>
            <label for="item">Informe o deliberador:</label>

            <select id="item" class="col-4 form-control" placeholder="Participantes...">
                <?php foreach ($pegarfa as $facnull) : ?>

                    <option value="<?= $facnull['nome_facilitador'] . " <" . $facnull['cargo'] . ">"; ?>">
                        <?= $facnull['nome_facilitador'] . " <" . $facnull['cargo'] . $facnull['email_facilitador']. ">"; ?>
                    </option>

                <?php endforeach ?>
            </select>
            <div class="col">
              <label>Deliberações</label>
              <input class="form-control" type="text">
            </div>
            <div class="col-2">
                <button type="button" id="addItemButton" class="btn btn-primary mt-2">+</button>
            </div>
        </div>

        <br>
                <button onclick="abrirHistorico()"  id="botaoregistrar" type="button" class="btn btn-primary" data-bs-toggle="modal">
                Atualizar a ata
              </button>
              <script>
        function abrirHistorico() {
            window.location.href = 'paghistorico.php';
        }
    </script>
    </form>
            <main class="container-fluid ">
            </div>     

            <div class="row">
              
            <h4 class="text-center">Participantes </h4>
            <br>

            </div>

            <div class="container">
              
    
</div>

<div class="container d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col">
            <div class="btn">
                
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var botaocont = document.getElementById('botaocontinuarata');
        var botaoregistrar = document.getElementById('botaoregistrar');
        var itemList = document.getElementById('items');
        var filter = document.getElementById('filter');
        var addItemButton = document.getElementById('addItemButton'); 

    });

</script>
  </div>
    </div>
      </div>
         </div>
         
</main>

</div>
       
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/participantes.js"></script>

</body>

</html>