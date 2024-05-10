<?php

namespace formulario;

// include("vendor/autoload.php");
include_once("app/acoesform.php");
include("conexao.php");

$puxarform = new AcoesForm;
$facilitadores = $puxarform->selecionarFacilitadores();
$pegarfa = $puxarform->pegarfacilitador();
$pegarid = $puxarform->puxarId();
$resultados = $puxarform->pegandoTudo();
$puxaparticipantes = $puxarform->buscarParticipantesPorIdAta($id_ata = "?");
$ultimaata = $puxarform->pegarUltimaAta();



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

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ata de encontro - HRG</title>
    <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

    <!---------------------------------------------------------------->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/bootstrap.css">
    <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">


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
            <h2 class="m-3 text-light shadow"><i class="fas fa-users"></i> Histórico</h2>
          </div>
        </div>
      </div>
    </div>
  </header>
    <div class="box box-primary">
        <main class="container d-flex justify-content-center align-items-center" class="text-center">
            <div class="form-group col-12">
                <div class="row">
                    <div class="text-center" class="row">
                        <table id="" class="table table-striped">
                            <tbody>
                                <div class="accordion" id="accordionPanelsStayOpenExample" class="text-center">
                                    <div class="accordion-item text-center">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button shadow-sm text-white text-center" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #1c8f69 ">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                <i class="fa-solid fa-circle-info"></i>
                                                <h5>Filtro de Atas</h5>
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" class="text-center">
                                            <div class="accordion-body">
                                                <div class="col">
                                                    <br>
                                                    <input id="temaprincipal" class="form-control" type="text" onkeyup="filtrarTabela()" placeholder="Filtrar registros..." />
                                                </div>
                                                <!-- <input style="border: 1px solid #0000;" class="form-control item" type="text" id="filtroInput" onkeyup="filtrarTabela()" placeholder="Filtrar registros..."> -->

                                                <br>
                                                <div class="row">
                                                    <div class="col-4" style="text-align: left;">
                                                        <b>Objetivo</b>
                                                        <select class="form-control" id="objetivoSelect" onchange="filtrarRegistros(event)">
                                                            <option value="">Selecione o objetivo</option>
                                                            <option value="Reunião">Reunião</option>
                                                            <option value="Treinamento">Treinamento</option>
                                                            <option value="Consulta">Consulta</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4" style="text-align: left;">
                                                        <b>Solicitação</b>
                                                        <input class="form-control" type="date" id="solicitacaoInput" onchange="filtrarRegistros(event)">
                                                    </div>
                                                    <div class="col-4" style="text-align: left;">
                                                        <b>Status</b>
                                                        <select class="form-control" id="statusSelect" onchange="filtrarRegistros(event)">
                                                            <option value="">Selecione o status</option>
                                                            <option value="Aberta">Aberta</option>
                                                            <option value="Fechada">Fechada</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                        </tbody> 
                    </table>
<table id="myTable" class="table  table-hover shadow">
    <thead>
    <tr>
        <th class="text-center">Data</th>
        <th class="text-center">Objetivo</th>
        <th class="text-center">Facilitador</th>
        <th class="text-center">Tema</th>
        <th class="text-center">Local</th>
        <th class="text-center">Status</th>
        <th class="text-center">Ação</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT 
        assunto.id, 
        DATE_FORMAT(assunto.data_solicitada, '%d/%m/%Y') AS data_formatada, 
        assunto.objetivo, 
        assunto.tema, 
        assunto.local, 
        assunto.status, 
        GROUP_CONCAT(DISTINCT facilitadores.nome_facilitador SEPARATOR ', ') AS facilitadores,
        GROUP_CONCAT(DISTINCT CONCAT(facilitadores.nome_facilitador, ': ', textoprinc.texto_princ) ORDER BY facilitadores.nome_facilitador SEPARATOR '<br>') AS deliberadores_deliberacoes
    FROM 
        assunto
    LEFT JOIN 
        ata_has_fac ON assunto.id = ata_has_fac.id_ata
    LEFT JOIN 
        facilitadores ON ata_has_fac.facilitadores = facilitadores.id
    LEFT JOIN
        textoprinc ON assunto.id = textoprinc.id_ata
    GROUP BY 
        assunto.id, textoprinc.texto_princ
    ORDER BY 
        assunto.id DESC;
    ";

        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {               
            while($row = mysqli_fetch_assoc($result)) {
                $id =  $row['id'];
                $data_formatada = $row['data_formatada'];
                $objetivo = $row['objetivo'];
                $tema = $row['tema'];
                $local = $row['local'];
                $status = $row['status'];
                $facilitadores = $row['facilitadores'];

                echo "<tr>";
                echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["data_formatada"] . "</td>";
                echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["objetivo"] . "</td>";
                echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["facilitadores"] . "</td>";
                echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["tema"] . "</td>";
                echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["local"] . "</td>";
                echo "<td class='align-middle status-cell' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . ($row['status'] === 'ABERTA' ? "<span class='badge bg-primary'>ABERTA</span>" : "<span class='badge bg-success'>FECHADA</span>") . "</td>";
                echo "<td class='align-middle' style='display:none;'  onclick='abrirModalDetalhes(" . json_encode($row) . ")'>";
                echo "<td class='align-middle' style='display:none;' id='participantes" . $row['id'] . "'>"; 
                if (isset($row['id'])) {
                    $id_ata = $row['id'];
                    $puxaparticipantes = $puxarform->buscarParticipantesPorIdAta($id_ata);
                    if (!empty($puxaparticipantes) && is_array($puxaparticipantes)) {
                        $totalParticipantes = count($puxaparticipantes);
                        $count = 0;
                        foreach ($puxaparticipantes as $participante) {
                            echo $participante;
                            $count++;
                            if ($count < $totalParticipantes) {
                                echo ", <br>";
                            }
                        }
                    } else {
                        echo "Nenhum participante";
                    }
                } else {
                    echo "ID da ata não disponível";
                }
                echo "</td>";

                if (isset($row['id'])) {
                    $id_ata = $row['id'];
                    $deliberacoes = $puxarform->buscarDeliberacoesPorIdAta($id_ata);
                    if (!empty($deliberacoes) && is_array($deliberacoes)) {
                        // Inicializa um array associativo para armazenar as deliberações únicas e os deliberadores associados a cada deliberação
                        $deliberacoes_unicas = array();
                    
                        // Agrupa os deliberadores por deliberação, evitando repetições
                        foreach ($deliberacoes as $deliberacao) {
                            $texto_deliberacao = $deliberacao['deliberacoes'];
                            $deliberador = $deliberacao['deliberador'];
                            // Adiciona o deliberador apenas se esta deliberação ainda não estiver presente no array
                            if (!isset($deliberacoes_unicas[$texto_deliberacao])) {
                                $deliberacoes_unicas[$texto_deliberacao] = array();
                            }
                            // Adiciona o deliberador ao array associado à deliberação
                            $deliberacoes_unicas[$texto_deliberacao][] = $deliberador;
                        }
                    
                        echo "<td class='text-left' style='display:none;' id='deliberacoes" . $row['id'] . "'>";
                        // Exibe as deliberações únicas
                        foreach ($deliberacoes_unicas as $texto_deliberacao => $deliberadores) {
                            $classe_overflow = (strlen($texto_deliberacao) > 10) ? 'overflow-auto-y' : ''; // Verifica se o texto excede 500 caracteres
                            echo "<div class='form-control deliberacao  $classe_overflow' style='overflow-y: auto; max-height: 80px;'>" . $texto_deliberacao . "</div><br>";
                        }
                        
                        echo "</td>";
                    
                        echo "<td class='text-left' style='display:none;' id='deliberadores" . $row['id'] . "'>";
                        // Exibe os deliberadores associados a cada deliberação única
                        foreach ($deliberacoes_unicas as $texto_deliberacao => $deliberadores) {
                            $deliberadores_concatenados = implode(", ", $deliberadores);
                            // Verifica se o texto é grande o suficiente para justificar a barra de rolagem
                            echo "<div class='form-control deliberador'  >" . $deliberadores_concatenados . "</div><br>";
                        }
                        echo "</td>";
                    } else {
                        echo "<td class=' align-middle' style='display:none;' id='deliberacoes" . $row['id'] . "'>";
                        echo "<div class='form-control'>Nenhuma deliberação</div>";
                        echo "</td>";
                    
                        echo "<td class=' align-middle' style='display:none;' id='deliberadores" . $row['id'] . "'>";
                        echo "<div class='form-control'>Nenhum deliberador</div>";
                        echo "</td>";
                    }
                    
                    
                    
                    
                    

                } else {
                    echo "<td class='align-middle' style='display:none;' id='deliberacoes" . $row['id'] . "'>";
                    echo "ID da ata não disponível";
                    echo "</td>";

                    echo "<td class='align-middle' style='display:none;' id='deliberador" . $row['id'] . "'>";
                    echo "ID da ata não disponível";
                    echo "</td>";
                }     
                echo "<td>
                        <button class='btn btn-warning' style='color: white; '>
                            <a style='color:white; text-decoration:none;' class='text-center align-middle' href='pagatribuida.php? updateid=".$id."'>+</a>
                        </button>
                    </td>";
                echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum registro encontrado.</td></tr>";
                }
                ?>
    </tbody>
</table>
        </div>
    </div>
</div>
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informações de Registro da Ata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="accordion">
                    <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
                        <div class="col-md ">
                            <div class="row">
                                <div class="col-4">
                                    <label><b>Solicitação:</b></label>
                                    <ul class="form-control bg-body-secondary" id="modal_solicitacao"></ul>
                                  
                                </div>
                                <div class="col-4">
                                    <label><b>Objetivo:</b></label>
                                    <ul class="form-control bg-body-secondary border rounded" id="modal_objetivo"></ul>
                                </div>
                                <div class="col-4">
                                    <label><b>Facilitador:</b></label>
                                    <ul class="form-control bg-body-secondary border rounded" id="modal_facilitador"></ul>
                                </div>
                                <div class="col-4">
                                    <label><b>Local:</b></label>
                                    <ul class="form-control bg-body-secondary border rounded" id="modal_local"></ul>
                                </div>
                                <div class="col-4">
                                    <b>Tema:</b>
                                    <div class="col-12">
                                        <ul class="form-control bg-body-secondary" id="modal_tema"></ul>
                                    </div>
                                    
                                </div>
                                <div class="col-4">
                                    <label><b>Status:</b></label>
                                    <ul class="form-control bg-body-secondary border rounded" id="modal_status"></ul>
                                </div>
                                <div class="col-12">
                                    <label for="form-control"><b>Participantes</b></label>
                                    <ul class="form-control bg-body-secondary  border rounded" id="modal_participantes"></ul>
                                </div>
                                <br><br>
                                <div class="col-12">
                                    <div class="row">
                                        
                                    <label class="h3  "><b>Deliberações</b></label>
                                 
                                    <div class="col-6">
    <div class="col-12" id="modal_deliberadores"></div>
</div>
                                    <div class="col-6">
  
    <div class="col-12" id="modal_deliberacoes"></div>
</div>


                                </div>
                                </div>
                                                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function abrirModalDetalhes(row) {
        document.getElementById("modal_solicitacao").innerText = row.data_solicitada;
        document.getElementById("modal_objetivo").innerText = row.objetivo;
        document.getElementById("modal_facilitador").innerText = row.facilitador;
        document.getElementById("modal_local").innerText = row.local;
        document.getElementById("modal_tema").innerText = row.tema;
        document.getElementById("modal_status").innerText = row.status; 


        var deliberacoes = document.getElementById("deliberacoes" + row.id).innerHTML;
    document.getElementById("modal_deliberacoes").innerHTML = deliberacoes;

    var deliberadores = document.getElementById("deliberadores" + row.id).innerHTML;
    document.getElementById("modal_deliberadores").innerHTML = deliberadores;

        var participantes = document.getElementById("participantes" + row.id).innerText;
        document.getElementById("modal_participantes").innerText = participantes; 

        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            backdrop: 'static',
            keyboard: false 
        });
        myModal.show();
        }
    </script>






<!-- var participantes = document.getElementById("participantes" + row.id).innerText;
        document.getElementById("modal_participantes").innerText = participantes;  -->





    <script>
        function filtrarTabela() {
            var input, filtro, tabela, linhas, celula, texto;
            input = document.getElementById("temaprincipal");
            filtro = input.value.toUpperCase();
            tabela = document.getElementById("myTable");
            linhas = tabela.getElementsByTagName("tr");

            for (var i = 0; i < linhas.length; i++) {
                var encontrou = false; 
                celula = linhas[i].getElementsByTagName("td");
                for (var j = 0; j < celula.length; j++) {
                    if (celula[j]) {
                        texto = celula[j].innerText.toUpperCase() || celula[j].textContent.toUpperCase();
                        if (texto.indexOf(filtro) > -1) {
                            encontrou = true;
                            break;
                        }
                    }
                }
                if (encontrou) {
                    linhas[i].style.display = "";
                } else {
                    linhas[i].style.display = "none";
                }
            }
        }
        function filtrarRegistros(event) {
            event.preventDefault();
            var tabela, linhas;
            tabela = document.getElementById("myTable");
            linhas = tabela.getElementsByTagName("tr");

            var selectedObjective = document.getElementById("objetivoSelect").value.toUpperCase();
            var selectedSolicitacao = document.getElementById("solicitacaoInput").value; 
            var selectedStatus = document.getElementById("statusSelect").value.toUpperCase();

            for (var i = 1; i < linhas.length; i++) {
                var atendeFiltro = true; 
                var celulas = linhas[i].getElementsByTagName("td");
                var dataCelula = celulas[0].textContent.trim();
                if (selectedSolicitacao) {
                    var partesDataCelula = dataCelula.split("/");
                    var dataFormatadaCelula = partesDataCelula[2] + "-" + partesDataCelula[1] + "-" + partesDataCelula[0];
                    
                    if (dataFormatadaCelula !== selectedSolicitacao) {
                        atendeFiltro = false;
                    }
                }
                if (selectedObjective && celulas[1].innerText.toUpperCase() !== selectedObjective) {
                    atendeFiltro = false;
                }
                if (selectedStatus && celulas[5].innerText.toUpperCase() !== selectedStatus) {
                    atendeFiltro = false;
                }
                if (atendeFiltro) {
                    linhas[i].style.display = "";
                } else {
                    linhas[i].style.display = "none";
                }
            }
            window.scrollTo(0, 0);
        }
        window.onload = function() {
            var table = document.getElementById("myTable");
            var linhas = table.getElementsByTagName("tr");
            for (var i = 0; i < linhas.length; i++) {
                linhas[i].addEventListener("click", function() {
                    var data_solicitada = this.cells[0].innerText;
                    var objetivo = this.cells[1].innerText;
                    var facilitador = this.cells[2].innerText;
                    var tema = this.cells[3].innerText;
                    var local = this.cells[4].innerText;
                    var status = this.cells[5].innerText;
                    var rowData = {
                        data_solicitada: data_solicitada,
                        objetivo: objetivo,
                        facilitador: facilitador,
                        local: local,
                        tema: tema,
                        status: status
                    };
                    abrirModalDetalhes(rowData);
                });
            }
        };
    </script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/gravar.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>
</html>