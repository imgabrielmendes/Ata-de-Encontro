<?php
namespace formulario;
include_once("app/acoesform.php");
include("conexao.php");
$puxarform = new AcoesForm;
$id = $_GET['updateid'];

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
$sql = "SELECT id, data_registro, tema, data_solicitada, objetivo, hora_inicial, hora_termino, tempo_estimado, local, status FROM assunto ORDER BY data_registro DESC";
$result = $conn->query($sql);




$facilitadores = $puxarform->selecionarFacilitadores();
$pegarfa = $puxarform->pegarfacilitador();
$puxaparticipantes = $puxarform->buscarParticipantesPorIdAta($id_ata = "?");
$resultados = $puxarform->pegandoTudo();
$pegarid = $puxarform->puxarId();

$sql="SELECT * FROM assunto where id=$id_ata ";

$row=mysqli_fetch_assoc($result);
    $datasolicitada = $row['data_solicitada'];
    $tema = $row['tema'];
    $objetivo = $row['objetivo'];
    $password = $row['local'];
    $horainic = $row['hora_inicial'];
    $horaterm = $row['hora_termino'];

    $sql2 = "SELECT 
    fac.nome_facilitador as facilitadores,
    fac.id as idfacilitadores
    
    FROM ata_has_fac as ahf
    INNER JOIN facilitadores as fac
      ON fac.id = ahf.facilitadores
    where ahf.id_ata = $id";

   
    $facilitadores = array(); 

      while ($row2 = mysqli_fetch_assoc($result)) { 
          $facilitadores[] = $row2;
      };

//funções de encotrar pessoas
// $pegarfa = $puxarform->puxandoUltimosFacilitadores();
$participantesArray = $pegarfa;
// $pegarrespons = $puxarform->ultimosResponsaveis();

$pegarde=$puxarform->pegarfacilitador();
// ARRUMAR UM JEIT;

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
          


          <!---- PRIMEIRA LINHA DO REGISTRO ---->

          <div class="row">
          <div class="col-6">
              <label for="form-control"><b>Data</b></label>
            <div class="form-control bg-body-secondary">
              <?php
                if (isset($_GET['updateid'])) {
                  $id_ata = $_GET['updateid'];
                  $atas = $puxarform->pegandoTudo();
                  $ata_encontrada = null;
                  foreach ($atas as $ata) {
                    if ($ata['id'] == $id_ata) {
                      $ata_encontrada = $ata;
                        break;
                    }
                  }
                if ($ata_encontrada) {
                  echo $ata_encontrada['data_solicitada_formatada'];
                } else {
                  echo "Nenhuma ATA encontrada com o ID fornecido.";
                }
                } else {
                  echo "Nenhum ID de ATA fornecido.";
                }
                ?>
              </div>
              </div>
              <div class="col-6">
                  <label for="form-control"><b>Objetivo</b></label>
                  <ul class="form-control bg-body-secondary"><?php echo $row['objetivo']; ?></ul>     
              </div>
          <div class="col-6">
            <label for="form-control"><b>Facilitadores</b></label>
            <div class="form-control bg-body-secondary">
                <?php
                if (isset($_GET['updateid'])) {
                    $id_ata = $_GET['updateid'];
                    $atas = $puxarform->pegandoTudo();
                    $ata_encontrada = null;
                    foreach ($atas as $ata) {
                        if ($ata['id'] == $id_ata) {
                            $ata_encontrada = $ata;
                            break;
                        }
                    }

                    if ($ata_encontrada) {
                        echo $ata_encontrada['facilitador'];
                    } else {
                        echo "Nenhuma ATA encontrada com o ID fornecido.";
                    }
                } else {
                    echo "Nenhum ID de ATA fornecido.";
                }
                ?>
            </div>
        </div>
        <div class="col-6">
            <label for="form-control"><b>Tema</b></label>
            <ul class="form-control bg-body-secondary"><?php echo $row["tema"]; ?></ul>
        </div>
        <div class="col-6">
            <label for="form-control"> <b>Local</b> </label>
            <ul class="form-control bg-body-secondary"><?php echo $row["local"]; ?></ul>
        </div>
        <div class="col-6">
            <label for="form-control"> <b>Status</b> </label>
            <ul class="form-control bg-body-secondary"><?php echo $row['status']; ?></ul>
        </div>
       
  </div>
      </div>
<!------------ACCORDION COM INFORMAÇÕES DE PARTICIPANTES---------------->
<br>
<form id="formSalvarInformacoes" method="post">
<input type="hidden" id="idAta" name="idAta" value="">
<div class="accordion">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #1c8f69;;">
    <i class="fa-solid fa-circle-info"></i>
    <h5>Participantes</h5>
</div>
  </h2>                                                                                                                                       
        <main class="container-fluid ">
        <div class="row">
          <br>
        <div class="col">
          <label for="form-control"><b>Adicione   participantes</b></label>
          <br>
          


        <form  id="addForm">
              <div class="col-12 form-group ">
                
                  
                

                
                    <div class="col" > 
                    <select class="col-8 form-control" id="participantesadicionados1" name="facilitador" multiple>
              <optgroup label="Selecione Facilitadores">
                  <?php foreach ($pegarfa as $facnull) : ?>
                      <option value="<?php echo $facnull['id']; ?>"
                          data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                          <?php echo $facnull['nome_facilitador']; ?>
                      </option>
                  <?php endforeach ?>
              </optgroup>
          </select>
                    
                    <?php 
                 

?>

        </div>
        </div> 
             
          </form>
           
        <?php
        if (isset($_GET['updateid'])) {
            $id_ata = $_GET['updateid'];
            $participantes = $puxarform->buscarParticipantesPorIdAta($id_ata);
            if (!empty($participantes)) {
                echo implode(', ', $participantes);
            } else {
                echo "Nenhum participante encontrado para esta ATA.";
            }
        } else {
            echo "Nenhum ID de ATA fornecido.";
        }
        ?> <br>     
        
        <?php      
        $conn->close();
        ?>
      </div>  
           
      
<br>
           
  
        </div>
      </main>
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
        <select id="deliberador" class="form-control facilitator-select" name="deliberacoes" placeholder="Deliberações" multiple>
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
        <div class="col">
        <button  id="atribuida"   class="btn btn-primary">Atualizar a ATA</button>
    
</div>

    </form>
          
            </div>          
</div>
</form>
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
    <script src="app\gravaratribuida.js"></script>
</body>

</html>