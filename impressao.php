<?php
namespace formulario;
include_once ("app/acoesform.php");
include ("conexao.php");

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

        // $sql4="SELECT  
        // assunto.id as IDASSUNTO,
        // fac.nome_facilitador AS facilitadores_responsaveis,
        // fac_parti.nome_facilitador as nome_participantes,
        // fac_delib.nome_facilitador as deliberador,
        // delib.deliberacoes as deliberacoes,
        
        // text.texto_princ
        
        // FROM atareu.assunto as assunto
        //     INNER JOIN atareu.ata_has_fac as ahf
        //         ON ahf.id_ata = assunto.id
        //     INNER JOIN atareu.facilitadores as fac
        //         ON fac.id = ahf.facilitadores
        //         INNER JOIN atareu.participantes as parti
        //             ON parti.id_ata = assunto.id
        //         INNER JOIN atareu.facilitadores AS fac_parti 
        //             ON fac_parti.id = parti.participantes
        //             INNER JOIN atareu.deliberacoes as delib
        //                 ON delib.id_ata = assunto.id
        //             INNER JOIN atareu.facilitadores as fac_delib
        //                 ON fac_delib.id = delib.deliberadores
        //             INNER JOIN atareu.textoprinc as text
        //                 ON text.id_ata = assunto.id
        //                 where delib.id_ata = $id;";
        //                 $result4 = mysqli_query($conn, $sql4);
        //                 $row4=mysqli_fetch_assoc($result4);

                        // print_r($row4);
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="update.js"></script>

</head>
<body>

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
            <input id="datainicio" class="form-control" placeholder="dd-mm-aaaa" min="2024-04-01" type="date" value=<?php echo $datasolicitada?>>
          </div>

          <!---ABA DE HORÁRIO INICIO---->
          <div class="col-3">
            <label for="nomeMedico"><b>Horário de Início:</b></label>
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


          <div class="col-6 mt-4 pb-2"><b>Tema*:</b>
            <br>
            <input id="temaprincipal" class="form-control" type="text" value="<?php echo $tema?>"/>
          </div>

          <!---ABA DE ADICIONAR FACILITADORES---->

          <div class="col-4 pt-2 pb-2"> 
            <label for="form-control"> <b> Facilitador(res) responsável*:</b> </label> </div>
          </div>

          <div class="row">
          <div class="col-6 form-control mt-2">
                <ul>
                    <?php foreach ($facilitadores as $facilitador): ?>
                        <li><?php echo $facilitador['facilitadores']; ?></li>
                    <?php endforeach; ?>
                </ul>   
              </div>
        

            </select>
    


          </div>
          <label class="h4 pt-3"><b>PARTICIPANTES:</b></label>
          <?php foreach ($deliberacoes_array as $index => $deliberacao) : ?>
          <div class="row pt-3">
              <div class="col-4">
                  <input class="form-control" value="<?php echo $deliberador_array[$index]?>" >
              </div> 
              <input class="col form-control" value="<?php echo $deliberacao ?>" >
          </div>
          <?php endforeach; ?>

          <label class="h4 pt-3"><b>DELIBERAÇÕES:</b></label>
          <?php foreach ($deliberacoes_array as $index => $deliberacao) : ?>
          <div class="row pt-3">
              <div class="col-4">
                  <input class="form-control" value="<?php echo $deliberador_array[$index]?>" >
              </div> 
              <input class="col form-control" value="<?php echo $deliberacao ?>" >
          </div>
          <?php endforeach; ?>

              <div class="row">
                <footer class="col main-footer p-4" style="margin-left: 0 !important; margin-top: 1em;">
                  <strong>Copyright © 2021 <a href="http://www.hospitalriogrande.com.br/" target="_blank">Hospital Rio Grande</a></strong>. Todos os direitos reservados.
                  <div class="float-right d-none d-sm-inline-block">
                    <b>Versão</b> 0.0.1
                </footer>
</div>
              </div>


</body>
</html>

