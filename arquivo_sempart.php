<?php
namespace formulario;
include ("conexao.php");
$id = $_GET['updateid'];

require_once(__DIR__ . "/view/TCPDF/tcpdf.php");


$sql2 = "SELECT 
        ass.id,
        ahf.id_ata,
        fac.matricula,
        fac.nome_facilitador as facilitadores,
        fac.email_facilitador
    FROM atareu.assunto as ass
    INNER JOIN atareu.ata_has_fac as ahf
        ON ahf.id_ata = ass.id
    INNER JOIN atareu.facilitadores as fac
        ON fac.id = ahf.facilitadores
    WHERE ahf.id_ata = $id";

$result2 = $conn->query($sql2);
$facilitadoresArray = [];

if ($result2 === false) {
    echo "Erro na consulta: " . $conn->error;
} else {
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $facilitadores = !empty($row['facilitadores']) ? $row['facilitadores'] : '';
            $facilitadoresArray[] = $facilitadores; // Armazena facilitadores em um array
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
}

$facilitadoresString = implode(", ", $facilitadoresArray);



$sql = "SELECT
assunto.id AS IDASSUNTO,
assunto.hora_inicial AS horainicio,
assunto.hora_termino AS horatermi,
assunto.local AS local,
assunto.tema AS tema,
assunto.objetivo AS objetivo,
assunto.data_solicitada,
date_format(assunto.data_solicitada, '%d/%m/%y') as data
FROM
atareu.assunto AS assunto
WHERE
assunto.id = $id";

$result= $conn->query($sql);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $idAssunto = !empty($row['IDASSUNTO']) ? $row['IDASSUNTO'] : '';
            $data = !empty($row['data']) ? $row['data'] : '';
            $tema = !empty($row['tema']) ? $row['tema'] : '';
            $local = !empty($row['local']) ? $row['local'] : '';
            $horainicio = !empty($row['horainicio']) ? substr($row['horainicio'], 0, -3) : '';
            $horafinal = !empty($row['horatermi']) ? substr($row['horatermi'], 0, -3) : '';
            $objetivo = !empty($row['objetivo']) ? $row['objetivo'] : '';

            class MYPDF extends \TCPDF {

                public function Footer() {
                    // Posição a 15 mm do fundo
                    $this->SetY(-30); // Ajusta a posição conforme necessário
                    // Define a fonte
                    $this->SetFont('helvetica', 'I', 8);
                    // Número da página
                    $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
                    
                    // Adiciona a linha e o texto de assinatura
                    $this->SetY(-15); // Ajusta a posição conforme necessário
                    $this->SetFont('helvetica', '', 10);
                    $this->Cell(0, 0, '', 'T', 1, 'C'); // Linha
                    $this->Cell(0, 10, 'Assinatura do Responsável', 0, 1, 'C'); // Texto
                }
            }
    
            $pdf = new \TCPDF();
    
            $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('HRG_SETOR DE T.I');
                $pdf->SetTitle('Ata de encontro N°'.$id);
                $pdf->SetSubject('Documento PDF referente ao documento de ata eletrônica, em que o documento possui a id de numeração:'.$id);
                $pdf->SetKeywords('TCPDF, PDF, exemplo, teste, guia');
                
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    
                $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

                $html = '
            <table style="border: 1px solid black; padding: 8px 0px; order-spacing:3px">
        <tbody>
        <tr style="text-align: center;">
        <td style="height: 20px; border: 1px solid black;"><img src="view\img\logo-hrg.png" alt="Descrição da imagem"></td>
        <td style="height: 30px;"></td>
        <td style="height: 30px;"><h4>Ata de Encontro</h4></td>
        <td style="height: 30px;"></td>
        <td style="height: 30px;  border: 1px solid black;">NOR.QUA.-E</td>
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
        <td style="padding: 5px; border: 1px solid black; width: 540px; font-size: 10px;"><b>   Facilitador(es):</b>'.'  '. $facilitadoresString. '.'.'</td>
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
        
        $html .='
        
        <h2>TEXTO PRINCIPAL:</h2>
        <table style="border: 1px solid black; padding: 8px 0px; text-align: center">
            <tbody>
                <tr style="">
                    <td style="text-align: left; border: 1px solid black; height: 120px; width: 539px; font-size: 10px;"></td>
                </tr>
            </tbody>
        </table>
        
        <h2> DELIBERAÇÕES </h2>
        <table style="border: 1px solid black; padding: 8px 0px; text-align: center">
            <tbody>
                <tr style="">
                    <td style="text-align: left; border: 1px solid black; height: 120px; width: 539px; font-size: 10px;"></td>
                </tr>
            </tbody>
        </table>
        '; 

        $html .= '<br><br><br><br>
        <hr style="margin-right: auto; width: 40%;">
        <p>Assinatura do Responsável</p>
        ';
        
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');

        $html .= '<br><br><br><br>
        <hr style="margin-right: auto; width: 40%;">
        <p>Assinatura do Responsável</p>
        ';


        // Adicionar nova página para a lista de participantes
        $pdf->AddPage();
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
            <td style="height: 31px; border: 1px solid black; width: 250px; vertical-align: middle;"><h4>Nome:</h4></td>
            <td style="height: 31px; border: 1px solid black; width: 120px; vertical-align: middle;"><h4>Função:</h4></td>
            <td style="height: 31px; border: 1px solid black; width: 90px; vertical-align: middle;"><h4>Assinatura:</h4></td>
        </tr>';

            for ($linha = 0; $linha < 22; $linha++) {
                $html .= '<tr style="text-align: center;">
                <td style="height: 31px; border: 1px solid black; height: 20px;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                <td style="border: 1px solid black;"></td>
                </tr>';
                }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('ata_de_encontro'.$idAssunto.'.pdf', 'I');
    }

} else {
    echo "Nenhum resultado encontrado.";
}}
?>
