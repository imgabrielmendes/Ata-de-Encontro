<?php

//namespace formulario;

// include ("vendor/autoload.php");
// include_once ("app/acoesform.php");
// include ("conexao.php");

//PUXANDO OS VALORES QUE ESTÃO SENDO INSERIDOS NA PÁGINA PRINCIPAL ATRAVÉS DA CHAMADA AJAX NO "gravar.js

// $facilitadores = $_GET['facilitadores'];
// $conteudo = $_GET['conteudo'];
// $horainicio = $_GET['horainicio'];
// $horaterm = $_GET['horaterm'];
// $data = $_GET['data'];
// $objetivoSelecionado = $_GET['objetivoSelecionado'];
// $local = $_GET['local'];

// echo "Facilitadores - $facilitadores, 
//       Conteúdo - $conteudo, 
//       Horário de Início - $horainicio, 
//       Horário de Término - $horaterm, 
//       Data - $data, 
//       Objetivos - $objetivoSelecionado, 
//       Local - $local";

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

  <!--FORMULÁRIO-->

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8">
        <div class="row"> 
          
    <div class="accordion" id="accordionPanelsStayOpenExample">

      <div class="accordion-item shadow">
        <h2 class="accordion-header">
          <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #001f3f;">
            <h5>Histórico de atas</h5>
            <i class="fas fa-plus"></i>
          </button>
        </h2>

    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
          <div class="col-md-12 text-center">         
          <!----<ul>
              <strong>Facilitadores:</strong> <?php echo $facilitadores; ?>
              <br>
              <strong>Tema:</strong> <?php echo $conteudo; ?>
              <br>
              <strong>Horário de Início:</strong> <?php echo $horainicio; ?>
              <strong>Horário de Término:</strong> <?php echo $horaterm; ?>
              <strong>Data:</strong> <?php echo $data; ?>
              <br>
              <strong>Objetivos:</strong> <?php echo $objetivoSelecionado; ?>
              <strong>Local:</strong> <?php echo $local; ?>
              <h3>---------------------------------</h3>
          </ul> --->          
          </div>     

          <!---- PRIMEIRA LINHA DO REGISTRO ---->
          <div class="form-group col-8">
    <div class="row">
        <main class="col-12">

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
            $sql = "SELECT data_registro, facilitador, tema FROM assunto";
            $result = $conn->query($sql);

            ?>

            <table id="myTable">
                <thead>
                <tr>
                    <th>Data de solicitação</th>
                    <th>Facilitador</th>
                    <th>Tema</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Exibe os dados em cada linha da tabela
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["data_registro"] . "</td>";
                        echo "<td>" . $row["facilitador"] . "</td>";
                        echo "<td>" . $row["tema"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum resultado encontrado.</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>
            </table>
        </main>
    </div>
</div>
<!-----------------------------2° FASE-------------------------------->

</body>

</html>