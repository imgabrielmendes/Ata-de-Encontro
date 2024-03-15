<?php
            // Conexão com o banco de dados (substitua os valores pelos seus próprios)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "atareu";

            // Cria a conexão
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Checa a conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // Consulta SQL para selecionar os dados
            $sql = "SELECT data_registro, facilitador, tema, objetivo, local, status FROM assunto ORDER BY `data_registro` desc";
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
  <script src="view/js/popper.min.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
    <nav class="navbar shadow ">
      <div id="container">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php"  style="background-color: #20315f;">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"  style="background-color: #20315f;"></a>
          <h1 id="tittle" class="text-center">Histórico</h1>
        </div>
      </div>
    </nav>
  </header>

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container d-flex justify-content-center align-items-center">
      <div class="form-group col-12">
        <div class="row"> 

          <!----LEGENDA DA TABELA------->
        <caption id="caption" style="caption-side: top;display: flex;padding-top: 0;font-size: 14px;"
    class="text-uppercase pb-0 mr-0">
    <div class="collapse show">
        <ul class="d-flex flex-wrap row text-right" style="list-style-type: none;justify-content: right;">
            <li class="col">
                <span class='badge bg-primary'>ABERTA</span>
                <label>Ata aberta</label>
            </li>
            <li class="col">
                <span class='badge bg-warning'>PROCESSO</span>
                <label>Ata em processo</label>
            </li>
            <li class="col">
                <span class='badge bg-success'>FECHADA</span>
                <label>Ata fechada</label>
            </li>
        </ul>
    </div>
</caption>
          <!---- PRIMEIRA LINHA DO REGISTRO ---->
          <div class="form-group col-10">
      <div class="row">
      <div class="container">
      <div class="col">
            <table id="myTable" class="table table-striped">
                <thead>
                <tr class="col">
                    <th>Data de solicitação</th>
                    <th>Objetivo</th>
                    <th>Facilitador(es) Responsável</th>
                    <th>Tema</th>
                    <th>Local</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Exibe os dados em cada linha da tabela
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                        echo "<tr>";
                          echo "<td>" . $row["data_registro"] . "</td>";
                          echo "<td>". $row["objetivo"]. "</td>";
                          echo "<td>" . $row["facilitador"] . "</td>";
                          echo "<td>" . $row["tema"] . "</td>";
                          echo "<td>" .$row["local"]. "</td>";
                          echo "<td>" . $row["status"]. "</td>";

                        echo "</tr>";

                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum resultado encontrado.</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
            </table>
</div>
</div>
        </main>
    </div>
</div>
<!-----------------------------2° FASE-------------------------------->

</body>

</html>