<?php
include "conexao.php";
?>

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
<<<<<<< HEAD

<body>
=======
>>>>>>> origin/Area-de-desenvolvimento

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
                <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/"><img src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png" alt="Central de Serviço" style="width: 160px">
                </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarCentral" aria-controls="navBarCentral" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
      

      <div class="collapse navbar-collapse" id="navBarCentral">
      </div>
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
    <div class="row pt-5">
        <table class="table rounded shadow">
            <thead class="table-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Data Solicitada</th>
                    <th scope="col">Tema</th>
                    <th scope="col">objetivo</th>
                    <th scope="col">local</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM assunto order by id desc";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {               
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['data_solicitada'];
                        $email = $row['tema'];
                        $password = $row['objetivo'];
                        $status = $row['status'];
                        $local = $row['local'];


                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . $name . "</td>";
                        echo "<td>" . $email . "</td>";
                        echo "<td>" . $password . "</td>";
                        echo "<td>" . $local . "</td>";
                        echo "<td>" . $status . "</td>";

                        echo "<td>
                                <button class='btn btn-primary'>
                                    <a class='text-light' href='update.php? updateid=".$id."'>Update</a>
                                </button>
                            </td>";
                       
                        
                        echo "<td>
                                <button class='btn btn-success'>
                                    <a class='text-light' href='arquivopdf.php? updateid=".$id."'>Imprimir</a>
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

      <script src="view\js\multi-select-tag.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <script src="view/js/bootstrap.js"></script>
      <script src="app/gravar.js"></script>
    
</body>
</html>