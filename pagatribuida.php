<?php

namespace formulario;
$id = $_GET['updateid'];
include_once("app/acoesform.php");
include("conexao.php");

$puxarform = new AcoesForm;
$facilitadores = $puxarform->selecionarFacilitadores();
$pegarfa = $puxarform->pegarfacilitador();
$puxaparticipantes = $puxarform->buscarParticipantesPorIdAta($id_ata = "?");
$puxadeliberacoes = $puxarform->buscarDeliberacoesPorIdAta($id_ata = "?");
$resultados = $puxarform->pegandoTudo();
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

    $sql2 = "SELECT 
    fac.nome_facilitador as facilitadores,
    fac.id as idfacilitadores
    
    FROM ata_has_fac as ahf
    INNER JOIN facilitadores as fac
      ON fac.id = ahf.facilitadores
    where ahf.id_ata = $id";

    $result2 = mysqli_query($conn, $sql2);
    $facilitadores = array(); 

      while ($row2 = mysqli_fetch_assoc($result2)) { 
          $facilitadores[] = $row2;
      }

$participantesArray = $pegarfa;

$pegarde=$puxarform->pegarfacilitador();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "atareu";

//Cria a conexão
$conn = new \mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta SQL para selecionar os dados
// $sql = "SELECT id, data_registro, tema, data_solicitada, objetivo, hora_inicial, hora_termino, tempo_estimado, local, status FROM assunto ORDER BY data_registro DESC";
$result = $conn->query($sql);


function identificarIdPagina() {
  if(isset($_GET['updateid'])) {
      return $_GET['updateid'];
  } else {
      return null;
  }
}
$id_pagina = identificarIdPagina();
print_r($id_pagina);

$puxatexto = $puxarform->textprinc($id_pagina);
$texto_principal = !empty($puxatexto) ? $puxatexto[0] : '';
print_r($puxatexto);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ata de encontro - HRG</title>
  <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

  <script src="view/js/popper.min.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="view/css/styles.css">
  <link rel="stylesheet" href="view/css/bootstrap.min.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="view/css/bootstrap.css">
  <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">

  <link rel="stylesheet" href="view\css\multi-select-tag.css">


</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar shadow">
      <div id="container" style="background-color: #001f3f;">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
          <h1 id="tittle" class="text-center">Atribuição</h1>
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
          <div class="col-md-6 col-md-2">
              <label for="form-control"><b>Data</b></label>
            <div class="form-control bg-body-secondary">
              <?php
                if (isset($_GET['updateid'])) {
                  $id_ata = $_GET['updateid'];
                  $atas = $puxarform->pegandoTudo();
                  $ata_encontrada = null;
                  foreach ($atas as $ata) {
                    if ($ata['id'] == $id_ata) {
                      $ata_encontrada = $ata;
                        break;
                    }
                  }
                if ($ata_encontrada) {
                  echo $ata_encontrada['data_solicitada_formatada'];
                } else {
                  echo "Nenhuma ATA encontrada com o ID fornecido.";
                }
                } else {
                  echo "Nenhum ID de ATA fornecido.";
                }
                ?>
              </div>
              </div>
              <div class="col-md-6 col-md-2">
                  <label for="form-control"><b>Objetivo</b></label>
                  <ul class="form-control bg-body-secondary"><?php echo $row['objetivo']; ?></ul>     
              </div>
          <div class="col-md-6 col-md-2">
            <label for="form-control"><b>Facilitadores</b></label>
            <div class="form-control bg-body-secondary">
                <?php
                if (isset($_GET['updateid'])) {
                    $id_ata = $_GET['updateid'];
                    $atas = $puxarform->pegandoTudo();
                    $ata_encontrada = null;
                    foreach ($atas as $ata) {
                        if ($ata['id'] == $id_ata) {
                            $ata_encontrada = $ata;
                            break;
                        }
                    }

                    if ($ata_encontrada) {
                        echo $ata_encontrada['facilitador'];
                    } else {
                        echo "Nenhuma ATA encontrada com o ID fornecido.";
                    }
                } else {
                    echo "Nenhum ID de ATA fornecido.";
                }
                ?>
            </div>
        </div>
        <div class="col-md-6 col-md-2">
            <label for="form-control"><b>Tema</b></label>
            <ul class="form-control bg-body-secondary"><?php echo $row["tema"]; ?></ul>
        </div>
        <div class="col-md-6 col-md-2">
            <label for="form-control"> <b>Local</b> </label>
            <ul class="form-control bg-body-secondary"><?php echo $row["local"]; ?></ul>
        </div>
        <div class="col-md-6 col-md-2">
            <label for="form-control"> <b>Status</b> </label>
            <ul class="form-control bg-body-secondary"><?php echo $row['status']; ?></ul>
        </div>
       
  </div>
      </div>
<!------------ACCORDION COM INFORMAÇÕES DE PARTICIPANTES---------------->
<br>
<form id="formSalvarInformacoes" method="post">
  <input type="hidden" id="idAta" name="idAta" value="">
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
          <br>
          <div class="col">
            <label for="form-control"><b>Adicione participantes</b></label>
            <br>
            <form id="addForm">
              <div class="col-12 form-group ">
                  <div class="col">
                  <select class="col-8 form-control" id="participantesadicionado" name="facilitador" multiple data-id-ata="<?php echo isset($_GET['updateid']) ? $_GET['updateid'] : ''; ?>">
    <optgroup label="Selecione Facilitadores">
        <?php foreach ($pegarfa as $facilitador) : ?>
            <?php
            // Verifica se o facilitador já está na ATA
            $estaNaAta = false;
            foreach ($participantes as $participante) {
                if ($participante['id'] == $facilitador['id']) {
                    $estaNaAta = true;
                    break;
                }
            }
            // Se o facilitador não estiver na ATA, exibe no seletor
            if (!$estaNaAta) :
            ?>
                <option value="<?php echo $facilitador['id']; ?>" data-tokens="<?php echo $facilitador['nome_facilitador']; ?>">
                    <?php echo $facilitador['nome_facilitador']; ?>
                </option>
            <?php endif; ?>
        <?php endforeach; ?>
    </optgroup>
</select>

                  </div>
              </div>
          </form>
          
          <div class="d-flex align-items-center">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#listaParticipantesModal" style="background-color: #001f3f; border-color: #001f3f;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 1em; height: 1em; vertical-align: -0.125em;">
      <path fill="#ffffff" d="M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z"/>
    </svg>
  </button>
  <span class="ms-2">Participantes da ata</span>
</div>
<div class="modal fade" id="listaParticipantesModal" tabindex="-1" aria-labelledby="listaParticipantesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listaParticipantesModalLabel">Participantes da ata</h5>
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

<br>
<?php
$conn->close();
?>
</div>
</div>
</main>
</div>
</div>
</form>





<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("addForm").addEventListener("submit", function(event) {
        event.preventDefault(); 
        var select = document.getElementById("participantesadicionado");
        var selectedOptions = select.selectedOptions;
        for (var i = 0; i < selectedOptions.length; i++) {
            var selectedOption = selectedOptions[i];
            var participante = selectedOption.textContent.trim();
            var participanteId = selectedOption.value;
            if (!participanteJaAdicionado(participante)) {
                adicionarParticipanteAoLabel(participante);
                selectedOption.remove(); 
            }
        }
    });
    $('#participantesadicionado').change(function() {
        var selected_ids = [];
        var selected_names = [];
        $('#participantesadicionado option:selected').each(function() {
            selected_ids.push($(this).val());
            selected_names.push($(this).text());
        });

        console.log(selected_ids);
        console.log(selected_names);
    });
});
function participanteJaAdicionado(participante) {
    var label = document.getElementById("participantesLabel");
    return label.textContent.includes(participante);
}
function adicionarParticipanteAoLabel(participante) {
    var label = document.getElementById("participantesLabel");
    var participanteItem = document.createElement("span");
    participanteItem.textContent = participante;
    participanteItem.classList.add("badge", "bg-secondary", "me-1");
    label.appendChild(participanteItem);
}
</script>

<!-----------------------------ACCORDION COM PARTICIPANTES-------------------------------->
<br>
<div class="accordion">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
      <h5>Deliberações</h5>
</div>
  </h2>

<!-----------------------------4° FASE-------------------------------->

<div class="accordion-collapse collapse show">
    <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
        <div class="col-md-12 text-center"></div>
        
        <div class="row">
            <div class="col">
                <label style="height: 35px;"><b>Informe o texto principal:</b></label>
                <textarea id="textoprinc" style="height: 110px;" class="form-control"><?php echo $texto_principal; ?></textarea>
            </div>
        </div>    
        <div id="existingDeliberations" class="mt-3">
    <h5>Deliberações Existentes:</h5>
    <ul id="deliberationsList" class="list-group">
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
          foreach ($deliberacoesAgrupadas as $conteudo => $deliberadores) {
              $deliberadoresStr = implode(', ', $deliberadores);
              ?>
              <li class="form-control bg-body-secondary border rounded">
                  <div>
                      <strong></strong> <?php echo $deliberadoresStr; ?>
                  </div>
              </li>
              <li class="form-control border rounded">
                  <div>
                      <strong></strong> <?php echo $conteudo; ?>
                  </div>
              </li>
              <?php
          }
      }
    ?>
    </ul>
</div>
        <span class="col-4" id="inputContainer"></span>   
        <form id="addForm">
            <div class="form-group">
                <div class="col">
                    <br>
                    <ul class="list-group list-group-flush"></ul>
                    <label class="h4" style="height: 35px;"><b>DELIBERAÇÕES</b></label>
                    <textarea id="deliberacoes" class="form-control item" placeholder="Informe as deliberações..." style="height: 85px;" multiple data-id-ata="<?php echo isset($_GET['updateid']) ? $_GET['updateid'] : ''; ?>"></textarea>
                </div>
    <div class="col">
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
        <div class="row">
    <div class="col text-center">
        <button id="atribuida" class="btn btn-primary">Finalizar reunião</button>
    </div>
</div>
    </form>       
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
    </form>
        </div>          
    </div>
</form>
<script>

</script>
      </div>
    </div>
  </div>
</div>     
</main>
</div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="view/js/multi-select-tag.js"></script>
    <script src="app/deliberacoes.js"></script>
    <script src="app/gravaratribuida.js" data-id-ata="<?php echo $id_ata; ?>"></script>
    <script src="app/excluiratribuida.js"></script>
    
</body>
</html>