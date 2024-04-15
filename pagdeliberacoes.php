<?php
namespace formulario;

include_once ("app/acoesform.php");
include ("conexao.php");

$puxarform= new AcoesForm;
$pegarde=$puxarform->pegarfacilitador();

$testando=$puxarform->puxandoUltimosFacilitadores();
foreach ($testando as $facilitador) {
  // echo "ID: " . $facilitador['id'] . "<br>";
  // echo "Matrícula: " . $facilitador['matricula'] . "<br>";
  // echo "Nome: " . $facilitador['nome_facilitador'] . "<br>";
  // echo "<br>";
}

// echo $facilitador;
// print_r ($facilitador);

$participantesAdicionados = $_GET['participantesAdicionados'];
$participantesArray = explode(",", $participantesAdicionados);
foreach ($participantesArray as $participante) {
    echo $participante . "<br>";
}

$formulario= $puxarform->pegarUltimaAta();
$conteudo = $_SESSION['conteudo'];
$horainicio = $_SESSION['horainicio'];
$horaterm = $_SESSION['horaterm'];
$data = $_SESSION['data'];
$objetivoSelecionado = $_SESSION['objetivoSelecionado'];
$local = $_SESSION['local'];

// echo "Conteúdo: " . $conteudo . "<br>";
// echo "Hora de início: " . $horainicio . "<br>";
// echo "Hora de término: " . $horaterm . "<br>";
// echo "Data: " . $data . "<br>";
// echo "Objetivo Selecionado: " . $objetivoSelecionado . "<br>";
// echo "Local: " . $local . "<br>";

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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

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
                    <label for="form-control"><b>Tempo Estimado:</b></label>
                    <?php
                    // Verifica se as variáveis estão definidas antes de calcular o tempo estimado
                    if (isset($horainicio) && isset($horaterm)) {
                        // Calcula a diferença de tempo em minutos
                        $inicio = strtotime($horainicio);
                        $termino = strtotime($horaterm);
                        $diferencaMinutos = ($termino - $inicio) / 60;

                        // Calcula horas e minutos
                        $horas = floor($diferencaMinutos / 60);
                        $minutos = $diferencaMinutos % 60;

                        // Formata os números com dois dígitos
                        $horas_formatado = sprintf("%02d", $horas);
                        $minutos_formatado = sprintf("%02d", $minutos);

                        // Exibe o tempo estimado no formato "00:00"
                        echo "<div class='form-control bg-body-secondary tempo-estimado'>" . $horas_formatado . ":" . $minutos_formatado . "</div>";
                    } else {
                        echo "Horário de início e/ou término não definidos.";
                    }
                    ?>
                    <style>
                        .tempo-estimado {
                            width: 100%;
                        }
                    </style>
                </div>

          </div>

          <div class="row">
            <div class="col-6 ">
              <label><b> Facilitador(res) responsável:</b></label>
              <ul class="form-control bg-body-secondary">
              <?php foreach ($testando as $facilitador) { echo $facilitador ['nome_facilitador'] . ", " ;}
                ?></ul>            
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
                <div style = "margin: 6px" class='form-control bg-body-secondary border rounded'>

                    <?php 
                    foreach ($participantesArray as $participante) {
                    // Remover espaços em branco extras no início e no fim de cada participante
                    $participante = trim($participante);
                    echo "<li><b>{$participante}</b></li>";
                } ?>
                </div>
            <?php
            
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
    <div class="row">
    <div class ="col">
        <label style="height: 35px;"><b>Informe o texto principal:</b></label>
        <textarea class="form-control"></textarea>

              </div>
    </div>   
    <span class="col-4" id="inputContainer"></span>
        <form id="addForm">
          
        <div class="form-group">
        <div class="col">
          
              <br>
              <ul class="list-group list-group-flush"></ul>
              <label class="h4" style="height: 35px;"><b>DELIBERAÇÕES</b></label>
              
              <textarea id="deliberacoes" class="form-control item" placeholder="Informe as deliberações..." style="height: 110px;"></textarea>
            </div>

    <div class="col">
    <!-- Primeira caixa de texto e select de facilitadores -->
    <div class="mb-2">
        <select id="deliberador" class="form-control facilitator-select" placeholder="Deliberações" multiple>
        <optgroup label="Selecione Facilitadores">
                  <?php foreach ($pegarde as $facnull) : ?>
                      <option value="<?php echo $facnull['id']; ?>"
                          data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                          <?php echo $facnull['nome_facilitador']; ?>
                      </option>
                  <?php endforeach ?>
              </optgroup>
        </select>
</div>

        </div>
        <div class="row">
          <div class="col-10"></div>
          <div class="col-2 d-flex justify-content-end">
              <div class="d-flex flex-column align-items-end">
                  <ul id="caixadeselecaodel"></ul>
                  <button type="button" id="addItemButton" class="btn btn-success mt-2">+</button>
              </div>
    </div>
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

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="view\img\x.svg" class="rounded me-2" alt="..." style="width: 15px";>
          <strong class="me-auto">Perfeito!</strong>
          <small>Agora</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          Atribuição excluída.
        </div>
      </div>
    </div>

        <br>
        <!-- <button id="abrirhist" type="button" class="btn btn-primary" data-bs-toggle="modal"> Atualizar a ata </button> -->
        <div class="d-flex justify-content-center">
            <button id="abrirhist" type="button" class="btn btn-primary" data-bs-toggle="modal">Atualizar a ata</button>
        </div>

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
       
    <script src="view\js\multi-select-tag.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/deliberacoes.js"></script>

</body>

</html>