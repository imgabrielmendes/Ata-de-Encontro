<?php

namespace formulario;

// include ("vendor/autoload.php");
include_once ("app/acoesform.php");
include ("conexao.php");

//Testar conexao com banco de dados
$puxarform= new AcoesForm;
$facilitadores=$puxarform->selecionarFacilitadores();

$testandodeli=$puxarform->selecionarDeliberadores();
// echo $testandodeli;

//funções de encotrar pessoas
$pegarfa=$puxarform->ultimosParticipantes();
$pegarde=$puxarform->pegarfacilitador();

$participantesArray = $pegarfa;
// ARRUMAR UM JEITO DE DIMINUIR ISSO

try {

$dbhost = 'localhost';
$dbname = 'atareu';
$dbuser = 'root';
$dbpass = '';


  $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
  $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT facilitador, tema, hora_inicial, hora_termino, data_solicitada, objetivo, local 
          FROM assunto 
          ORDER BY data_registro DESC 
          LIMIT 1";

  // Preparar e executar a consulta
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {

      $row = $stmt->fetch(\PDO::FETCH_ASSOC);
      $facilitadores = $row["facilitador"];
      $conteudo = $row["tema"];
      $horainicio = substr($row["hora_inicial"], 0,5);
      $horaterm = substr($row["hora_termino"], 0,5);
      $data = substr($row["data_solicitada"], 0,10);
      $objetivoSelecionado = $row["objetivo"];
      $local = $row["local"];

  } else {
      echo "Nenhum resultado encontrado";
  }

  // Fechar a conexão
  $pdo = null;

} catch (\PDOException $e) {
  echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

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

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-JCHjo1FjBu5zj08fFZ8niXNt6IuPO3WJ10Ii+XXITZ7IU46Scij9MJTf/ZZTK5HVm/BwOxAnoxO8cSvDaz9VWg==" crossorigin="anonymous" /> -->

  <!-- <link rel="stylesheet" href="view/fontawesome/css/fontawesome.css"> -->


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
      <div id="container" style="background-color: #001f3f;">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
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
                    <label><b>Data*</b></label>
                    <ul class="form-control bg-body-secondary"> <?php echo $data;  ?> </ul>
                  </div>
          
                  <!---ABA DE HORÁRIO INICIO---->
                  <div class="col-3">
                    <label for="nomeMedico"><b>Horário de Início*:</b></label>
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

            <div>
                <div class="col">
                  <b>Tema:</b> 
                </div>
                <div>
                <div class="col-12">
                  <ul class="form-control bg-body-secondary"><?php echo $conteudo; ?></ul>
                  </div></div>       
            </div>

    
            </div>
    </div>
</div>
<!------------ACCORDION COM INFORMAÇÕES DE PARTICIPANTES---------------->
<div class="accordion" id="accordionPanelsStayOpenExample">

<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #1c8f69;">

    <i class="fas"></i>
    <h5>Participantes Adicionados </h5>

    </button>
  </h2>

<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
<div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
    <div class="col-md-12 text-center">         
          
    </div>     

    <!---- PRIMEIRA LINHA DO REGISTRO ---->
    <div class="row">
    <div class="col">
        <div>
            <?php 
            // Decodifica a string JSON para um array
            $participantesArray = json_decode($pegarfa[0]['participantes']);

            foreach ($participantesArray as $participanteNome) {

                $participanteNome = trim($participanteNome, '" ');
            ?>
                <div style = "margin: 6px" class='form-control bg-body-secondary border rounded'>
                    <li><b><?php echo $participanteNome; ?></b></li>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>





</div>
</div>
</div>
</div>
  </div>

<!-----------------------------ACCORDION COM PARTICIPANTES-------------------------------->
<br>
<div class="accordion">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
      <h5>Deliberações</h5>
</div>
  </h2>

<!-----------------------------4° FASE-------------------------------->

<div class="accordion-collapse collapse show">
<div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
    <div class="col-md-12 text-center">               
    </div>     
    <span id="inputContainer"></span>
        <form id="addForm">
          
        <div class="form-group">
        <div class="col">
          
              <br>
              <label><b>Informe o texto principal e o deliberador(es):</b></label>
              <textarea id="deliberacoes" class="form-control item" placeholder="Informe o texto"></textarea>
            </div>

            <div class="col">
            <!-- Primeira caixa de texto e select de facilitadores -->
            <div class="mb-2">
                <select id="deliberador" class="form-control facilitator-select" placeholder="Participantes...">
                    <?php foreach ($pegarde as $facnull) : ?>
                        <option value="<?= $facnull['nome_facilitador']; ?>">

                            <?= $facnull['nome_facilitador']; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="col-2">
            <ul id="caixadeselecaodel"></ul>
            <button type="button" id="addItemButton" class="btn btn-success mt-2">+</button>
        </div>
    </div>
    
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="view/img/check.svg" class="rounded me-2" alt="..." style="width: 20px";>
          <strong class="me-auto">Perfeito!</strong>
          <small>Agora</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          A deliberação foi atribuída.
        </div>
      </div>
    </div>

        <br>
        <button id="abrirhist" type="button" class="btn btn-primary" data-bs-toggle="modal"> Atualizar a ata </button>

    </form>
          
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
    <script src="app/deliberacoes.js"></script>
</body>

</html>