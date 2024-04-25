<?php
namespace formulario;

include 'conexao2.php';
include_once ("app/acoesform.php");

$id = $_GET['updateid'];
$puxarform= new AcoesForm;
// $facilitadores=$puxarform->selecionarFacilitadores();
$pegarfa=$puxarform->pegarfacilitador();
$pegarlocal=$puxarform->pegarlocais();

$sql="SELECT * FROM assunto where id=$id ";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
// var_dump($row);

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

    $result2 = mysqli_query($conn, $sql2);
    $facilitadores = array(); 

      while ($row2 = mysqli_fetch_assoc($result2)) { 
          $facilitadores[] = $row2;
      }

      print_r($sql2);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ATA</title>
    <link rel="icon" href="view/img/Logobordab.png" type="image/x-icon">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="view/css/styles.css">
    
    <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

    <script src="view\js\multi-select-tag.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="update.js"></script>

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-border-hrg shadow">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/">
                <img src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png" alt="Central de Serviço" style="width: 160px">
            </a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarCentral" aria-controls="navBarCentral" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navBarCentral">
                <!-- Adicione aqui os elementos do menu se necessário -->
            </div>
        </div>
    </nav>
</header>
 <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8">
        <div class="row"> 
 
          <div class="col-md-12 text-center">
            <h2>Formulário de Solicitação </h2>
          </div>

          <!---ABA DE DATA---->
          <div class="col-3">
            <label><b>Data*</b></label>
            <input id="datainicio" class="form-control" placeholder="dd-mm-aaaa" min="2024-04-01" type="date" value=<?php echo $datasolicitada?>>
          </div>

          <!---ABA DE HORÁRIO INICIO---->
          <div class="col-3">
            <label for="nomeMedico"><b>Horário de Início*:</b></label>
            <br>
            <input class="form-control" type="time" id="horainicio" name="appt" min="" max="18:00" value=<?php echo $horaterm?>>
          </div>

          <!---ABA DE HORÁRIO TERMINO---->
          <div class="col-3">
            <label for="form-control"> <b> Horário de Término:</b> </label>
            <input class="form-control" type="time" id="horaterm" name="appt" min="13:00" max="12:00" value=<?php echo $horainic?>>
          </div>

          <!---ABA DE TEMPO ESTIMADO ---->
          <div class="col-3">
            <label for="form-control"> <b> Tempo Estimado (horas):</b> </label>
            <input value="1" class="form-control" type="number" id="tempoestim" name="appt" min="0" max="5">
          </div>

           <!---ABA DE OBJETIVO - REUNIÃO---->
          <div class="col-2  mt-4" id="objetivo">
          <label for="objetivo"> <b>Objetivo:</b> </label>
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
          <div class="col-3 mt-4">
          <label for="local"><b>Informe o Local</b></label>
          <select class="form-control" name="local" id="local">
              <?php echo empty($pegarlocal) ? '<option selected disabled hidden>Local não informado</option>' : ''; ?>
              <?php foreach ($pegarlocal as $locais) : ?>
                  <option value="<?php echo $locais['locais']; ?>" <?php echo ($password == $locais['locais']) ? 'selected' : ''; ?>>
                      <?php echo $locais['locais']; ?>
                  </option>
              <?php endforeach; ?>
          </select>
      </div>


          <div class="col-7 mt-4"><b>Tema*:</b>
            <br>
            <input id="temaprincipal" class="form-control" type="text" value="<?php echo $tema?>"/>
          </div>

          <!---ABA DE ADICIONAR FACILITADORES---->
          <div class="col-4 mt-5"> <label for="form-control"> <b> Facilitador(res) responsável*:</b> </label> </div>
          <div class="col-8 mt-5">
          <select class="form-control" id="selecionandofacilitador" name="facilitador" multiple value="<?php echo $password; ?>">
              <optgroup label="Selecione Facilitadores">
                  <?php foreach ($pegarfa as $facnull) : ?>
                      <option value="<?php echo $facnull['id']; ?>"
                          data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                          <?php echo $facnull['nome_facilitador']; ?>
                      </option>
                  <?php endforeach ?>
              </optgroup>
          </select>
  
          <div class="col-8 form-control">
          <ul>
              <?php foreach ($facilitadores as $facilitador): ?>
                  <li><?php echo $facilitador['facilitadores']; ?></li>
              <?php endforeach; ?>
          </ul>
          </div>
          
          <!--BOTÕES-->
          <div class="row">

            <div class="col"><br>
              <div class="btn-atas">
              <button id="btnAtualizar" class="btn btn-primary">Atualizar</button>
              <button id="botaoregistrar" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modaldeemail">Cadastre-se</button>
              <button type="submit" class="btn btn-primary" name="submit">Enviar</button>

            </div>  
              <div class="modal fade" id="modaldeemail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="col modal-title fs-5" id="staticBackdropLabel">Registro de usuário</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                              <form>
                                <div class="mb-3">

                                  <label class="col-form-label">Nome completo:</label>
                                  <input type="text" class="form-control" id="caixanome">
                                </div>

                                <div class="mb-3">
                                  <label class="col-form-label">Informe o Email</label>
                                  <input type="email" class="form-control" id="caixadeemail">
                                </div>

                                <div class="row">
                                <label class="col-4 form-label">Matricula: </label>
                                <label id="labelcargo" class="col-8 form-label">Cargo: </label>
                                <div class="col-4">
                                <input type="text" maxlength="4" class="form-control" id="caixamatricula">
                                </div>  

                                <div class="col-8">
                                <input type="text" class="col-5 form-control" id="caixacargo">
                              </div></div>
                              </form>

                            </div>

                            <div class="modal-footer">
                              <button id="registraremail" type="button" class="btn btn-primary">Registrar</button>
                            </div>
                          </div>
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

