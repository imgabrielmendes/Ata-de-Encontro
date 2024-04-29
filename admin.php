<?php
include "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>

        <link rel="stylesheet" href="view/css/styles.css">
        <link rel="stylesheet" href="view/css/bootstrap.min.css">
        <link rel="stylesheet" href="view/css/bootstrap-grid.css">
        <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
        <link rel="stylesheet" href="view/css/bootstrap.css">
        <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">
        
</head>

<body>

    <!-- <div class="row">
      <div class="col">
        <a class="btn btn-primary text-light" href="admin.php">Add</a>
      </div>
    </div> -->

<div class="container">

        <div class="col-md-12 text-center p-5">
            <h2>Histórico de atas registradas</h2>
          </div>

    <div class="row pt-4">
        <table class="table table-light">
            <thead class="table table-dark">
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
                                    <a class='text-light' href='impressao.php? updateid=".$id."'>Imprimir</a>
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
