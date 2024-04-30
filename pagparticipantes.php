<?php

namespace formulario;

include_once ("app/acoesform.php");
include ("conexao.php");

$puxarform= new AcoesForm;
$facilitadores=$puxarform->selecionarFacilitadores();
$pegarfa=$puxarform->pegarfacilitador();
$resultados = $puxarform->pegandoTudo();
$puxaparticipantes = $puxarform->buscarParticipantesPorIdAta($id_ata = "?");
$ultimaata = $puxarform->pegarUltimaAta();

$pegarid = $puxarform->puxarId();
$sql="SELECT * FROM assunto where id=$id ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
    $datasolicitada = $row['data_solicitada'];
    $tema = $row['tema'];
    $objetivo = $row['objetivo'];
    $password = $row['local'];
    $horainic = $row['hora_inicial'];
    $horaterm = $row['hora_termino'];



    // Usando $facilitadoresString na sua string de saída
    // echo "Facilitadores - $facilitadoresString, 
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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-JCHjo1FjBu5zj08fFZ8niXNt6IuPO3WJ10Ii+XXITZ7IU46Scij9MJTf/ZZTK5HVm/BwOxAnoxO8cSvDaz9VWg==" crossorigin="anonymous" />
</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar shadow">
      <div id="container" style="background-color: #001f3f;">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
            <h1 id="tittle" class="text-center"> 2° FASE</h1>
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
          <i class="fa fa-info-circle" aria-hidden="true"></i>
          <i class="fa-solid fa-circle-info"></i>
            <h5>Informações de Registro</h5>
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
                    <label><b>Data*:</b></label>
                    <ul class="form-control bg-body-secondary"> <?php echo $row['objetivo'];  ?> </ul>
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
              <ul class="form-control bg-body-secondary"><?php echo $facilitadoresString; ?></ul>  
            </div>
          
 
          <div class="col-3">
            <label><b>Local:</b></label>
            <ul class="form-control bg-body-secondary border rounded"><?php echo $local; ?></ul>
          </div>

          <div class="col-3">
              <label for="form-control"> <b>Objetivo:</b> </label>
              <label class="form-control bg-body-secondary border rounded">
                <input type="checkbox" disabled checked> <?php echo $row['objetivo']; ?>
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
  </div>

<!-----------------------------2° FASE-------------------------------->
<br>
<div class="accordion">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #1c8f69;;">
    <i class="fa-solid fa-circle-info"></i>
    <h5>Participantes</h5>
</div>
  </h2>                                                                                                                                       
        <main class="container-fluid ">
        <div class="row">
          <form id="addForm">
              <div class="form-group ">
                  <br>
                  <div id="items" class="list-group">                    
              </div>
                  <label for="item"><b>Informe os participantes<b></label>

                  <div class="row">
                    <div class="col" style="widht: 50px;"> 
                    <select class="col form-control" id="participantesadicionados" name="facilitador" multiple style="width: 100px;">
                      <optgroup label="Selecione Facilitadores">
                          <?php foreach ($pegarfa as $facnull) : ?>
                              <option value="<?php echo $facnull['id']; ?>"
                                  data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                                  <?php echo $facnull['nome_facilitador']; ?>
                              </option> <?php endforeach ?>
                       </optgroup>
                    </select>
        </div>
              
             
          </form>
          <div  class="row">
          <div class="col">
           <button style="width: 30%; padding:0px;margin:5px; background-color:white; color:#353535; border:none;" id="botaoregistrar" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modaldeemail">
              Clique aqui para cadastrar usúario 
            </button>
       </div>
      </div>
    </div>
<br>
           
      <!--BOTÕES-->
      <div class="container d-flex justify-content-center">
        <div class="row">

          <div class="col">
              <button id="botaocontinuarata" type="button" class="btn btn-success" data-bs-toggle="modal">
                Continuar ata
              </button>
              <script>
                function abrirDeliberacoes(){
                  window.location.href = 'pagdeliberacoes.php';
                }
              </script>

        </div>
        <div class="col">
                  
              <button onclick="abrirHistorico()"  id="botaoregistrar" type="button" class="btn btn-primary" data-bs-toggle="modal">
                Atualizar a ata
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

            </div>
</main>
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