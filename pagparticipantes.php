<?php

namespace formulario;
session_start();

include_once ("app/acoesform.php");
include ("conexao.php");

$puxarform= new AcoesForm;
$facilitadores=$puxarform->selecionarFacilitadores();
$pegarfa=$puxarform->pegarfacilitador();
$resultados = $puxarform->pegandoTudo();
$puxaparticipantes = $puxarform->buscarParticipantesPorIdAta($id_ata = "?");
$id_ata = $puxarform->pegarUltimaAta();
$ultimosfacilitadores = $puxarform->puxandoUltimosFacilitadores();

$facilitadores = $_GET['facilitadores'];

// echo $facilitadores;

$facilitadoresArray = json_decode($facilitadores, true);   
$facilitadoresString = implode(", ", $facilitadoresArray);

// echo $facilitadoresString;

$conteudo = $_GET['conteudo'];
$horainicio = $_GET['horainicio'];
$horaterm = $_GET['horaterm'];
$data = $_GET['data'];
  $dateTime = new \DateTime($data);
  $data_formatada = $dateTime->format('d/m/Y');
  $_SESSION['data'] = $data_formatada;

$objetivoSelecionado = $_GET['objetivoSelecionado'];
$local = $_GET['local'];
print_r($id_ata);

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="view\css\multi-select-tag.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-JCHjo1FjBu5zj08fFZ8niXNt6IuPO3WJ10Ii+XXITZ7IU46Scij9MJTf/ZZTK5HVm/BwOxAnoxO8cSvDaz9VWg==" crossorigin="anonymous" />
</head>
<body>
<style>
      body{
        background-color: rgba(240, 240, 240, 0.41);
      }
      .content-header{
        background-color: #001f3f;
        }
</style>

      <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-border-hrg">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/"><img src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png" alt="Central de Serviço" style="width: 160px"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarCentral" aria-controls="navBarCentral" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
            </button>
      

          <div class="collapse navbar-collapse" id="navBarCentral">
          </div>
        </div>
      </nav>
      <div class="content-header shadow" style="border-bottom: solid 1px gray;">
          <div class="container-fluid">
            <div class="row py-1">
              <div class="col-sm-6">
              <h2 class="m-3 text-light shadow"><i class="fa-solid fa-users-rectangle"></i>Participantes</h2>
              </div>
            </div>
          </div>
        </div>
      </header>

  <!--FORMULÁRIO-->
  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container_fluid d-flex justify-content-center align-items-center">
      
      <div class="form-group col-xl-9 col-lg-xs-sm-md-12 ">

      <style>
        .text-danger {
        color: #198754;
      }

      .text-primary {
        color: #007bff;
      }
      </style>

      <div class="row">
        <div class="col">
          <div class="alert alert-light d-flex align-items-center shadow" role="alert">
          <svg style="color: #dc3545;" xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" width="25" height="25" viewBox="0 0 16 16" role="img" aria-label="Warning:">
        <path fill="currentColor" d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </svg>
            <p class="mb-0">
              <b class="text-danger">ATENÇÃO!</b> Caso deseje apenas abrir uma ata sem informar os participantes, clique em <b class="text-primary">Ir para histórico</b>.
            </p>
          </div>
        </div>
      </div>



    <div class="row"> 
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item shadow">
        <h2 class="accordion-header">
          <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #001f3f;">
  
          <i class="fa-solid fa-circle-info p-1 mb-1"></i><h5>Informações de Registro</h5>
          </button>
        </h2>

    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
      <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);" >
          <div class="col-md-12 text-center">         
        
          </div>     

          <!---- PRIMEIRA LINHA DO REGISTRO ---->
          <div class="row">
    <br>
    <div class="col-sm-12 col-xl-3  col-md-6">
        <label><b>Data:</b></label>
        <ul class="form-control bg-body-secondary"> <?php echo $_SESSION['data']; ?> </ul>
    </div>

    <!---ABA DE HORÁRIO INICIO---->
    <div class="col-sm-12 col-xl-3  col-md-6">
        <label for="nomeMedico"><b>Horário de Início:</b></label>
        <br>
        <ul class="form-control bg-body-secondary"><?php echo $_SESSION['horainicio']; ?></ul>
    </div>

    <!---ABA DE HORÁRIO TERMINO---->
    <div class="col-sm-12 col-xl-3  col-md-6">
        <label for="form-control"> <b> Horário de Término:</b> </label>
        <ul class="form-control bg-body-secondary"><?php echo $_SESSION['horaterm']; ?></ul>
    </div>

    <!---ABA DE TEMPO ESTIMADO ---->
    <div class="col-sm-12 col-xl-3  col-md-6">
        <label for="form-control"><b>Tempo Estimado:</b></label>
        <?php
        // Verifica se as variáveis estão definidas antes de calcular o tempo estimado
        if (isset($_SESSION['horainicio']) && isset($_SESSION['horaterm'])) {
            // Calcula a diferença de tempo em minutos
            $inicio = strtotime($_SESSION['horainicio']);
            $termino = strtotime($_SESSION['horaterm']);
            $diferencaMinutos = ($termino - $inicio) / 60;

            // Calcula horas e minutos
            $horas = floor($diferencaMinutos / 60);
            $minutos = $diferencaMinutos % 60;

            // Formata os números com dois dígitos
            $horas_formatado = sprintf("%02d", $horas);
            $minutos_formatado = sprintf("%02d", $minutos);

            // Exibe o tempo estimado no formato "00:00"
            echo "<div class='form-control bg-body-secondary tempo-estimado'>" . $horas_formatado . ":" . $minutos_formatado . ":00". "</div>";
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
    <div class="facilitadorcol col-lg-6  col-lg-md-12 col-md-12">
        <label><b >Facilitador(es):</b></label>
        <ul class=" mt-2 form-control bg-body-secondary"><?php echo $facilitadoresString; ?></ul>
    </div>
    <div class="col-lg-3  col-lg-md-12 col-md-6">
        <label><b>Local:</b></label>
        <ul class=" mt-2 form-control bg-body-secondary border rounded"><?php echo $_SESSION['local']; ?></ul>
    </div>
    <div class="col-lg-3  col-lg-md-12 col-md-6">
        <label for="form-control"> <b>Objetivo:</b> </label>
        <label class=" mt-2 form-control bg-body-secondary border rounded">
            <input type="checkbox" disabled checked> <?php echo $_SESSION['objetivoSelecionado']; ?>
    </div>
    <div>
        <div class="col">
            <b>Tema:</b> 
        </div>
        <div>
            <div class="col-12">
                <ul class="form-control bg-body-secondary"><?php echo $_SESSION['conteudo']; ?></ul>
            </div>
        </div>       
    </div>
</div>
      </div>
    </div>
</div>
  </div>
<!-----------------------------2° FASE-------------------------------->
<br>
<div class="accordion mt-4">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #1c8f69;">
    <i class="fa-solid fa-user p-1 mb-1"></i>
<h5>Participantes</h5>
</div>
  </h2>                                                                                                                                       
        <div class="container-fluid ">
        <div class="row">
          <form id="addForm">
              <div class="form-group ">
                  <br>
                  <div id="items" class="list-group">                    
              </div>
                  <label for="item"><b>Informe os participantes</b></label>

                  <div class="row">
                    <div class="col" > 
                    <select  class="col form-control" id="participantesadicionados" name="facilitador" multiple style="width: 100px;">
                      <optgroup label="Selecione Facilitadores">
                          <?php foreach ($pegarfa as $facnull) : ?>
                              <option value="<?php echo $facnull['id']; ?>"
                                  data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                                  <?php echo $facnull['nome_facilitador']; ?>
                              </option> <?php endforeach ?>
                       </optgroup>
                    </select>
        </div>
        </div></div>
          
          </form>
          <div  class="row">
          <div class="col-lg-12 col-md-2 d-flex text-center">
           <button  id="botaoregistrar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldeemail">
           <i class='fas fa-address-card' style='color: white; font-size: 1.2rem;'></i>
            </button>
       </div>
      </div>
    </div>
<br>
           <br><br>
      <!--BOTÕES-->
      <div class="container-fluid   justify-content-center ">
        <div class="row">
          <div class="btnsparticipante">

          <div class="p-2 col-lg-3 col-md-5 col-sm-12">
    <button id="botaocontinuarata" type="button" class="btn form-control btn-success" onclick="">
        Prosseguir com a ata
    </button>
<script>
    var id_ata = <?php echo $id_ata; ?>;
</script>

</div>
        <div class="p-2 col-lg-3 col-md-5 col-sm-12">
              <button onclick="abrirHistorico()"  id="botaoregistrar" type="button" class="btn form-control btn-primary" data-bs-toggle="modal">
                Ir para histórico
              </button>         
    </div>



        </div>

                  <script>
        function abrirHistorico() {
            window.location.href = 'paghistorico.php';
        }
    </script> 
          </div>

          </div>
            </div>
            <br>
          </div>
          
    
           
          </div>  <br></div>
        </div>

            </div>

              
</main>
</div>

                      <!------------------ MODAL ------------------>
                      <div class="modal fade" id="modaldeemail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="col modal-title fs-5" id="staticBackdropLabel">Registro de usuário</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                              <form>
                                <div class="mb-3">

                                  <label class="col-form-label">Nome completo:</label>
                                  <input type="text" class="form-control" id="caixanome">
                                </div>

                                <div class="mb-3">
                                  <label class="col-form-label">Informe o Email</label>
                                  <input type="email" class="form-control" id="caixadeemail">
                                </div>

                                <div class="row">
                                <label class="col-4 form-label">Matricula: </label>
                                <label id="labelcargo" class="col-8 form-label">Cargo: </label>
                                <div class="col-4">
                                <input type="text" maxlength="4" class="form-control" id="caixamatricula">
                                </div>  

                                <div class="col-8">
                                <input type="text" class="col-5 form-control" id="caixacargo">
                              </div></div>
                              </form>

                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                              <button id="registraremail" type="button" class="btn btn-primary">Registrar</button>

                            </div>
                          </div>
                        </div>
                      </div> 
                      
<!-------------------- BOTÃO DA MODAL ------------------->
     
      </div>
</div>
           <!-------------------- BOTÃO DA MODAL ------------------->
         
    <script src="view\js\multi-select-tag.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/participantes.js"></script>

</body>

</html>