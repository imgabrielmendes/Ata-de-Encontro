<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin atas - HRG</title>
    <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/bootstrap-grid.css">
    <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="view/css/bootstrap.css">
    <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">
</head>
<body style="background-color: #f4f6f9;">
    <style>
        .{
            background-color: #f4f6f9;
        }

        .content-header{
            background-color: #001f3f;
        }
    </style>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-border-hrg">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/">
                    <img src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png" alt="Central de Serviço" style="width: 160px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarCentral" aria-controls="navBarCentral" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navBarCentral"></div>
            </div>
        </nav>
        <div class="content-header" style="border-bottom: solid 1px gray;">
            <div class="container-fluid">
                <div class="row py-1">
                    <div class="col-sm-6">
                        <h2 class="m-3 text-light shadow"><i class="fas fa-users"></i> Histórico de atas de encontro</h2>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row-12 pt-5">
            <div class=" col-12 accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Filtros
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <form method="get">
                                <div class="mb-3 row">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="ID" name="id">
                                    </div>
                                    <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="DD/MM/AAAA" name="data_solicitada" pattern="\d{2}/\d{2}/\d{4}" maxlength="10" onkeypress="formatDate(event)">
                                    <script>
    function formatDate(event) {
        var input = event.target;
        var key = event.keyCode || event.charCode;

        if (key !== 8 && key !== 46) { // Se não for tecla de delete ou backspace
            if (input.value.length === 2 || input.value.length === 5) {
                input.value += '/';
            }
        }
    }
</script>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Tema" name="tema">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Objetivo" name="objetivo">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" placeholder="Status" name="status">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <br>
            </div>
            <table class="table rounded shadow">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Data Solicitada</th>
                        <th scope="col">Tema</th>
                        <th scope="col">Objetivo</th>
                        <th scope="col">Local</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "conexao.php";

                    $sql = "SELECT * FROM assunto WHERE 1=1";

                    if(isset($_GET['id']) && $_GET['id'] != '') {
                        $id = $_GET['id'];
                        $sql .= " AND id = '$id'";
                    }

                    if(isset($_GET['data_solicitada']) && $_GET['data_solicitada'] != '') {
                        // Aqui você pode fazer a conversão da data para o formato do banco de dados, se necessário
                        $data_solicitada = $_GET['data_solicitada'];
                        // Convertendo a data para o formato YYYY-MM-DD
                        $data_formatada = DateTime::createFromFormat('d/m/Y', $data_solicitada)->format('Y-m-d');
                        // Usando a função DATE() do MySQL para comparar apenas a parte da data sem considerar a hora
                        $sql .= " AND DATE(data_solicitada) = '$data_formatada'";
                    }
                    

                    if(isset($_GET['tema']) && $_GET['tema'] != '') {
                        $tema = $_GET['tema'];
                        $sql .= " AND tema = '$tema'";
                    }

                    if(isset($_GET['objetivo']) && $_GET['objetivo'] != '') {
                        $objetivo = $_GET['objetivo'];
                        $sql .= " AND objetivo = '$objetivo'";
                    }

                    if(isset($_GET['status']) && $_GET['status'] != '') {
                        $status = $_GET['status'];
                        $sql .= " AND status = '$status'";
                    }

                    $sql .= " ORDER BY id DESC";

                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {               
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            // Formatando a data_solicitada no formato "dia/mês/ano"
                            echo "<td>" . date('d/m/Y', strtotime($row['data_solicitada'])) . "</td>";
                           
                            echo "<td>" . $row['tema'] . "</td>";
                            echo "<td>" . $row['objetivo'] . "</td>";
                            echo "<td>" . $row['local'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "<td><button class='btn btn-primary'><a class='text-light' href='update.php?updateid=".$row['id']."'>Update</a></button></td>";
                            echo "<td><button class='btn btn-success'><a class='text-light' href='arquivopdf.php?updateid=".$row['id']."'>Imprimir</a></button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Nenhum registro encontrado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="view\js\multi-select-tag.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/gravar.js"></script>
</body>
</html>
