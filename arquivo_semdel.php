<?php
namespace formulario;
include ("conexao.php");
$id = $_GET['updateid'];

require_once(__DIR__ . "/view/TCPDF/tcpdf.php");

$sql = "SELECT
assunto.id AS IDASSUNTO,
assunto.hora_inicial AS horainicio,
assunto.hora_termino AS horatermi,
assunto.local AS local,
assunto.tema AS tema,
assunto.objetivo AS objetivo,
assunto.data_solicitada,
date_format(assunto.data_solicitada, '%d/%m/%y') as data,
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

        $idAssunto = !empty($row['IDASSUNTO']) ? $row['IDASSUNTO'] : '';
        $data = !empty($row['data']) ? $row['data'] : '';
        $tema = !empty($row['tema']) ? $row['tema'] : '';
        $matric = !empty($row['matric']) ? $row['matric'] : '';
        $local = !empty($row['local']) ? $row['local'] : '';
        $horainicio = !empty($row['horainicio']) ? substr($row['horainicio'], 0, -3) : '';
        $horafinal = !empty($row['horatermi']) ? substr($row['horatermi'], 0, -3) : '';
        $objetivo = !empty($row['objetivo']) ? $row['objetivo'] : '';
        $nomeParticipantes = !empty($row['nome_participantes']) ? $row['nome_participantes'] : '';
        $deliberacoes = !empty($row['deliberacoes']) ? $row['deliberacoes'] : '';
        $deliberadores_deliberacoes = !empty($row['deliberadores_deliberacoes']) ? $row['deliberadores_deliberacoes'] : '';
        $textop = !empty($row['texto_princ']) ? $row['texto_princ'] : '';


        // echo($idAssunto). "<br>" ;
        // echo($data). "<br>" ;
        // echo($tema). "<br>";
        // echo($matric). "<br>" ;
        // echo($local). "<br>" ;
        // echo($horainicio). "<br>" ;
        // echo($horafinal). "<br>" ;
        // echo($objetivo). "<br>" ;
        // echo($nomeParticipantes). "<br>" ;
        // echo( $deliberacoes). "<br>";
        // echo( $deliberadores_deliberacoes). "<br>";
        // echo($textop). "<br>";
        
        $pdf = new \TCPDF();
        $pdf->SetCreator(PDF_CREATOR);

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
                        <td style="border: 1px solid black;"><b>Data de elaboração:</b></td>
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

        <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
        <tbody>
            <tr style="background-color: #c0c0c0">
                <td style="border: 1px solid black; height: 30px; width: 108px;"><b>Local:</b></td>
                <td style="border: 1px solid black; width: 432px; text-align: left;">'.'   '.'<b>Tema:</b></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; text-align: center; font-size: 9px">'.$local.'</td>
                <td style="border: 1px solid black; text-align: left; padding-left: 10px;">'.'   '.$tema.'</td>
            </tr>
        </tbody>
        </table>';

        $html .= '<h2>PARTICIPANTES</h2>';
        if (!empty($nomeParticipantes)) {
            $html .= '<ul>';
            foreach (explode(",", $nomeParticipantes) as $participante) {
                $html .= '<li>' . htmlspecialchars($participante) . '</li>';
            }
            $html .= '</ul>';
        } else {
            $html .= '<p>Participantes não informados</p>';
        }
        }

        $html .= '<h2> DELIBERAÇÕES </h2>';

        $html .= '<table style="border: 1px solid black; padding: 8px 0px; text-align: center">
        <tbody>
            <tr style="">
                <td style="text-align: left; border: 1px solid black; height: 120px; width: 539px; font-size: 10px;"></td>
            </tr>
        </tbody>
    </table>';   

        $html .= '<h2>TEXTO PRINCIPAL:</h2>';
        $html .= '<table style="border: 1px solid black; padding: 8px 0px; text-align: center">
        <tbody>
            <tr style="">
                <td style="text-align: left; border: 1px solid black; height: 120px; width: 539px; font-size: 10px;"></td>
            </tr>
        </tbody>
    </table>';        
        
        $html .= '<hr style="margin-right: auto; width: 40%;" align="center">
                  <p style="display: block; text-align: center;">Assinatura do Responsável</p>
                  ';

        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $html = '
        <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
        <tbody>
            <tr style="text-align: center">
                <td style="height: 40px; border: 1px solid black; background-color: #c0c0c0;"><h4>Assinatura de presença:</h4></td>
            </tr>
        </tbody>
        </table>

        <table style="border: 1px solid black; text-align: center; padding: 4px 0px;">
        <tbody>
            <tr style="text-align: center; background-color: #ececed">
                <td style="height: 31px; border: 1px solid black; width: 59px; vertical-align: middle;"><h4>Mat.</h4></td>
                <td style="height: 31px; border: 1px solid black; width: 150px; vertical-align: middle;"><h4>Nome:</h4></td>
                <td style="height: 31px; border: 1px solid black; width: 60px; vertical-align: middle;"><h4>Função:</h4></td>
                <td style="height: 31px; border: 1px solid black; width: 270px; vertical-align: middle;"><h4>Assinatura:</h4></td>
            </tr>';

            foreach (explode(",", $nomeParticipantes) as $participante) {
                $html .= '<tr style="text-align: left; font-size: 10px;">
                            <td style="border: 1px solid black; height: 30px;"></td>
                            <td class="participant-cell" style="border: 1px solid black; padding-left: 10px; vertical-align: middle;">'."   ".$participante.'</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>';
            }
            

        for ($linha = 0; $linha < 6; $linha++) {
            $html .= '<tr style="text-align: center;">
                        <td style="border: 1px solid black; height: 37px;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                        <td style="border: 1px solid black;"></td>
                    </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('ata_de_encontro'.$idAssunto.'.pdf', 'I');
    }

} else {
    echo "Nenhum resultado encontrado.";
}

?>