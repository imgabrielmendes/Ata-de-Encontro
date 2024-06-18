<?php
namespace formulario;
session_start();
include_once ("app/acoesform.php");
include ("conexao.php");

$puxarform = new AcoesForm;
// $pegarde = $puxarform->pegarfacilitador();

$ultimosfacilitadores = $puxarform->puxandoUltimosFacilitadores();


$facilitadoresString = '';
foreach ($ultimosfacilitadores as $facilitador) {
    $facilitadoresString .= $facilitador['nome_facilitador'] . ', ';
}

$facilitadoresString = rtrim($facilitadoresString, ', ');

$ultimaata = $puxarform->pegarUltimaAta();
$data = $_SESSION['data'];
$dateTime = new \DateTime($data);
$data_formatada = $dateTime->format('d/m/Y');
$_SESSION['data'] = $data_formatada;

function identificarIdPagina() {
  return isset($_GET['updateid']) ? $_GET['updateid'] : null;
}

$id_ata = identificarIdPagina();
$puxatexto = $puxarform->textprinc($id_ata);
$texto_principal = !empty($puxatexto) ? $puxatexto[0] : '';

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">

  <link rel="stylesheet" href="view\css\multi-select-tag.css">


</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
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
                <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/"><img src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png" alt="Central de Serviço" style="width: 160px">
                </a>

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
            <h2 class="m-3 text-light shadow"><i class="fas fa-users"></i> Registro de Encontro</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!--FORMULÁRIO-->

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-xl-9 col-lg-xs-sm-md-12">
        <div class="row"> 
          
    <div class="accordion" id="accordionPanelsStayOpenExample">

      <div class="accordion-item shadow">
        <h2 class="accordion-header">
          <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #001f3f;">
          <i class="fa-solid fa-circle-info p-1 mb-1"></i><h5>Informações de Registro</h5>
           
          </button>
        </h2>

    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse ">
      <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
          <div class="col-md-12 text-center">         
          </div>     

          <!---- PRIMEIRA LINHA DO REGISTRO ---->
          <div class="row">
    
    <div class="col-sm-12 col-xl-3  col-md-6">
        <label><b>Data:</b></label>
        <ul class="form-control bg-body-secondary"> <?php echo $_SESSION['data']; ?> </ul>
    </div>

    <!---ABA DE HORÁRIO INICIO---->
    <div class="col-sm-12 col-xl-3  col-md-6">
        <label for="nomeMedico"><b>Horário de Início:</b></label>
        
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
        if (isset($_SESSION['horainicio']) && isset($_SESSION['horaterm'])) {
            $inicio = strtotime($_SESSION['horainicio']);
            $termino = strtotime($_SESSION['horaterm']);
            $diferencaMinutos = ($termino - $inicio) / 60;

            $horas = floor($diferencaMinutos / 60);
            $minutos = $diferencaMinutos % 60;

            $horas_formatado = sprintf("%02d", $horas);
            $minutos_formatado = sprintf("%02d", $minutos);

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
          <div class="col-lg-6  col-lg-md-12 col-md-12">
        <label><b>Facilitador(es):</b></label>
        <ul class="form-control bg-body-secondary"><?php echo $facilitadoresString; ?></ul>
    </div>
          
 
    <div class="col-lg-3  col-lg-md-12 col-md-6">
        <label><b>Local:</b></label>
        <ul class="form-control bg-body-secondary border rounded"><?php echo $_SESSION['local']; ?></ul>
    </div>
    <div class="col-lg-3  col-lg-md-12 col-md-6">
        <label for="form-control"> <b>Objetivo:</b> </label>
        <label class="form-control bg-body-secondary border rounded">
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
<!------------ACCORDION COM INFORMAÇÕES DE PARTICIPANTES---------------->
<div class="accordion mt-4" id="accordionPanelsStayOpenExample">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo" style="background-color: #1c8f69;">

    <i class="fas"></i>
    <i class="fa-solid fa-user p-1 mb-1"></i><h5>Participantes Adicionados </h5>

    </button>
  </h2>

<div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse ">
<div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
    <div class="col-md-12 text-center">         
          
    </div>     

    <div class="row">
    <div class="col">
        <div>
            <div class='form-control bg-body-secondary border rounded'>
                <ul>
                <?php
                    if (isset($_GET['updateid'])) {
                      $id_ata = $_GET['updateid'];
                      $participantes = $puxarform->ParticipantesPorIdAta($id_ata);
                      if (!empty($participantes)) {

                          $nomesParticipantes = array();

                          foreach ($participantes as $participante) {
                              $nomesParticipantes[] = $participante['participantes'];
                          }

                          sort($nomesParticipantes);

                          echo "<span style='font-size: 18px;'>";
                          echo implode(', ', $nomesParticipantes);
                          echo "</span>";
                      } else {
                          echo "Nenhum participante encontrado para esta ATA.";
                      }
                    } else {
                      echo "Nenhum ID de ATA fornecido.";
                    }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="d-flex align-items-center">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#listaParticipantesModal" style="background-color: #001f3f; border-color: #001f3f;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 1em; height: 1em; vertical-align: -0.125em;">
      <path fill="#ffffff" d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/>
    </svg>   Participantes da reunião
  </button>
  <!-- <span class="ms-2">Participantes da reunião</span> -->
</div>
<div class="modal fade" id="listaParticipantesModal" tabindex="-1" aria-labelledby="listaParticipantesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listaParticipantesModalLabel">Participantes da reunião</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php
          if (isset($_GET['updateid'])) {
            $id_ata = $_GET['updateid'];
            $participantes = $puxarform->buscarParticipantesPorIdAta($id_ata);
            if (!empty($participantes)) {
                // Ordena os participantes em ordem alfabética pelo nome do facilitador
                usort($participantes, function($a, $b) {
                    return strcmp($a['nome_facilitador'], $b['nome_facilitador']);
                });

                echo "<table class='table'>";
                echo "<thead><tr><th>Matrícula</th><th>Nome</th><th>Email</th><th>Ações</th></tr></thead>";
                echo "<tbody>";
                foreach ($participantes as $participante) {
                    // Aqui, você pode acessar os dados adicionais do facilitador usando $participante
                    // Suponho que $participante já contenha os dados da tabela facilitadores
                    echo "<tr id='participante-$id_ata-$participante[nome_facilitador]'>";
                    echo "<td>{$participante['matricula']}</td>"; // Coluna de Matrícula
                    echo "<td>{$participante['nome_facilitador']}</td>"; // Coluna de Nome
                    echo "<td>{$participante['email_facilitador']}</td>"; // Coluna de Email
                    // Botão de Excluir com chamada para a função JavaScript excluirParticipante
                    echo "<td><button type='button' class='btn btn-danger btn-sm' onclick='excluirParticipante($id_ata, \"{$participante['nome_facilitador']}\")'>Excluir</button></td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "Nenhum participante encontrado para esta ATA.";
            }
          } else {
            echo "Nenhum ID de ATA fornecido.";
          }
        ?>
      </div>
    </div>
  </div>
</div>

<script>
  function excluirParticipante(participante) {
    if (confirm("Tem certeza de que deseja excluir o participante '" + participante + "'?")) {
      var participanteElement = document.querySelector("li:contains('" + participante + "')");
      if (participanteElement) {
        participanteElement.remove();
      } else {
        alert("Participante não encontrado na lista.");
      }
    }
  }
</script>

</div>
</div>
</div>
</div>
  </div>



  <!-- texto principal -->




<div class="accordion mt-4">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
    <i class="fa-regular fa-pen-to-square p-1 mb-1"></i><h5>Descrição do Encontro</h5>

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
        <textarea id="textoprinc" name="texto_principal" style="height: 110px;" class="form-control"><?php echo htmlspecialchars($texto_principal, ENT_QUOTES, 'UTF-8'); ?></textarea>



              </div>
    </div>   
        
    <div class="d-flex justify-content-center mt-3">
    <button id="registrarTextoButton" type="button" class="btn btn-primary" data-id-ata="<?php echo $id_ata; ?>">Registrar Texto</button>
</div>

<script>
document.getElementById('registrarTextoButton').addEventListener('click', function() {
    Swal.fire({
        title: "Confirmação",
        text: "Deseja Finalizar encontro ou continuar modificando?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Finalizar",
        cancelButtonText: "Continuar"
    }).then((result) => {
        if (result.isConfirmed) {
            enviarTexto('finalizar');
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            enviarTexto('continuar');
        }
    });
});

function enviarTexto(acao) {
    var textoPrincipal = document.getElementById('textoprinc').value;
    var idAta = document.getElementById('registrarTextoButton').getAttribute('data-id-ata');
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'textprincbanco.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            Swal.fire({
                title: "Sucesso!",
                text: "O texto foi inserido com sucesso!",
                icon: "success",
            }).then(() => {
                if (acao === 'finalizar') {
                    setTimeout(function() {
                        var url = 'paghistorico.php';
                        window.location.href = url;
                    }, 100);
                } else {
                    location.reload();
                }
            });
        } else if (xhr.readyState == 4) {
            Swal.fire({
                title: 'Erro!',
                text: 'Ocorreu um erro ao atualizar o texto.',
                icon: 'error',
                confirmButtonText: 'OK',
                timer: 2500
            }).then((result) => {
                if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                    location.reload();
                }
            });
        }
    }
    xhr.send('id_ata=' + idAta + '&textoprincipal=' + encodeURIComponent(textoPrincipal));
}
</script>

            </div>          
</div>

  </div>
    </div>
<!---------------------------------------------------------------------->

<div class="accordion mt-4">
  <div class="accordion-item shadow">
    <h2 class="accordion-header">
      <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
      <i class="fa-regular fa-pen-to-square p-1 mb-1"></i><h5>Deliberações Adicionadas</h5>
  </div></h2>
  
  <div class="accordion-collapse collapse show">
    <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
      <div class="col-md-12 text-center"></div>
      
      <div class="row">
        <div class ="col">
          <div id="existingDeliberations" class="mt-3">
                          <div id="deliberationsList" class="list-group">
                          <?php
                              $deliberacoes = $puxarform->buscarDeliberacoesPorIdAta($id_ata);
                              if (!empty($deliberacoes)) {
                                  $deliberacoesAgrupadas = [];
                                  foreach ($deliberacoes as $deliberacao) {
                                      $conteudo = $deliberacao['deliberacoes'];
                                      $deliberador = $deliberacao['deliberador'];
          
                                      if (!isset($deliberacoesAgrupadas[$conteudo])) {
                                          $deliberacoesAgrupadas[$conteudo] = [];
                                      }
          
                                      $deliberacoesAgrupadas[$conteudo][] = $deliberador;
                                  }
                                  $contagemdeli = 0;
                                  foreach ($deliberacoesAgrupadas as $conteudo => $deliberadores) {
                                      $contagemdeli++;
                                      $deliberadoresStr = implode(', ', $deliberadores);
                                      ?>
                                      <div style="margin-bottom: 15px;" data-conteudo="<?php echo $conteudo; ?>">
    <span class="col-2 badge rounded-pill text-bg-secondary mt-2 mb-2">
        <label for="" class="mb-1 mt-1">
            Deliberação N°<?php echo $contagemdeli; ?>
        </label>
    </span>
    <div class="row">
        <div class="row"></div>
        <div class="col-12">
            <li class="form-control bg-body-secondary border rounded">
                <div>
                    <strong>Deliberador:</strong> <?php echo $deliberadoresStr; ?>
                </div>
            </li>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-11">
            <div class="form-control border rounded">
                <strong>Deliberação:</strong> <?php echo $conteudo; ?>
            </div>
        </div>
        <div class="col-1">
        <button class="btn btn-danger btn-sm delete-deliberacao mt-2" data-id-ata="<?php echo $id_ata; ?>" data-conteudo="<?php echo $conteudo; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="mr-2" style="width: 1em; height: 1em;">
                        <path fill="#ffffff" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg>
                </button>
            </div>
            </div>
            </div>
            <hr class="mt-3 mb-3 ">

                                     
                                      <?php
                                  }
                              }
                              ?>
                          </div>
                          <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('.delete-deliberacao').forEach(button => {
                                    button.addEventListener('click', function() {
          
                                        var idAta = this.getAttribute('data-id-ata');
                                        var conteudo = this.getAttribute('data-conteudo');
          
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'excluirdeli.php', true);
                                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function() {
                                            if(xhr.readyState == 4 && xhr.status == 200) {
                                                document.querySelector('div[data-conteudo="' + conteudo + '"]').remove();
                                                location.reload(); // Recarrega a página após a exclusão
                                            }
                                        };
                                        xhr.send('id_ata=' + encodeURIComponent(idAta) + '&conteudo=' + encodeURIComponent(conteudo));
                                    });
                                });
                            });
          
                          </script>
      </div>
      </div>   


</div>          
</div>
</div>
</div>

<!-----------------------------ACCORDION COM PARTICIPANTES-------------------------------->

<div class="accordion mt-4">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
    <i class="fa-solid fa-file p-1 mb-1"></i><h5>Deliberações</h5>
</div>
  </h2>

<div class="accordion-collapse collapse show">
<div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
    <div class="col-md-12 text-center">               
    </div>
    
    <!-- <span class="col d-flex align-items-end flex-column" id="inputContainer"></span> -->
    
    <style>
      .item-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
    </style>

        <form id="addForm">
        <div class="form-group">
        <div class="col">
          
              
              <ul class="list-group list-group-flush"></ul>              
              <textarea id="deliberacoes" class="form-control item" placeholder="Informe as deliberações..." style="height: 85px;"></textarea>
            </div>

            <div class="col">
    <!-- Primeira caixa de texto e select de facilitadores -->
    <div class="mb-2">
        <label for="" class="mb-2">Atribuido para:</label>
        <?php
          if (isset($_GET['updateid'])) {
            $id_ata = $_GET['updateid'];
            $resultados = $puxarform->ParticipantesPorIdAta($id_ata);
            // var_dump($resultados);

            $pegarde = [];
            foreach ($resultados as $row) {
              $pegarde[$row['id']] = $row['participantes'];
            }
        ?>
            <select id="deliberador" class="form-control facilitator-select" placeholder="Deliberações" multiple>
                <optgroup label="Selecione Facilitadores">
                    <?php
                    foreach ($pegarde as $index => $nome) {
                        if (is_string($nome)) {
                            ?>
                            <option value="<?php echo htmlspecialchars($index); ?>"
                                data-tokens="<?php echo htmlspecialchars($nome); ?>">
                                <?php echo htmlspecialchars($nome); ?>
                            </option>
                            <?php
                        } else {
                            echo "<!-- Dado inválido: ";
                            var_dump($nome);
                            echo " -->";
                        }
                    }
                    ?>
                </optgroup>
            </select>
        <?php
        } else {
            echo "PORRA, DEU ERRADO";
        }
        ?>
    </div>
</div>


  <div class="col-12">
    <ul id="caixadeselecaodel"></ul>
      <div class="col d-flex justify-content-center align-content-center">
    
    <button type="button" id="addItemButton" class="btn btn-success  a">Criar deliberações</button>
  </div>

</div>
</div>

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast3" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="view/img/check.svg" class="rounded me-2" alt="..." style="width: 20px";>
          <strong class="me-auto">Perfeito!</strong>
          <small>Agora</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
         Descrição de encontro adicionado!
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

        
        
        <div class="col-12">

        <!-- <button id="" type="button" class="btn btn-primary" data-bs-toggle="modal"> Atualizar a ata </button> -->
        <div class=" col d-flex justify-content-center align-content-center">
           <button id="finalizarAtaBtn" type="button" class="btn btn-secondary" data-bs-toggle="modal">Finalizar Encontro</button>
          </div></div>

    </form>
          
            </div>          
</div>
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
    <script src="app/pagdeliberacoes.js"></script>
    <script src="app/excluiratribuida.js"></script>

</body>

</html>