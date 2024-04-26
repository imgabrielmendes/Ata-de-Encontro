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

    <!--BARRA DE NAVEGAÇÃO-->
    <header>
        <nav class="navbar shadow">
            <div id="container" style="background-color: #001f3f;">
                <div class="container_align">
                    <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
                        <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
                    <h1 id="tittle" class="text-center">Histórico</h1>
                </div>
            </div>
        </nav>
    </header>


    <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
    <div class="box box-primary">
        <main class="container d-flex justify-content-center align-items-center" class="text-center">
            <div class="form-group col-12">
                <div class="row">
                    <div class="text-center" class="row">
                        <table id="myTable" class="table table-striped">
                            <tbody>
                                <div class="accordion" id="accordionPanelsStayOpenExample" class="text-center">
                                    <div class="accordion-item text-center">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button shadow-sm text-white text-center" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #1c8f69 ">
                                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                <i class="fa-solid fa-circle-info"></i>
                                                <h5>Histórico de Atas</h5>
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
<tbody class="text-center">
    <?php
    $results = $puxarform->pegandoTudo();
    if ($results) {
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["data_solicitada_formatada"] . "</td>";
            echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["objetivo"] . "</td>";
            echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>";
            $facilitadores = explode(",", $row["facilitador"]);
            $facilitadoresFormatted = implode(", ", $facilitadores);
            echo $facilitadoresFormatted;
            echo "</td>";
            echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["tema"] . "</td>";
            echo "<td class='align-middle' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . $row["local"] . "</td>";
            echo "</td>";
            echo "<td class='align-middle status-cell' onclick='abrirModalDetalhes(" . json_encode($row) . ")'>" . ($row['status'] === 'ABERTA' ? "<span class='badge bg-primary'>ABERTA</span>" : "<span class='badge bg-success'>FECHADA</span>") . "</td>";
            echo "<td class='text-center align-middle'><a href='pagatribuida.php'><button type='button' class='btn btn-warning' style='color: white;'>+</button></a></td>";
            echo "<td class='align-middle' style='display:none;'  onclick='abrirModalDetalhes(" . json_encode($row) . ")'>";
            echo "<td class='align-middle' style='display:none;' id='participantes" . $row['id'] . "'>"; 

            if (isset($row['id'])) {
                $id_ata = $row['id'];
                $puxaparticipantes = $puxarform->buscarParticipantesPorIdAta($id_ata);
                if (!empty($puxaparticipantes) && is_array($puxaparticipantes)) {
                    foreach ($puxaparticipantes as $participante) {
                        echo $participante . ", <br>";
                    }
                } else {
                    echo "Nenhum participante";
                }
            } else {
                echo "ID da ata não disponível";
            }

            echo "</>";

            
        }
    } else {
        echo "<tr><td colspan='7' class='align-middle'>Nenhum resultado encontrado.</td></tr>";
    }
    ?>
</tbody>









</table>



                    </div>
                </div>
</div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informações de Registro da Ata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="accordion">
                    <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
                        <div class="col-md text-center">
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
                               
                                <!-- Nova div para deliberações -->
                                <div class="col-12">
                                    <label for="form-control"><b>Participantes</b></label>
                                    <ul class="form-control bg-body-secondary  border rounded" id="modal_participantes"></ul>
                                
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
    </div>


<script>
   

    function abrirModalDetalhes(row) {
        document.getElementById("modal_solicitacao").innerText = row.data_solicitada;
        document.getElementById("modal_objetivo").innerText = row.objetivo;
        document.getElementById("modal_facilitador").innerText = row.facilitador;
        document.getElementById("modal_local").innerText = row.local;
        document.getElementById("modal_tema").innerText = row.tema;
        document.getElementById("modal_status").innerText = row.status;
        // Dentro da função abrirModalDetalhes(row)// Obtém os participantes da ata clicada usando o ID da linha
    var participantes = document.getElementById("participantes" + row.id).innerText;
    // Exibe os participantes no modal
    document.getElementById("modal_participantes").innerText = participantes;



        var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
            backdrop: 'static', // Impede o fechamento clicando fora do modal
            keyboard: false // Impede o fechamento pressionando a tecla Esc
        });
        myModal.show();
    }
 
</script>



    <script>


        // Função para filtrar a tabela com base no input de filtro
        function filtrarTabela() {
            var input, filtro, tabela, linhas, celula, texto;

            // Obter o valor digitado no campo de entrada
            input = document.getElementById("temaprincipal");
            filtro = input.value.toUpperCase();

            // Obter a tabela e suas linhas
            tabela = document.getElementById("myTable");
            linhas = tabela.getElementsByTagName("tr");

            // Iterar sobre todas as linhas da tabela
            for (var i = 0; i < linhas.length; i++) {
                var encontrou = false; // Flag para indicar se o filtro foi encontrado em alguma célula da linha

                celula = linhas[i].getElementsByTagName("td");

                // Iterar sobre todas as células da linha atual
                for (var j = 0; j < celula.length; j++) {
                    if (celula[j]) {
                        // Converta o texto da célula para maiúsculas
                        texto = celula[j].innerText.toUpperCase() || celula[j].textContent.toUpperCase();

                        // Se o texto da célula contiver o filtro, defina a flag como verdadeira
                        if (texto.indexOf(filtro) > -1) {
                            encontrou = true;
                            break; // Não é necessário continuar verificando outras células se o filtro foi encontrado
                        }
                    }
                }

                // Exibir ou ocultar a linha com base na flag encontrou
                if (encontrou) {
                    linhas[i].style.display = "";
                } else {
                    linhas[i].style.display = "none";
                }
            }
        }


        /// Função para filtrar registros com base nos critérios selecionados
        function filtrarRegistros(event) {
    var tabela, linhas, i;
    tabela = document.getElementById("myTable");
    linhas = tabela.getElementsByTagName("tr");

    // Obter os valores selecionados nos selects
    var selectedObjective = document.getElementById("objetivoSelect").value.toUpperCase();
    var selectedSolicitacao = document.getElementById("solicitacaoInput").value; // Removemos a conversão para maiúsculas
    var selectedStatus = document.getElementById("statusSelect").value.toUpperCase();

    console.log("Valor de selectedSolicitacao:", selectedSolicitacao);

    // Iterar sobre todas as linhas da tabela e verificar se atendem aos critérios de filtro
    for (var i = 0; i < linhas.length; i++) {
        var atendeFiltro = true; // Define se a linha atende aos critérios de filtro
        var celulas = linhas[i].getElementsByTagName("td");

        console.log("Valor da célula de data:", celulas[0].innerText.toUpperCase());

        // Filtrar por Objetivo
        if (selectedObjective && celulas[1].innerText.toUpperCase() !== selectedObjective) {
            atendeFiltro = false;
        }
        // Filtrar por Solicitação
        if (selectedSolicitacao) {
            // Obter a data da célula no formato "dd/mm/yyyy"
            var dataCelula = celulas[0].innerText.trim();
            // Converter a data da célula para o formato "dd/mm/yyyy"
            var partesDataCelula = dataCelula.split("/");
            var dataFormatadaCelula = partesDataCelula[0] + "/" + partesDataCelula[1] + "/" + partesDataCelula[2];
            // Verificar se a data da célula corresponde à data selecionada
            if (dataFormatadaCelula !== selectedSolicitacao) {
                atendeFiltro = false;
            }
        }
        // Filtrar por Status
        if (selectedStatus && celulas[6].innerText.toUpperCase() !== selectedStatus) {
            atendeFiltro = false;
        }

        // Se a linha atender aos critérios de filtro, exibi-la; caso contrário, ocultá-la
        if (atendeFiltro) {
            linhas[i].style.display = "";
        } else {
            linhas[i].style.display = "none";
        }
    }
}





        // Adiciona um evento de clique a todas as células da tabela
        window.onload = function() {
            var table = document.getElementById("myTable");
            var linhas = table.getElementsByTagName("tr");
            for (var i = 0; i < linhas.length; i++) {
                linhas[i].addEventListener("click", function() {
                    // Obter os dados da linha clicada
                    var data_solicitada = this.cells[0].innerText;
                    var objetivo = this.cells[1].innerText;
                    var facilitador = this.cells[2].innerText;
                    var tema = this.cells[3].innerText;
                    var local = this.cells[4].innerText;
                    var status = this.cells[5].innerText;


                    // Criar um objeto com os dados da linha clicada
                    var rowData = {
                        data_solicitada: data_solicitada,
                        objetivo: objetivo,
                        facilitador: facilitador,
                        local: local,
                        tema: tema,
                        status: status
                    };

                    // Chamar a função para abrir o modal e passar os dados da linha clicada como argumento
                    abrirModalDetalhes(rowData);
                });
            }
        };
    </script>

    <script src="view/js/bootstrap.js"></script>
    <script src="app/gravar.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
      integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>

</html>