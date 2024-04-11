<?php

namespace formulario;

// include ("vendor/autoload.php");
include_once ("app/acoesform.php");
include ("conexao.php");

//Testar conexao com banco de dados
$puxarform= new AcoesForm;
$facilitadores=$puxarform->selecionarFacilitadores();

$testandodeli=$puxarform->selecionarDeliberadores();
// echo $testandodeli;

//funções de encotrar pessoas
$pegarfa=$puxarform->ultimosParticipantes();
$pegarde=$puxarform->pegarfacilitador();
$participantesArray = $pegarfa;
// ARRUMAR UM JEITO DE DIMINUIR ISSO

$pegarrespons = $puxarform->ultimosResponsaveis();

try {

$dbhost = 'localhost';
$dbname = 'atareu';
$dbuser = 'root';
$dbpass = '';


  $pdo = new \PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
  $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT facilitador, tema, hora_inicial, hora_termino, data_solicitada, objetivo, local 
          FROM assunto 
          ORDER BY data_registro DESC 
          LIMIT 1";

  // Preparar e executar a consulta
  $stmt = $pdo->prepare($sql);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {

      $row = $stmt->fetch(\PDO::FETCH_ASSOC);
      $facilitadores = $row["facilitador"];
      $facilitadoresArray = json_decode($facilitadores, true);   
      $facilitadoresString = implode(", ", $facilitadoresArray);
      $conteudo = $row["tema"];
      $horainicio = substr($row["hora_inicial"], 0,5);
      $horaterm = substr($row["hora_termino"], 0,5);
      $data = substr($row["data_solicitada"], 0,10);
      $objetivoSelecionado = $row["objetivo"];
      $local = $row["local"];

  } else {
      echo "Nenhum resultado encontrado";
  }

  // Fechar a conexão
  $pdo = null;

} catch (\PDOException $e) {
  echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
}

echo "Facilitadores - $facilitadoresString, 
      Conteúdo - $conteudo, 
      Horário de Início - $horainicio, 
      Horário de Término - $horaterm, 
      Data - $data, 
      Objetivos - $objetivoSelecionado, 
      Local - $local";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ata de encontro - HRG</title>
  <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

  <script src="view/js/popper.min.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="view/css/styles.css">
  <link rel="stylesheet" href="view/css/bootstrap.min.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="view/css/bootstrap.css">
  <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar shadow">
      <div id="container" style="background-color: #001f3f;">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
          <h1 id="tittle" class="text-center">Atribuição</h1>
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
            <h5>Informações de Registro</h5>
            <i class="fas fa-plus"></i>
          </button>
        </h2>

    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
          <div class="col-md-12 text-center">         
          </div>    
          
          

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


          <!---- PRIMEIRA LINHA DO REGISTRO ---->
          <div class="row">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Remover aspas duplas e colchetes do facilitador
        $facilitador = str_replace(array('[', ']', '"'), '', $row["facilitador"]);
?>
    <br>
    <div class="col-4">
        <label><b>Solicitação</b></label>
        <ul class="form-control bg-body-secondary"><?php echo date("d/m/Y", strtotime($row["data_solicitada"])); ?></ul>
    </div>
    <div class="col-4">
        <label for="nomeMedico"><b>Objetivo:</b></label>
        <br>
        <ul class="form-control bg-body-secondary"><?php echo $row["objetivo"]; ?></ul>
    </div>
    <div class="col-4">
        <label for="form-control"> <b>Facilitador</b> </label>
        <ul class="form-control bg-body-secondary"><?php echo $facilitador; ?></ul>
    </div>
    <div class="col-4">
        <label for="form-control"> <b>Local</b> </label>
        <ul class="form-control bg-body-secondary"><?php echo $row["local"]; ?></ul>
    </div>
    <div class="col-4">
        <label for="form-control"><b>Tema</b></label>
        <ul class="form-control bg-body-secondary"><?php echo $row["tema"]; ?></ul>
    </div>
    <div class="col-4">
        <label for="form-control"> <b>Status</b> </label>
        <ul class="form-control bg-body-secondary">
            <?php echo ($row['status'] === 'ABERTA' ? "<span class='badge bg-primary'>ABERTA</span>" : "<span class='badge bg-success'>FECHADA</span>"); ?>
        </ul>
    </div>
    <div class="col-12">
        <label for="form-control"><b>Participantes</b></label>
        <div class="form-control bg-body-secondary">
        </div>
    </div>
<?php
    }
} else {
    echo "<div class='col-12'><p class='text-center'>Nenhum resultado encontrado.</p></div>";
}
$conn->close();
?>
</div>


<!------------ACCORDION COM INFORMAÇÕES DE PARTICIPANTES---------------->
<div class="accordion" id="accordionPanelsStayOpenExample">

<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #1c8f69;">

    <i class="fas"></i>
    <h5>Participantes Adicionados </h5>

    </button>
  </h2>

<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
<div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
    <div class="col-md-12 text-center">         
          
    </div>     

    <!---- PRIMEIRA LINHA DO REGISTRO ---->
    <div class="row">
    <div class="col">
        <div>
            <?php 
            // Decodifica a string JSON para um array
            $participantesArray = json_decode($pegarfa[0]['participantes']);

            foreach ($participantesArray as $participanteNome) {

                $participanteNome = trim($participanteNome, '" ');
            ?>
                <div style = "margin: 6px" class='form-control bg-body-secondary border rounded'>
                    <li><b><?php echo $participanteNome; ?></b></li>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>





</div>
</div>
</div>
</div>
  </div>

<!-----------------------------ACCORDION COM PARTICIPANTES-------------------------------->
<br>
<div class="accordion">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #66bb6a;">
      <h5>Deliberações</h5>
</div>
  </h2>

<!-----------------------------4° FASE-------------------------------->

<div class="accordion-collapse collapse show">
<div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
    <div class="col-md-12 text-center">               
    </div>     
    <span class="col-4" id="inputContainer"></span>
        <form id="addForm">
          
        <div class="form-group">
        <div class="col">
          
              <br>
              <label style="height: 35px;"><b>Informe o texto principal:</b></label>
              <textarea id="deliberacoes" class="form-control item" placeholder="Informe aqui..." style="height: 110px;"></textarea>
            </div>

            <div class="col">
    <!-- Primeira caixa de texto e select de facilitadores -->
    <div class="mb-2">
        <select id="deliberador" class="form-control facilitator-select" placeholder="Deliberações" multiple>
        <optgroup label="Selecione Facilitadores">
                  <?php foreach ($pegarde as $facnull) : ?>
                      <option value="<?php echo $facnull['nome_facilitador']; ?>"
                          data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                          <?php echo $facnull['nome_facilitador']; ?>
                      </option>
                  <?php endforeach ?>
              </optgroup>
        </select>
</div>

        </div>
        <div class="row">
          <div class="col-10"></div>
          <div class="col-2 d-flex justify-content-end">
              <div class="d-flex flex-column align-items-end">
                  <ul id="caixadeselecaodel"></ul>
                  <button type="button" id="addItemButton" class="btn btn-success mt-2">+</button>
              </div>
    </div>
</div>


    </div>
    
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="view/img/check.svg" class="rounded me-2" alt="..." style="width: 20px";>
          <strong class="me-auto">Perfeito!</strong>
          <small>Agora</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          A deliberação foi atribuída.
        </div>
      </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <img src="view\img\x.svg" class="rounded me-2" alt="..." style="width: 15px";>
          <strong class="me-auto">Perfeito!</strong>
          <small>Agora</small>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          Atribuição excluída.
        </div>
      </div>
    </div>

        <br>
        <!-- <button id="abrirhist" type="button" class="btn btn-primary" data-bs-toggle="modal"> Atualizar a ata </button> -->
        <div class="d-flex justify-content-center">
            <button id="abrirhist" type="button" class="btn btn-primary" data-bs-toggle="modal">Atualizar a ata</button>
        </div>

    </form>
          
            </div>          
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var botaocont = document.getElementById('botaocontinuarata');
        var botaoregistrar = document.getElementById('botaoregistrar');
        var itemList = document.getElementById('items');
        var filter = document.getElementById('filter');
        var addItemButton = document.getElementById('addItemButton'); 

    });

</script>
  </div>
    </div>
      </div>
         </div>
         
</main>

</div>
       
    <script src="view\js\multi-select-tag.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/deliberacoes.js"></script>

</body>

</html>