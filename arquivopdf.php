<?php
namespace formulario;
include ("conexao.php");
$id = $_GET['updateid'];

require_once("C:\\xampp\\htdocs\\dev\\Ata-de-Encontro\\TCPDF\\tcpdf.php");

$sql = "SELECT
assunto.id AS IDASSUNTO,
assunto.hora_inicial AS horainicio,
assunto.hora_termino AS horatermi,
assunto.local AS local,
assunto.tema AS tema,
assunto.objetivo AS objetivo,
assunto.data_solicitada AS data,
fac_delib.matricula as matric,
GROUP_CONCAT(DISTINCT fac_parti.nome_facilitador) AS nome_participantes,
GROUP_CONCAT(DISTINCT delib.deliberacoes) AS deliberacoes,
GROUP_CONCAT(DISTINCT CONCAT(fac_delib.nome_facilitador, ':', delib.deliberacoes)) AS deliberadores_deliberacoes,
tp.texto_princ
FROM
atareu.assunto AS assunto
INNER JOIN atareu.participantes AS parti ON parti.id_ata = assunto.id
INNER JOIN atareu.facilitadores AS fac_parti ON fac_parti.id = parti.participantes
INNER JOIN atareu.deliberacoes AS delib ON delib.id_ata = assunto.id
INNER JOIN atareu.facilitadores AS fac_delib ON fac_delib.id = delib.deliberadores
INNER JOIN atareu.textoprinc AS tp ON tp.id_ata = assunto.id
WHERE
delib.id_ata = $id
GROUP BY
assunto.id;
";


                $result= $conn->query($sql);

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                
                    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // var_dump($row);
        $idAssunto = $row['IDASSUNTO'];
        $data = substr($row['data'], 0, -8);
        $tema = $row['tema'];
        $matric = $row['matric'];
        $local = $row['local'];
        $horainicio = substr($row['horainicio'], 0, -3);
        $horafinal = substr($row['horatermi'], 0, -3);
        $objetivo = $row['objetivo'];
        $nomeParticipantes = $row['nome_participantes'];
        $deliberacoes = $row['deliberacoes'];
        $deliberadores_deliberacoes = $row['deliberadores_deliberacoes'];
        $textop = $row['texto_princ'];

        // var_dump($matric);

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

                            $html = '
          
            <table style="border: 1px solid black; padding: 8px 0px; order-spacing:3px">
                <tbody>
                    <tr style="text-align: center;">
                        <td style="height: 20px; border: 1px solid black;"><img src="view\img\logo-hrg.png" alt="Descrição da imagem"></td>
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
                        <td style="border: 1px solid black;">ANEXO 4</td>
                    </tr>
                </tbody>
            </table>

            <h1 style="text-align: center;">Ata de encontro N°'.$idAssunto.'</h1>
            
            <table style="padding: 6px 0px; text-align: center; font-size: 10px; width: 540px; height: 20px;">
            <tbody>
                <tr style="text-align: center; background-color: #c0c0c0">
                    <td style="padding: 5px; border: 1px solid black"><b>Data:</b></td>
                    <td style="padding: 5px; border: 1px solid black"><h4>Horário de Inicio:</h4></td>
                    <td style="padding: 5px; border: 1px solid black"><b>Horário de Término:</b></td>
                    <td style="padding: 5px; border: 1px solid black"><b>Tempo estimado:</b></td>
                    <td style="padding: 5px; border: 1px solid black"><b>Objetivo:</b></td>
                </tr>
                <tr style="text-align: center;">
                    <td style="border: 1px solid black; padding: 5px;">'.$data.'</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$horainicio.'</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$horafinal.'</td>
                    <td style="border: 1px solid black; padding: 5px;">*Colocar</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$objetivo.'</td>
                </tr>
            </tbody>
        </table>

        <table style="border: 1px solid black; padding: 8px 0px; text-align: center; ">
        <tbody>
            <tr style="background-color: #c0c0c0">
                <td style="border: 1px solid black; height: 30px; width: 108px;"><b>Local:</b></td>
                <td style="border: 1px solid black; width: 432px; text-align: left;">'.'   '.'<b>Tema:</b></td>
            </tr>
                <tr>
                    <td style="border: 1px solid black; text-align: center;">'.$local.'</td>
                    <td style="border: 1px solid black; text-align: left; padding-left: 10px;">'.'   '.$tema.'</td>
                </tr>
            </tbody>
        </table>

        <h2> PARTICIPANTES </h2>
        <ul style="">';

        // Adicionando cada participante à lista
        foreach (explode(",", $nomeParticipantes) as $participante) {
            $html .= '<li>'.$participante.'</li>';
        }
        
        $html .= '</ul>';
        $html .='<h2> DELIBERAÇÕES </h2>';


$deliberadores_por_deliberacao = array();

if (!empty($deliberadores_deliberacoes)) {

    foreach (explode(",", $deliberadores_deliberacoes) as $deliberador_deliberacao) {
        list($deliberador, $deliberacao) = explode(":", $deliberador_deliberacao);

        if (isset($deliberadores_por_deliberacao[$deliberacao])) {

            $deliberadores_por_deliberacao[$deliberacao][] = $deliberador;
        } else {

            $deliberadores_por_deliberacao[$deliberacao] = array($deliberador);
        }
    }
}

foreach ($deliberadores_por_deliberacao as $deliberacao => $deliberadores) {
    $html .= '
        <table style="border: 1px solid black; padding: 8px 0px; text-align: center">
            <tbody>
                <tr style="">
                    <td style="text-align: center; border: 1px solid black; background-color: #c0c0c0; width: 130px; font-size: 9,5px;"><ul><b>'.implode(",<br>", $deliberadores).'</b></ul></td>
                    <td style="text-align: left; border: 1px solid black; height: 30px; width: 409px; font-size: 10px;">'.'    '.$deliberacao.'</td>
                </tr>
            </tbody>
        </table>';
}

$html .= '</body></html>';

        
        
        $html .= '
        <h2> TEXTO PRINCIPAL: </h2>
        <text style="height: 30px; border: 1px solid black">'.$textop.'</txt>
        <br><br><br><br><br>

        <hr style="margin: 5px auto; width: 40%;" align="center">
        <txt style="display: block; text-align: center;">Assinatura do Responsável</txt>
        
        <br><br><br><br><br><br><br><br>

        <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
        <tbody>
            <tr style="text-align: center">
                <td style="height: 31px; border: 1px solid black; background-color: #c0c0c0 "><h4>Assinatura de presença:</h4></td>
            </tr>
        </tbody>
        </table>  

        <table style="border: 1px solid black; text-align: center; padding: 6px 0px;">
    <tbody>
    <tr style="text-align: center; background-color: #ececed">
        <td style="height: 31px; border: 1px solid black; width: 60px; vertical-align: middle;"><h4>Mat.</h4></td>
        <td style="height: 31px; border: 1px solid black; width: 150px; vertical-align: middle;"><h4>Nome:</h4></td>
        <td style="height: 31px; border: 1px solid black; width: 60px; vertical-align: middle;"><h4>Função:</h4></td>
        <td style="height: 31px; border: 1px solid black; width: 262px; vertical-align: middle;"><h4>Assinatura:</h4></td>
    </tr>';


        foreach (explode(",", $nomeParticipantes) as $participante) {
            $html .= '<tr style="text-align: center;">
                        <td style="border: 1px solid black; height: 20px;"></td>
                        <td style="border: 1px solid black;">'.$participante.'</td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>

                    </tr>';
        }

    $html .='</tbody>
            </table>';
   
        $html .='</body></html>';

        $pdf->AddPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('arquivopdf.php', 'I');
    }
        } else {
            echo "Nenhum resultado encontrado.";
        }
}

?>