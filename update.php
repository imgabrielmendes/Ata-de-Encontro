<?php
namespace formulario;

require __DIR__.'/vendor/autoload.php';
include 'conexao2.php';
include_once ("app/acoesform.php");

$id = $_GET['updateid'];
$puxarform= new AcoesForm;
$pegarfa=$puxarform->pegarfacilitador();
$pegarlocal=$puxarform->pegarlocais();

$sql="SELECT * FROM assunto where id=$id ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
// var_dump($row);

    $datasolicitada = $row['data_solicitada'];
    $tema = $row['tema'];
    $objetivo = $row['objetivo'];
    $local = $row['local'];
    $horainic = $row['hora_inicial'];
    $horaterm = $row['hora_termino'];

    $sql2 = "SELECT 
    fac.nome_facilitador as facilitadores,
    fac.id as idfacilitadores
    
    FROM ata_has_fac as ahf
    INNER JOIN facilitadores as fac
      ON fac.id = ahf.facilitadores
    where ahf.id_ata = $id";

    $result2 = mysqli_query($conn, $sql2);
    $facilitadores = array(); 

      while ($row2 = mysqli_fetch_assoc($result2)) { 
          $facilitadores[] = $row2;
      };

      $sql3 = "SELECT 
              del.id_ata,
              fac.nome_facilitador as deliberador,
              del.deliberacoes as deliberacoes
                FROM atareu.deliberacoes as del
                INNER JOIN atareu.facilitadores as fac
                    ON fac.id = del.deliberadores
                WHERE del.id_ata = $id";

                $result3 = mysqli_query($conn, $sql3);

                $deliberacoes_array = array();
                $deliberador_array = array();

                if ($result3 && mysqli_num_rows($result3) > 0) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                        $deliberacoes_array[] = $row3['deliberacoes'];
                        $deliberador_array[] = $row3['deliberador'];
                    }
                }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ATA</title>
    <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <script src="view\js\multi-select-tag.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="update.js"></script>

</head>
<body>
    <style>

      body{
        background-color: rgba(240, 240, 240, 0.41);
      }

    </style>
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
 <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8">
        <div class="row"> 
 
          <div class="col-md-12 text-center p-5">
            <h2>INFORMAÇÕES - ATA N°<?php echo $id ?></h2>
          </div>

          <!---ABA DE DATA---->
          <div class="col-3">
            <label><b>Data</b></label>
            <input id="datainicio" class="form-control bg-body-secondary" placeholder="dd-mm-aaaa" min="2024-04-01" type="date" value=<?php echo $datasolicitada?> readonly>
          </div>

          <!---ABA DE HORÁRIO INICIO---->
          <div class="col-3">
            <label for="nomeMedico"><b>Horário de Início:</b></label>
            <br>
            <input class="form-control bg-body-secondary" type="time" id="horainicio" name="appt" min="" max="18:00" value=<?php echo $horaterm?> readonly>
          </div>

          <!---ABA DE HORÁRIO TERMINO---->
          <div class="col-3">
            <label for="form-control"> <b> Horário de Término:</b> </label>
            <input class="form-control bg-body-secondary" type="time" id="horaterm" name="appt" min="13:00" max="12:00" value=<?php echo $horainic?> readonly>
          </div>

          <!---ABA DE TEMPO ESTIMADO ---->
          <div class="col-3">
            <label for="form-control"> <b> Tempo Estimado (horas):</b> </label>
            <input value="1" class="form-control bg-body-secondary" type="number" id="tempoestim" name="appt" min="0" max="5" readonly>
          </div>

           <!---ABA DE OBJETIVO - REUNIÃO---->
          <div class="col-2 mt-4 " id="objetivo">
            <label for="objetivo pb-2"> <b>Objetivo:</b> </label>

            <select class="form-control" name="objetivo" id="objetivo">
                <option value="Reunião" <?php if ($objetivo == 'Reunião') echo 'selected'; ?>>Reunião</option>
                <option value="Treinamento" <?php if ($objetivo == 'Treinamento') echo 'selected'; ?>>Treinamento</option>
                <option value="Consulta" <?php if ($objetivo == 'Consulta') echo 'selected'; ?>>Consulta</option>
                <?php if (empty($objetivo)) : ?>
                    <option selected disabled hidden>Objetivo não informado</option>
                <?php endif; ?>
            </select>
      </div>


          <!--- ABA DE SELECIONAR LOCAL ---->
          <div class="col-4 mt-4 pb-2">
          <label for="local"><b>Local:</b></label>
          <select class="form-control" name="local" id="local">
              <?php echo empty($pegarlocal) ? '<option selected disabled hidden>Local não informado</option>' : ''; ?>
              <?php foreach ($pegarlocal as $locais) : ?>
                  <option value="<?php echo $locais['locais']; ?>" <?php echo ($local == $locais['locais']) ? 'selected' : ''; ?>>
                      <?php echo $locais['locais']; ?>
                  </option>
              <?php endforeach; ?>
          </select>
      </div>


          <div class="col-6 mt-4 pb-2"><b>Tema:</b>
            <br>
            <input id="temaprincipal" class="form-control bg-body-secondary" type="text" value="<?php echo $tema?>" readonly/>
          </div>

          <!---ABA DE ADICIONAR FACILITADORES---->
    <div class="row">

          <div class="col-4 pt-2 pb-2"> 
            <label for="form-control"> <b> Facilitador(res) responsável*:</b> </label> </div>
          </div>
          
            <select class="col-6 form-control" id="selecionandofacilitador" name="facilitador" multiple value="">
            </div>
            
                <optgroup label="Selecione Facilitadores">
                    <?php foreach ($pegarfa as $facnull) : ?>
                        <option value="<?php echo $facnull['id']; ?>"
                            data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                            <?php echo $facnull['nome_facilitador']; ?>
                        </option>
                    <?php endforeach ?>
                </optgroup>
            </select>
    
              <div class="col-6 form-control mt-2">
                <ul>
                    <?php foreach ($facilitadores as $facilitador): ?>
                        <li><?php echo $facilitador['facilitadores']; ?></li>
                    <?php endforeach; ?>
                </ul>   
              </div>

          </div>

          <label class="h4 pt-3"><b>DELIBERAÇÕES</b></label>
          <?php foreach ($deliberacoes_array as $index => $deliberacao) : ?>
          <div class="row pt-3">
              <div class="col-4">
                  <input class="form-control" value="<?php echo $deliberador_array[$index]?>" >
              </div> 
              <input class="col form-control" value="<?php echo $deliberacao ?>" >
          </div>
          <?php endforeach; ?>

          <!--BOTÕES-->
          <div class="row">
            <div class="col p-4"><br>
              <div class="btn-atas">
                <button id="btnAtualizar" class="btn btn-primary">Atualizar</button>
          </div>
              <div class="row">
                <footer class="col main-footer p-4" style="margin-left: 0 !important; margin-top: 1em;">
                  <strong>Copyright © 2021 <a href="http://www.hospitalriogrande.com.br/" target="_blank">Hospital Rio Grande</a></strong>. Todos os direitos reservados.
                  <div class="float-right d-none d-sm-inline-block">
                    <b>Versão</b> 0.0.1
                </footer>
</div>
              </div>

                <script>
                 new MultiSelectTag('selecionandofacilitador', {
                          rounded: true, 
                          shadow: false,     
                          placeholder: 'Search', 
                          tagColor: {
                              textColor: '#1C1C1C',
                              borderColor: '#4F4F4F',
                              bgColor: '#F0F0F0',
                          },
                          onChange: function(selected_ids, selected_names) {

                              facilitadoresSelecionados = selected_ids;
                              facilitadoresSelecionadosLabel = selected_names;

                              console.log(facilitadoresSelecionados);
                              console.log(facilitadoresSelecionadosLabel);
                          }
                });
                </script>

</body>
</html>

