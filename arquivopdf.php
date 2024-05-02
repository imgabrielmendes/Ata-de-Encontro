<?php
namespace formulario;
include ("conexao.php");
$id = $_GET['updateid'];

require_once("C:\\xampp\\htdocs\\dev\\Ata-de-Encontro\\TCPDF\\tcpdf.php");

$sql=
        "SELECT  
        assunto.id as IDASSUNTO,
        ahf.id_ata as idatadohas,
        assunto.data_solicitada as data,
        ahf.facilitadores as idfacilitadores,
        fac.nome_facilitador AS facilitadores_responsaveis,
        parti.participantes as idparticipantes,
        fac_parti.nome_facilitador as nome_participantes,
            
        delib.deliberadores as iddeliberadores,
        fac_delib.nome_facilitador as nome_deliberadores,
        delib.deliberacoes
            
        FROM atareu.assunto as assunto
            INNER JOIN atareu.ata_has_fac as ahf
            ON ahf.id_ata = assunto.id
                INNER JOIN atareu.facilitadores as fac
                ON fac.id = ahf.facilitadores
                    INNER JOIN atareu.participantes as parti
                    ON parti.id_ata = assunto.id
                    INNER JOIN atareu.facilitadores AS fac_parti 
                    ON fac_parti.id = parti.participantes
                        INNER JOIN atareu.deliberacoes as delib
                        ON delib.id_ata = assunto.id
                        INNER JOIN atareu.facilitadores as fac_delib
                        ON fac_delib.id = delib.deliberadores
                            where delib.id_ata = $id
                            ;";

                $result= $conn->query($sql);
                $dados = $result->fetch_assoc();

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    
                            $idAssunto = $row['IDASSUNTO'];
                            $idAtaDoHas = $row['idatadohas'];
                            $data = $row['data'];
                            $idFacilitadores = $row['idfacilitadores'];
                            $facilitadoresResponsaveis = $row['facilitadores_responsaveis'];
                            $idParticipantes = $row['idparticipantes'];
                            $nomeParticipantes = $row['nome_participantes'];
                            $idDeliberadores = $row['iddeliberadores'];
                            $nomeDeliberadores = $row['nome_deliberadores'];
                            $deliberacoes = $row['deliberacoes'];
                
                            $pdf = new \TCPDF();

                            // echo "info1:" . $idAssunto . "<br>";
                            // echo "info2:" . $idAtaDoHas . "<br>";
                            // echo "info3:" . $idFacilitadores  . "<br>";
                            // echo "info4:" . $facilitadoresResponsaveis . "<br>";
                            // echo "info5:" . $idParticipantes . "<br>";
                            // echo "info6:" . $nomeParticipantes . "<br>";
                            // echo "info7:" . $idDeliberadores . "<br>";
                            // echo "info8:" . $nomeDeliberadores . "<br>";
                            // echo "info9:" . $deliberacoes . "<br>";

                            $hmtl='<br>
                            <table style="border: 1px solid black;">
                            <table class="blueTable">
                         
                                <tbody>
                                    <tr>
                                        <td>------</td>
                                        <td></td>
                                        <td>Ata de Encontro</td>
                                        <td></td>
                                        <td>NOR.QUA.001</td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td><b>Data de elaboração:</b></td>
                                        <td>27/09/2021</td>
                                        <td>Versão</td>
                                        <td>2-2021</td>
                                        <td>ANEXO 4&nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h1 style="text-align: center;">Ata de encontro N°'.$idAssunto.'</h1>
                            <textarea>

                            <txt><b>Facilitador(es) Responsáveis:</b><ul>'
                                .$facilitadoresResponsaveis.
                            '</ul></txt>

                            <txt><b>Participantes:</b><ul>'.$nomeParticipantes.'</ul></txt>
                            <h4>'.$data.'</h4>              
                            <h4>'.$nomeDeliberadores.'</h4>
                            <h4>'.$deliberacoes.'</h4>
                            
                            </textarea>
                            <h1> PARTICIPANTES </H1>
                            <H4> Participantes aqui <h4>

                            <h1> DELIBERAÇÕES </H1>
                            <H4> Deliberações aqui <h4>

                            <footer class="col main-footer p-4" style="margin-left: 0 !important; margin-top: 1em;">
                                <strong>Copyright © 2021 <a href="http://www.hospitalriogrande.com.br/" target="_blank">Hospital RiGrande</a></strong>.
                                Todos os direitos reservados.
                                <div class="float-right d-none d-sm-inline-block">
                                    <b>Versão</b> 0.0.1
                                </div>
                            </footer>
                            </body>
                            </html>';

                            $pdf->AddPage();

                            $pdf->writeHTML($hmtl, true, false, true, false,'');

                            $pdf->Output('arquivopdf.php', 'I');

                        }            
                    }
                }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações da ata de encontro</title>
</head>
<body>

   <footer class="col main-footer p-4" style="margin-left: 0 !important; margin-top: 1em;">
        <strong>Copyright © 2021 <a href="http://www.hospitalriogrande.com.br/" target="_blank">Hospital RiGrande</a></strong>.
        Todos os direitos reservados.
        <div class="float-right d-none d-sm-inline-block">
             <b>Versão</b> 0.0.1
        </div>
    </footer> -->
<!--                
</body>
</html>  -->