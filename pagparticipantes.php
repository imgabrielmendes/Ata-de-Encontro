<?php

namespace formulario;

include ("vendor/autoload.php");
include_once ("app/acoesform.php");
include ("conexao.php");

$puxarform= new AcoesForm;
$facilitadores=$puxarform->selecionarFacilitadores();
$pegarfa=$puxarform->pegarfacilitador();
var_dump($pegarfa);

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
  </div>

<!-----------------------------2° FASE-------------------------------->
<br>

        <div class="box box-primary">
            <main class="container-fluid ">

            <div class="row">
            <h4 class="text-center">Participantes </h4>
            </div>

          <div class="row">
            <div class="col-8">
              <label><b>Informe os participantes:<b></label>
            </div>
          </div>

          <!-- <div class="row">
            <main class="container_fluid d-flex justify-content-center align-items-center">
            <div class="col-9">
            <select class="form-control" id="selecionandoparticipa" name="facilitador">
          
              <?php foreach ($pegarfa as $facnull) : ?>

                        <option value="<?= $facnull['nome_facilitador'] ." "."<". $facnull ['cargo'].">"; ?>"
                        data-tokens="<?= $facnull['nome_facilitador']?>">
                        <?= $facnull['nome_facilitador']." "."<". $facnull ['cargo'].">"; ?>
                        
                </option>
                
                <?php endforeach ?>
                </option> 
          </select>
          </div>
          <div class="col-3">
          <button class="col-4 btn btn-success text-center">+</button>
         -->
        <div class="row">
        <div class="col">
        <form id="addForm">

            <div class=" col-5 form-group">
                <!-- <input type="text" id="" class="form-control" placeholder="Adicionar nova tarefa..."> -->
                <select class="form-control" id="item" name="facilitador">
          
          <?php foreach ($pegarfa as $facnull) : ?>
                    <option value="<?= $facnull['nome_facilitador'] ." "."<". $facnull ['cargo'].">"; ?>"
                    data-tokens="<?= $facnull['nome_facilitador']?>">
                    <?= $facnull['nome_facilitador']." "."<". $facnull ['cargo'].">"; ?>
            </option>
            
            <?php endforeach ?>
            </option> 

            <!----- BOTÃO DE ADICIONAR---->

            <div class="col">
            <button type="submit" class="btn btn-success" id="addNewTextBox">+</button>
            </div>

      </select>                      
        </form>       
</div>
</div>
        <button id="addNewTextBox" class="btn btn-success">Adicionar Nova Tarefa</button>
        <hr>
        <h3>DEU BOM, TÁ PUXANDO</h3>
        <button type="submit" class="btn btn-success" id="addNewTextBox">+</button>

        <input type="text" id="filter" class="form-control" placeholder="Filtrar Tarefas...">
        <ul id="items" class="list-group"></ul>

        <script>
       
          </script>
         </div>

              </div>

              <!--BOTÕES-->
      <div class="container d-flex justify-content-center align-items-center">
        <div class="row">
          <div class="col">
            <div class="btn">
              <br>
              <button id="botaoregistrar" type="button" class="btn btn-success" data-bs-toggle="modal">
                Continuar ata
              </button>

            <br>
              <button onclick="openInternalPage()"  id="botaoregistrar" type="button" class="btn btn-primary" data-bs-toggle="modal">
                Atualizar a ata
              </button>
              <script>
        function openInternalPage() {
            window.location.href = 'paghistorico.php';
        }
    </script>
            </div>
        </div>
      </div>

            </div>
</main>
</div>
       
      
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/participantes.js"></script>

</body>

</html>