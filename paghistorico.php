<?php

namespace formulario;

include("vendor/autoload.php");
include_once("app/acoesform.php");
include("conexao.php");

$puxarform = new AcoesForm;
$facilitadores = $puxarform->selecionarFacilitadores();
$pegarfa = $puxarform->pegarfacilitador();
$pegarid = $puxarform->puxarId();
var_dump($pegarid);

//Conexão com o banco de dados (substitua os valores pelos seus próprios)
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
$sql = "SELECT data_registro, facilitador, tema, objetivo, local, status FROM assunto ORDER BY `data_registro` DESC";
$result = $conn->query($sql);


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


                        <!---- PRIMEIRA LINHA DO REGISTRO ---->

                        <table id="myTable" class="table table-striped">
                            <thead class="text-center">
                                <tr class="col">
                                    <th>Solicitação</th>
                                    <th>objetivo</th>
                                    <th>facilitador</th>
                                    <th>tema</th>
                                    <th>local</th>
                                    <th>status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- Filtro de Registro -->
                                <div class="accordion" id="accordionPanelsStayOpenExample" class="text-center">
                                    <div class="accordion-item" class="text-center">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                Filtro de Registro
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" class="text-center">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input class="form-control" type="text" id="filtroInput" onkeyup="filtrarTabela()" placeholder="Filtrar registros...">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-4" style="text-align: left;">
                                                        <b>Objetivo</b>
                                                        <select class="form-control" id="objetivoSelect" onchange="filtrarRegistros()">
                                                            <option value="">Selecione o objetivo</option>
                                                            <option value="Reunião">Reunião</option>
                                                            <option value="Treinamento">Treinamento</option>
                                                            <option value="Consulta">Consulta</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4" style="text-align: left;">
                                                        <b>Solicitação</b>
                                                        <input class="form-control" type="date" id="solicitacaoInput" onchange="filtrarRegistros()">
                                                    </div>
                                                    <div class="col-4" style="text-align: left;">
                                                        <b>Status</b>
                                                        <select class="form-control" id="statusSelect" onchange="filtrarRegistros()">
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
                                <!-- jQuery -->
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <!-- Popper.js (Bootstrap 5 dependency) -->
                                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-0hSUFLnE+2JoAOqJV+6DJ0zVrLy5FN3+35DSBkc/cbsuKdHTGDVZ+3rOVjXkHlD2" crossorigin="anonymous"></script>
                                <!-- Bootstrap 5 JavaScript bundle (Bootstrap 5 dependency) -->
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fqjz4im2C1iNlkj5wXaUr2ASKuwVV7h6XpSHfu6I8ELW8JwU5vZfK8ZbZSFfnEMH" crossorigin="anonymous"></script>

                            </tbody>

                            <?php
                            // Conexão com o banco de dados (substitua os valores pelos seus próprios)
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "atareu";

                            // Cria a conexão
                            $conn = new \mysqli($servername, $username, $password, $dbname);

                            // Checa a conexão
                            if ($conn->connect_error) {
                                die("Falha na conexão: " . $conn->connect_error);
                            }

                            // Consulta SQL para selecionar os dados
                            $sql = "SELECT data_solicitada, facilitador, tema, objetivo, local, status FROM assunto ORDER BY data_registro DESC";

                            $result = $conn->query($sql);
                            ?>

                            <tbody class="text-center">
                                <?php
                                // Exibe os dados em cada linha da tabela
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . substr($row["data_solicitada"], 8, 2) . "/" . substr($row["data_solicitada"], 5, 2) . "/" . substr($row["data_solicitada"], 0, 4) . "</td>";
                                        echo "<td>" . $row["objetivo"] . "</td>";
                                        echo "<td>" . $row["facilitador"] . "</td>";
                                        echo "<td>" . $row["tema"] . "</td>";
                                        echo "<td>" . $row["local"] . "</td>";
                                        echo "<td class='status_button'>";

                                        if ($row['status'] === 'ABERTA') {
                                            echo "<span class='badge bg-primary'>ABERTA</span>";
                                        } elseif ($row['status'] === 'FECHADA') {
                                            echo "<span class='badge bg-success'>FECHADA</span>";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>Nenhum resultado encontrado.</td></tr>";
                                }
                                $conn->close();
                                ?>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <!-----------------------------2° FASE-------------------------------->

        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" style="position: absolute; top: 10px; right: 20px;" onclick="fecharModal()">&times;</span>
                <div id="modalContent" class="accordion">
                    <br>
                    <div>
                        <h2>
                            <h5 class="text-center">Informações de Registro da Ata</h5>
                            <i class="fas fa-plus"></i>
                            <br>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                            <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
                                <div class="col-md-12 text-center">
                                    <div class="row">
                                        <!---- PRIMEIRA LINHA DO REGISTRO ---->
                                        <br>
                                        <div class="col-3">
                                            <label><b>Solicitação:</b></label>
                                            <ul class="form-control bg-body-secondary" id="modal_solicitacao"></ul>
                                        </div>
                                        <div class="col-3">
                                            <label><b>Objetivo:</b></label>
                                            <ul class="form-control bg-body-secondary border rounded" id="modal_objetivo"></ul>
                                        </div>
                                        <div class="col-3">
                                            <label><b>Facilitador:</b></label>
                                            <ul class="form-control bg-body-secondary" id="modal_facilitador"></ul>
                                        </div>
                                        <div class="col-3">
                                            <label><b>Local:</b></label>
                                            <ul class="form-control bg-body-secondary border rounded" id="modal_local"></ul>
                                        </div>
                                        <div class="col">
                                            <b>Tema:</b>
                                            <div class="col-12">
                                                <ul class="form-control bg-body-secondary" id="modal_tema"><?php echo $conteudo; ?></ul>
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
            // Função para abrir o modal com os detalhes da linha clicada
            function abrirModalDetalhes(row) {
                // Preencher os campos da modal com os dados da linha clicada
                document.getElementById("modal_solicitacao").innerText = row.data_solicitada;
                document.getElementById("modal_objetivo").innerText = row.objetivo;
                document.getElementById("modal_facilitador").innerText = row.facilitador;
                document.getElementById("modal_local").innerText = row.local;
                document.getElementById("modal_tema").innerText = row.tema;
                // Exibir o modal
                var modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            // Função para fechar o modal
            function fecharModal() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
            }
        </script>

        <script>
            // Função para filtrar a tabela com base no input de filtro
            function filtrarTabela() {
                var input, filtro, tabela, linhas, celula, texto;

                // Obter o valor digitado no campo de entrada
                input = document.getElementById("filtroInput");
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


            // Função para filtrar registros com base nos critérios selecionados
            function filtrarRegistros() {
                var tabela, linhas, i;
                tabela = document.getElementById("myTable");
                linhas = tabela.getElementsByTagName("tr");

                // Obter os valores selecionados nos selects
                var selectedObjective = document.getElementById("objetivoSelect").value.toUpperCase();
                var selectedSolicitacao = document.getElementById("solicitacaoInput").value.toUpperCase();
                var selectedStatus = document.getElementById("statusSelect").value.toUpperCase();

                // Iterar sobre todas as linhas da tabela e verificar se atendem aos critérios de filtro
                for (i = 1; i < linhas.length; i++) {
                    var atendeFiltro = true; // Define se a linha atende aos critérios de filtro
                    var celulas = linhas[i].getElementsByTagName("td");

                    // Filtrar por Objetivo
                    if (selectedObjective && celulas[1].innerText.toUpperCase() !== selectedObjective) {
                        atendeFiltro = false;
                    }
                    // Filtrar por Solicitação
                    if (selectedSolicitacao && celulas[0].innerText.substring(0, 10) !== selectedSolicitacao) {
                        atendeFiltro = false;
                    }
                    // Filtrar por Status
                    if (selectedStatus && celulas[5].innerText.toUpperCase() !== selectedStatus) {
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
                        var local = this.cells[3].innerText;
                        var tema = this.cells[4].innerText;

                        // Criar um objeto com os dados da linha clicada
                        var rowData = {
                            data_solicitada: data_solicitada,
                            objetivo: objetivo,
                            facilitador: facilitador,
                            local: local,
                            tema: tema
                        };

                        // Chamar a função para abrir o modal e passar os dados da linha clicada como argumento
                        abrirModalDetalhes(rowData);
                    });
                }
            };
        </script>

        <script src="view/js/bootstrap.js"></script>

    </div>
    </div>
</body>

</html>