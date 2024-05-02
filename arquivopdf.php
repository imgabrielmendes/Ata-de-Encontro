<?php
namespace formulario;
include_once ("app/acoesform.php");
$id = $_GET['updateid'];


// include ("conexao.php");

// $id = $_GET['updateid'];
// $sql="SELECT  
//   assunto.id as IDASSUNTO,
//         fac.nome_facilitador AS facilitadores_responsaveis,
//         fac_parti.nome_facilitador as nome_participantes,
//         fac_delib.nome_facilitador as deliberador,
//         delib.deliberacoes as deliberacoes,
        
//         text.texto_princ
        
//         FROM atareu.assunto as assunto
//             INNER JOIN atareu.ata_has_fac as ahf
//                 ON ahf.id_ata = assunto.id
//             INNER JOIN atareu.facilitadores as fac
//                 ON fac.id = ahf.facilitadores
//                 INNER JOIN atareu.participantes as parti
//                     ON parti.id_ata = assunto.id
//                 INNER JOIN atareu.facilitadores AS fac_parti 
//                     ON fac_parti.id = parti.participantes
//                     INNER JOIN atareu.deliberacoes as delib
//                         ON delib.id_ata = assunto.id
//                     INNER JOIN atareu.facilitadores as fac_delib
//                         ON fac_delib.id = delib.deliberadores
//                     INNER JOIN atareu.textoprinc as text
//                         ON text.id_ata = assunto.id
//                         where delib.id_ata = $id;";

//                         $result = mysqli_query($conn, $sql);
//                         $row=mysqli_fetch_assoc($result);
                        
//                         if($result ->num_rows > 0){
//                           print "<table>";
//                           while($row){
//                             print $row->facilitadores_responsaveis;
//                             print $row->nome_participantes;
//                             print $row->deliberador;
//                           }
//                           print "</table>";
//                         } else {
//                           print "Nehuma informação encontrada";
//                         }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da ata de encontro</title>
</head>
<body>

    <style>

    </style>

<main class="">
<table style="width: 500px;" border="1">
<tbody>
<tr style="height: 162.984px;">
<td style="width: 162.984px; height: 53.5px; text-align: center;">&nbsp;</td>
<td style="width: 384.231px; height: 53.5px; text-align: center;"><strong>ATA DE ENCONTRO&nbsp;</strong></td>
<td style="width: 181px; height: 53.5px; text-align: center;">NOR.QUA.001&nbsp;</td>
</tr>
</tbody>
</table>
<table style="width: 500px; margin-left: auto; margin-right: auto;" border="1" cellpadding="1">
<tbody>
<tr style="height: 500px;">
<td style="width: 162.984px; height: 4px; text-align: center; vertical-align: middle;">
<p>&nbsp;<strong>Data da Elabora&ccedil;&atilde;o</strong></p>
</td>
<td style="width: 153.016px; height: 48px; text-align: center; vertical-align: middle;">&nbsp;27/09/2021</td>
<td style="width: 129px; height: 48px; text-align: center; vertical-align: middle;"><strong>Vers&atilde;o</strong></td>
<td style="width: 129px; height: 48px; text-align: center; vertical-align: middle;">2 - 2021</td>
<td style="width: 142px; height: 48px; text-align: center; vertical-align: middle;">&nbsp;<strong>ANEXO 4</strong></td>
</tr>
</tbody>
</table>
<!-- DivTable.com -->
            <!---ABA DE DATA---->
            <div class="col-3">
                <label><b>Data</b></label>
                <input id="datainicio" class="form-control" placeholder="dd-mm-aaaa" min="2024-04-01" type="date" value="<?php echo $datasolicitada ?>">
            </div>

            <!---ABA DE HORÁRIO INICIO---->
            <div class="col-3">
                <label for="nomeMedico"><b>Horário de Início:</b></label>
                <br>
                <input class="form-control" type="time" id="horainicio" name="appt" min="" max="18:00">
            </div>

            <!---ABA DE HORÁRIO TERMINO---->
            <div class="col-3">
                <label for="form-control"> <b> Horário de Término:</b> </label>
                <input class="form-control" type="time" id="horaterm" name="appt" min="13:00" max="12:00" >
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
                    <?php
                        // Aqui você pode inserir opções dinâmicas para o select, por exemplo:
                        $objetivos = array("Objetivo 1", "Objetivo 2", "Objetivo 3");
                        foreach ($objetivos as $objetivo) {
                            echo "<option>$objetivo</option>";
                        }
                    ?>
                </select>
            </div>

            <!--- ABA DE SELECIONAR LOCAL ---->
            <div class="col-4 mt-4 pb-2">
                <label for="local"><b>Local:</b></label>
                <select class="form-control" name="local" id="local">
                    <option><?php echo $local;?></option> <!-- Aqui você pode inserir o valor dinâmico -->
                </select>
            </div>

            <div class="col-6 mt-4 pb-2"><b>Tema*:</b>
                <br>
                <input id="temaprincipal" class="form-control" type="text">
            </div>

            <!---ABA DE ADICIONAR FACILITADORES---->
            <div class="col-4 pt-2 pb-2"> 
                <label for="form-control"> <b> Facilitador(res) responsável*:</b> </label> 
            </div>

            <!-- Aqui você pode adicionar dinamicamente os facilitadores -->
            <div class="col-6 mt-2 pb-2">
                <input class="form-control" value="<?php echo $facilitador;?>" >
            </div>

            <label class="h4 pt-3"><b>PARTICIPANTES:</b></label>
            <div class="row pt-3">
                <div class="col-4">
                    <input class="form-control" value="<?php echo $participante;?>" >
                </div> 
                <!-- Aqui você pode adicionar dinamicamente os participantes -->
            </div>

            <label class="h4 pt-3"><b>DELIBERAÇÕES:</b></label>
            <div class="row pt-3">
                <div class="col-4">
                    <input class="form-control" value="<?php echo $deliberacao;?>" >
                </div> 
                <!-- Aqui você pode adicionar dinamicamente as deliberações -->
            </div>

            <footer class="col main-footer p-4" style="margin-left: 0 !important; margin-top: 1em;">
                <strong>Copyright © 2021 <a href="http://www.hospitalriogrande.com.br/" target="_blank">Hospital Rio Grande</a></strong>.
                Todos os direitos reservados.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Versão</b> 0.0.1
                </div>
            </footer>
        </div>
    </div>
    <tbody>
                <?php
                // $sql = "SELECT * FROM assunto order by id desc";
                // $result = mysqli_query($conn, $sql);

                // if ($result && mysqli_num_rows($result) > 0) {               
                //     while($row = mysqli_fetch_assoc($result)) {
                //         $id = $row['id'];
                //         $name = $row['data_solicitada'];
                //         $email = $row['tema'];
                //         $password = $row['objetivo'];
                //         $status = $row['status'];
                //         $local = $row['local'];


                //         echo "<tr>";
                //         echo "<td>" . $id . "</td>";
                //         echo "<td>" . $name . "</td>";
                //         echo "<td>" . $email . "</td>";
                //         echo "<td>" . $password . "</td>";
                //         echo "<td>" . $local . "</td>";
                //         echo "<td>" . $status . "</td>";

                //         echo "<td>
                //                 <button class='btn btn-primary'>
                //                     <a class='text-light' href='update.php? updateid=".$id."'>Update</a>
                //                 </button>
                //             </td>";
                       
                        
                //         echo "<td>
                //                 <button class='btn btn-success'>
                //                     <a class='text-light' href='impressao.php? updateid=".$id."'>Imprimir</a>
                //                 </button>
                //             </td>";
                //         echo "</tr>";
                //     }
                // } else {
                //     echo "<tr><td colspan='6'>Nenhum registro encontrado.</td></tr>";
                // }
                ?>
            </tbody>
</main>

</body>
</html>

