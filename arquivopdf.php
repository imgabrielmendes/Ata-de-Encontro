<?php
namespace formulario;
include ("conexao.php");
$id = $_GET['updateid'];

require_once("C:\\xampp\\htdocs\\dev\\Ata-de-Encontro\\TCPDF\\tcpdf.php");

$sql=
        "SELECT  
        assunto.id as IDASSUNTO,
        ahf.id_ata as idatadohas,
        assunto.hora_inicial as horainicio,
        assunto.hora_termino as horatermi,
        
        assunto.local as local,

        assunto.tema as tema,

        assunto.objetivo as objetivo,

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
                            $data=substr($date = $row['data'],0,-8);
                            $tema = $row['tema'];

                            $local = $row['local'];

                            
                            $horainicio=substr($horainici = $row['horainicio'], 0 , -3);
                            $horafinal=substr($horafina=$row['horatermi'], 0 , -3);

                            $objetivo = $row['objetivo'];


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
                            <table style="border: 1px solid black; padding: 8px 0px;">
                            <tbody>
                                <tr style="text-align: center;">
                                    <td style="height: 20px; border: 1px solid black;"><img src="view\img\logo-hrg.png" alt="Descrição da imagem">
                                    </td>
                                    <td style="height: 30px;"></td>
                                    <td style="height: 30px;"><h4>Ata de Encontro</h4></td>
                                    <td style="height: 30px;"></td>
                                    <td style="height: 30px;  border: 1px solid black;">NOR.QUA.001</td>
                                </tr>
                                <tr style="text-align: center;">
                                    <td style="border: 1px solid black; "><b>Data de elaboração:</b></td>
                                    <td style="border: 1px solid black;">27/09/2021</td>
                                    <td style="border: 1px solid black;"><b>Versão</b></td>
                                    <td style="border: 1px solid black;">2-2021</td>
                                    <td style="border: 1px solid black;"s>ANEXO 4</td>
                                </tr>
                            </tbody>
                        </table>

                        <h1 style="text-align: center;">Ata de encontro N°'.$idAssunto.'</h1>
                        <textarea>
                            
                        <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
                            <tbody>
                                <tr style="text-align: center;">
                                    <td style="border: 1px solid black; "><b>Data:</b></td>
                                    <td style="height: 30px;"><h4>Horário de Inicio:</h4></td>
                                    <td style="height: 30px;  border: 1px solid black;"><b>Horário de Término:</b></td>
                                    <td style="height: 30px;  border: 1px solid black;"><b>Tempo estimado:</b></td>

                                </tr>
                                <tr style="text-align: center;">
                                    <td style="border: 1px solid black; ">'.$data.'</td>
                                    <td style="border: 1px solid black;">'.$horainicio.'</td>
                                    <td style="border: 1px solid black;">'.$horafinal.'</td>
                                    <td style="border: 1px solid black;"s>*Colocar</td>
                                </tr>
                            </tbody>
                        </table>
<h1>//////////////</h1>
                        <table style="border: 1px solid black;">
                        <tbody>
                            <tr style="text-align: center; height: 30px;">
                                <td style=""><b>Objetivo:</b></td>
                                <td style=""><h4>local:</h4></td>
                                <td style=""><b>Tema:</b></td>

                            </tr>
                            <tr>
                                <td >'.$objetivo.'</td>
                                <td >'.$local.'</td>
                                <td >'.$tema.'</td>
                            </tr>
                        </tbody>
                    </table>

                            </textarea>
                            <h2> PARTICIPANTES </h2>
                            <txt> '.$nomeParticipantes.' <txt>

                            <h2> DELIBERAÇÕES </h2>
                            
                            <table>
                                <tbody>
                                    <tr style="margin-left: -10px;">
                                        <td>'.$nomeDeliberadores.'</td>
                                        <td>'.$deliberacoes.'</td>
                                    </tr>
                                </tbody>
                            </table>

                            <footer style="text-align: center;">
                                <strong>Copyright © 2021 <a href="http://www.hospitalriogrande.com.br/" target="_blank">Hospital Rio Grande</a></strong>.
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

</head>
<body>
    
</body>
</html>