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

$puxatexto = $puxarform->textprinc($id_pagina);
$texto_principal = !empty($puxatexto) ? $puxatexto[0] : '';

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
  <header>
    <nav class="navbar shadow">
      <div id="container" style="background-color: #001f3f;">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
          <h1 id="tittle" class="text-center">Reunião</h1>
        </div>
      </div>
    </nav>
  </header>
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
<form id="formSalvarInformacoes" method="post">
    <input type="hidden" id="idAta" name="idAta" value="">
    <div class="accordion">
        <div class="accordion-item shadow">
            <h2 class="accordion-header">
                <div class="accordion-button shadow-sm text-white" style="background-color: #1c8f69;">
                    <i class="fa-solid fa-circle-info"></i>
                    <h5>Participantes</h5>
                </div>
            </h2>
            <main class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div>
                            <div style="margin: 3px" class='form-control bg-body-secondary border'>
                                <ul>
                                    <?php
                                    if (isset($_GET['updateid'])) {
                                        $id_ata = $_GET['updateid'];
                                        $participantes = $puxarform->ParticipantesPorIdAta($id_ata);
                                        if (!empty($participantes)) {
                                            // Ordena os participantes em ordem alfabética
                                            sort($participantes);
                                            
                                            // Exibe os participantes separados por vírgulas
                                            echo "<span style='font-size: 18px;'>";
                                            echo implode(', ', $participantes);
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
            </main>
        </div>
    </div>
</form>
<div class="accordion mt-4">
    <div class="accordion-item shadow">
        <h2 class="accordion-header">
            <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
                <i class="fa-regular fa-pen-to-square p-1 mb-1"></i>
                <h5>Descrição do Encontro</h5>
            </div>
        </h2>
        <div class="accordion-collapse collapse show">
            <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
                <div class="col-md-12 text-center">               
                </div>
                <div class="row">
                    <div class="col">
                        <ul id="textoPrincipalList" class="list-group">
                            <?php
                            $puxatexto = $puxarform->textprinc($id_pagina);
                            $texto_principal = !empty($puxatexto) ? $puxatexto[0] : '';
                            if (!empty($texto_principal)) {
                            ?>
                                <li class="form-control bg-body-secondary border rounded">
                                    <div>
                                        <?php echo $texto_principal; ?>
                                    </div>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="form-control bg-body-secondary border rounded">
                                    <div>
                                        <strong></strong> Não há descrição para esse encontro.
                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
<div class="accordion mt-4">
    <div class="accordion-item shadow">
        <h2 class="accordion-header">
            <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
                <i class="fa-solid fa-file p-1 mb-1"></i>
                <h5>Deliberações do encontro</h5>
            </div>
        </h2>
        <div class="accordion-collapse collapse show">
            <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
                <div class="col-md-12 text-center"></div>
                <div id="existingDeliberations" class="mt-3">
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
            </div>
        </div>
    </div>
    
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="view/js/multi-select-tag.js"></script>
</body>
</html>