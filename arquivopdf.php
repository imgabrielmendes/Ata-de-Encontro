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
                <tr style="text-align: left">
                    <td style="padding: 5px; border: 1px solid black"><b>  Data:</b> '.$data.'</td>
                    <td style="padding: 5px; border: 1px solid black"><b>  Inicio:</b> '.$horainicio.'</td>
                    <td style="padding: 5px; border: 1px solid black"><b>  Término:</b> '.$horafinal.'</td>
                    <td style="padding: 5px; border: 1px solid black"><b>  Objetivo:</b> '.$objetivo.'</td>
                </tr>
                <tr style="text-align: LEFT;">
                <td style="padding: 5px; border: 1px solid black; width: 540px; font-size: 10px;"><b>   Facilitador(es):</b> COLOCAR A VARIÁVEL SQL</td>
                </tr>
            </tbody>
        </table>

        <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
        <tbody>
            <tr style="font-size: 10p">
                <td style="border: 1px solid black; width: 178px; text-align: left; height: 30px; "><b>  Local:</b>  '.$local.'</td>
                <td style="border: 1px solid black; width: 362px; text-align: left; height: 30px;">'.'   '.'<b>Tema:</b>  '.$tema.'</td>
            </tr>
        </tbody>
        </table>';

        $html .= '<h2>PARTICIPANTES</h2>';
        if (!empty($nomeParticipantes)) {
            foreach (explode(",", $nomeParticipantes) as $participante) {
                $html .= htmlspecialchars($participante) . ',  ';
            }
        } else {
            $html .= '<p>Participantes não informados</p>';
        }
        }

        $html .= '<h2>TEXTO PRINCIPAL: </h2>';

        if (empty($textop)) {
            $html .= '<p>Texto principal não informado</p>';
        } else {
            $html .= '<p>' . htmlspecialchars($textop) . '</p>';
        }

        $html .= '<h2> DELIBERAÇÕES </h2>';

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

        if (!empty($deliberadores_por_deliberacao)) {
            foreach ($deliberadores_por_deliberacao as $deliberacao => $deliberadores) {
                $html .= '
                    <table style="border: 1px solid black; padding: 8px 0px; text-align: center">
                        <tbody>
                            <tr style="">
                                <td style="text-align: center; border: 1px solid black; background-color: #c0c0c0; width: 130px; font-size: 9.5px;"><ul><b>' . implode(",<br>", array_map('htmlspecialchars', $deliberadores)) . '</b></ul></td>
                                <td style="text-align: left; border: 1px solid black; height: 30px; width: 409px; font-size: 10px;">'."  " . htmlspecialchars($deliberacao) . '</td>
                            </tr>
                        </tbody>
                    </table>';
            }
        } else {
            $html .= '<p>Deliberações não informadas</p>';
        }      

        $html .= '<hr style="margin-right: auto; width: 40%;" align="center">
                  <p style="display: block; text-align: center;">Assinatura do Responsável</p>
                  <br><br><br>';

        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

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
        </table>';

        $html .= '
        <table style="border: 1px solid black; padding: 6px 0px; text-align: center;">
        <tbody>
            <tr style="text-align: center">
                <td style="height: 40px; border: 1px solid black; background-color: #c0c0c0;"><h4>Assinatura de presença:</h4></td>
            </tr>
        </tbody>
        </table>

        <table style="border: 1px solid black; text-align: center; padding: 4px 0px;">
        <tbody>
        <tr style="text-align: center; background-color: #ececed">
            <td style="height: 31px; border: 1px solid black; width: 79px; vertical-align: middle;"><h4>Mat.</h4></td>
            <td style="height: 31px; border: 1px solid black; width: 170px; vertical-align: middle;"><h4>Nome:</h4></td>
            <td style="height: 31px; border: 1px solid black; width: 180px; vertical-align: middle;"><h4>Função:</h4></td>
            <td style="height: 31px; border: 1px solid black; width: 110px; vertical-align: middle;"><h4>Assinatura:</h4></td>
        </tr>';

        if (!empty($nomeParticipantes)) {
            foreach (explode(",", $nomeParticipantes) as $participante) {
                $html .= '<tr style="text-align: left; font-size: 10px;">
                            <td style="border: 1px solid black; height: 20px;"></td>
                            <td style="border: 1px solid black;">'."  ".$participante.'</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>';
            }
        } else { $html .= '<p>Texto principal não informado</p>'; }

        for ($linha = 0; $linha < 8; $linha++) {
            $html .= '<tr style="text-align: center;">
                        <td style="height: 31px; border: 1px solid black; height: 20px;"></td>
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