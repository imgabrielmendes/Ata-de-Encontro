<?php
namespace formulario;

session_start();

include_once ("funcoesgraficos.php");
include ("conexao.php");


$chartsFunc = new ChartsFunc();
$data = $chartsFunc->pegandoTudo();

$atasabertas = $chartsFunc->pegarQuantidadeAberta();
$ataaberta_json = json_encode($atasabertas);
$atasfechadas = $chartsFunc->pegarQuantidadeFechada();
$atafechada_json = json_encode($atasfechadas);

//quantidade por objetivos
$data2 = $chartsFunc->pegarObjetivo();
$objetivos = array_column($data2, 'objetivo');
$quantidades = array_column($data2, 'quantidade');
$objetivos_json = json_encode($objetivos);
$quantidades_json = json_encode($quantidades);

//quantidade por local
$data3 = $chartsFunc->pegarLocal();
$local = array_column($data3, 'local');
$quantidades2 = array_column($data3, 'quantidade');
$local_json = json_encode($local);
$quantidades2_json = json_encode($quantidades2);

// //quantidade de atas por dia
// $data4 = $chartsFunc->pegarPorDia();  
// $date = array_column($data4, 'data');
// $quantidade_ata = array_column($data4, 'quantidade_ata');
// $date_json = json_encode($date);
// $quantidadeata_json = json_encode($quantidade_ata);


//5 últimas atas 
$cincoultimos = $chartsFunc->pegar5();
$mes = array_column($cincoultimos, 'mes');
$idata = array_column($cincoultimos, 'id');
$datasolicitada = array_column($cincoultimos, 'data_solicitada');
$objetivo = array_column($cincoultimos, 'objetivo');


//atas por facilitadores
$faciliata = $chartsFunc->faciliAta();
$facilitador = array_column($faciliata, 'facilitador');
$numeroatas = array_column($faciliata, 'numero_de_atas');
$facilitador_json = json_encode($facilitador);
$numeros_json = json_encode($numeroatas);
print_r($facilitador_json);
print_r($numeros_json);



$todasasatas = $atasabertas + $atasfechadas;


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
                <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/"><img
                        src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png"
                        alt="Central de Serviço" style="width: 160px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarCentral"
                    aria-controls="navBarCentral" aria-expanded="false" aria-label="Toggle navigation">
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
                <p class="col-md-12 text-center m-3 p-2 fs-1"><b>Dados:</b></p>
            </div>

            <div class="col btn-group d-flex justify-content-center flex-wrap mt-2" role="group"
                aria-label="Basic example" id="monthButtons"></div>
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

                window.addEventListener('load', function () {
                    const params = new URLSearchParams(window.location.search);
                    const mes = params.get('mes');
                    if (mes) {
                        fetch(`fetch_data.php?mes=${mes}`)
                            .then(response => response.json())
                            .then(data => {
                                const labels = data.map(item => item.label);
                                const values = data.map(item => item.value);




                            });
                    }

                });
            </script>

            <div class="row mt-4">
                <div class="col-xl-3 col-md-12 col-lg-12 mb-4 mb-0">
                    <div class="card border-left-success shadow h-80 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Abertas
                                    </div>
                                    <div class="display-4 h4 mb-0 font-weight-bold text-gray-1000">
                                        <?php echo $ataaberta_json; ?></div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4 mb-0">
                    <div class="card border-left-warning shadow h-80 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Fechadas
                                    </div>
                                    <div class="display-4 h4 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $atafechada_json; ?></div>
                                </div>
                                <div class="col-auto">

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="row">
                    <div class="col-4 shadow p-5 border">
                        <p class="fs-5"> Treinamento/Consulta/Reunião </p>
                        <hr>
                        <canvas class="mt-2" id="myChart"></canvas>

                    </div>

                    <div class="col-8 shadow p-5 border g-col-6">
                        <p class="fs-4">Atas por facilitadores</p>
                        <hr>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>

                <div class="grid row mt-4">
                    <div class="col-8 shadow p-5 border">
                        <p class="fs-2">Atas/dia</p>
                        <div class="col-4" style="text-align: left;">
                            <input class="form-control" type="date" id="solicitacaoInput" onchange="filtrarRegistros()">
                        </div>
                        <hr>

                        <canvas id="myChart3"></canvas>
                    </div>

                    <div class="col-4 shadow p-5 border">
                        <p class="fs-2">Atas feitas no mês</p>
                        <hr>
                        <?php
                        // Iterar sobre os resultados para exibir as informações
                        foreach ($cincoultimos as $indice => $registro) {
                            $id = $registro['id'];
                            $data = date('d/m/Y', strtotime($registro['data_solicitada'])); // Formatando a data para dd/mm/aaaa
                            $objetivo = $registro['objetivo'];

                            // Exibindo cada registro dentro de uma caixa com borda
                            echo '<p class="border p-3 fs-7">';
                            echo "ID: $id<br>";
                            echo "Data: $data<br>";
                            echo "Objetivo: $objetivo";
                            echo '</p>';
                        }
                        ?>
                        <canvas id="myChart4"></canvas>
                    </div>

                </div>

                <div class="row mt-4">
                    <div class="col-6 shadow p-5">
                        <p class="fs-2">Locais</p>
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


    <script src="chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        //objetivos
        var objetivos = <?php echo $objetivos_json; ?>;
        var quantidades = <?php echo $quantidades_json; ?>;
        var colors = ['#FF5733', '#33FF57', '#33FFF3',];
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: objetivos,
                datasets: [{
                    label: 'Quantidade',
                    data: quantidades,
                    backgroundColor: colors,
                    borderWidth: 1
                }]
                
            },
            options: {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            },
            stacked: true
        }],
        xAxes: [{
            stacked: true
        }]
    }
}
        });


        //locais
        var local = <?php echo $local_json; ?>;
        var quantidades2 = <?php echo $quantidades2_json; ?>;
        var colors2 = ['#FF5733', '#33FF57', '#3357FF', '#F3FF33', '#FF33A1', '#33FFF3', '#7D33FF', '#FFB533', '#33FF92', '#F933FF'];
        const ctx2 = document.getElementById('myChart5').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: local,
                datasets: [{
                    label: 'Quantidade',
                    data: quantidades2,
                    backgroundColor: colors2,
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
     

 //atas por facilitadores
 var facilitadores = <?php echo $facilitador_json; ?>;
        var numeros = <?php echo $numeros_json; ?>;
        var colors3 = ['#FF5733', '#33FF57', '#3357FF', '#F3FF33', '#FF33A1', '#33FFF3', '#7D33FF', '#FFB533', '#33FF92', '#F933FF'];
        const ctx3 = document.getElementById('myChart2').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: facilitadores,
                datasets: [{
                    label: 'Quantidade',
                    data: numeros,
                    backgroundColor: colors2,
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
    </script>



    <script src="graficos\graficos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
</body>

</html>