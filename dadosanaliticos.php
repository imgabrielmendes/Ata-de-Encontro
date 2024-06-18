<?php
namespace formulario;

session_start();

include_once ("funcoesgraficos.php");
include ("conexao.php");

$chartsFunc = new ChartsFunc();
$data = $chartsFunc->pegandoTudo();

$atasabertas = $chartsFunc->pegarQuantidadeAberta();
$atasfechadas = $chartsFunc->pegarQuantidadeFechada();
$todasasatas = $atasabertas + $atasfechadas;

echo json_encode($todasasatas);
// echo("<br>");
// echo json_encode($atasfechadas);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ata de Encontro - Dados</title>
    <link rel="icon" href="view/img/Logobordab.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/bootstrap-grid.css">
    <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="view/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <style>
        .content-header {
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
                    <button class="btn">
                      <div class="btn nav-item">
                        <a class="nav-link" href="index.php">Criar ata</a>
                        </div>      
                    </button>
                    <button class="btn">
                      <div class="btn nav-item">
                        <a class="nav-link" href="paghistorico.php">Histórico</a>
                        </div>      
                    </button>
                    <button class="btn">
                      <div class="btn nav-item">
                        <a class="nav-link" href="dadosanaliticos.php">Estatísticas</a>
                        </div>      
                    </button>
      <div class="collapse navbar-collapse" id="navBarCentral">
      </div>
    </div>
  </nav>
  <div class="content-header shadow" style="border-bottom: solid 1px gray;">
      <div class="container-fluid">
        <div class="row py-1">
          <div class="col-sm-6">
            <h2 class="m-3 text-light"><i class="fas fa-users"></i><b> Dados Estatísticos </b></h2>
          </div>
        </div>
    </div>
</div>
</header>

<main class="container_fluid d-flex justify-content-center align-items-center">
    <div class="form-group col-10 mt-5">
        <div class="row mt-3 mb-3 border">
            <p class="col-md-12 text-center m-3 p-2 fs-1"><b>Informações</b></p>
        </div>

        <div class="col btn-group d-flex justify-content-center flex-wrap mt-2" role="group" aria-label="Basic example" id="monthButtons"></div>
        <div id="dataDisplay"></div>

        <script>
            function getMonthName(monthIndex) {
                const months = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
                return months[monthIndex];
            }

            const monthButtonsContainer = document.getElementById("monthButtons");

            for (let i = 0; i < 12; i++) {
                const monthName = getMonthName(i);
                const button = document.createElement("button");
                button.type = "button";
                button.classList.add("btn", "btn-primary");
                button.textContent = monthName;
                button.id = monthName;

                button.addEventListener("click", function () {
                    const monthClicked = this.id;
                    const currentURL = window.location.href;

                    if (currentURL.indexOf("?mes=") !== -1) {
                        const updatedURL = currentURL.replace(/(mes=)[^\&]+/, '$1' + monthClicked);
                        window.location.href = updatedURL;

                    } else {
                        const updatedURL = `${currentURL}?mes=${monthClicked}`;
                        window.location.href = updatedURL;
                    }
                });

                monthButtonsContainer.appendChild(button);
            }

            window.addEventListener('load', function() {
                const params = new URLSearchParams(window.location.search);
                const mes = params.get('mes');
                if (mes) {
                    fetch(`fetch_data.php?mes=${mes}`)
                        .then(response => response.json())
                        .then(data => {
                            const labels = data.map(item => item.label);
                            const values = data.map(item => item.value);

                            const ctx1 = document.getElementById('myChart').getContext('2d');
                            new Chart(ctx1, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Dataset 1',
                                        data: values,
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                            const ctx2 = document.getElementById('myChart2').getContext('2d');
                            new Chart(ctx2, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: '# of Votes',
                                        data: values,
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                            const ctx3 = document.getElementById('myChart3').getContext('2d');
                            new Chart(ctx3, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Dataset 3',
                                        data: values,
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        })
                        .catch(error => console.error('Error:', error));
                }
            });
        </script>

        <div class="row">
            <div class="col-4 shadow p-5 border">
                <p class="fs-5"> Treinamento/Consulta/Reunião </p>
                <hr>
                <canvas class="mt-2" id="myChart"></canvas>
            </div>
            
            <div class="col-8 shadow p-5 border g-col-6">
                <p class="fs-4">Locais</p>
                <hr>
                <canvas id="myChart2"></canvas>
            </div>
        </div>

        <div class="grid row mt-4">
            <div class="col-8 shadow p-5 border">
                <p class="fs-2">Atas/dia</p>
                <hr>
                <canvas id="myChart3"></canvas>
            </div>
            <div class="col-4 shadow p-5 border">
                <p class="fs-2">Atas feitas no mês</p>
                <hr>
                <?php
                for ($linha = 0; $linha < 4; $linha++) {
                    echo '<p class="border p-3 fs-7">Exemplo</p>';
                }
                ?>
                <canvas id="myChart4"></canvas>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-6 shadow p-5">
                <p class="fs-2">Atas ao longo do mês</p>
                <hr>
                <canvas id="myChart5"></canvas>
            </div>
            <div class="col-6 shadow p-5">
                <p class="fs-2">Atas ao longo do mês</p>
                <hr>
                <canvas id="myChart6"></canvas>
            </div>
        </div>
    </div>
</main>

<script src="graficos\graficos.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="view/js/bootstrap.js"></script>
</body>
</html>
