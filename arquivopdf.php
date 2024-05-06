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
            GROUP_CONCAT(DISTINCT fac_parti.nome_facilitador) AS nome_participantes,
            GROUP_CONCAT(DISTINCT delib.deliberacoes) AS deliberacoes,
            GROUP_CONCAT(DISTINCT fac_delib.nome_facilitador) AS nome_deliberadores,
            tp.texto_princ

            FROM 
            atareu.assunto AS assunto
            INNER JOIN atareu.participantes AS parti ON parti.id_ata = assunto.id
            INNER JOIN atareu.facilitadores AS fac_parti ON fac_parti.id = parti.participantes
            INNER JOIN atareu.deliberacoes AS delib ON delib.id_ata = assunto.id
            INNER JOIN atareu.facilitadores AS fac_delib ON fac_delib.id = delib.deliberadores
            INNER JOIN atareu.textoprinc as tp ON tp.id_ata = assunto.id
            WHERE 
                delib.id_ata = $id
            GROUP BY
            assunto.id";


                $result= $conn->query($sql);

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                
                    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // var_dump($row);
        $idAssunto = $row['IDASSUNTO'];
        $data = substr($row['data'], 0, -8);
        $tema = $row['tema'];
        $local = $row['local'];
        $horainicio = substr($row['horainicio'], 0, -3);
        $horafinal = substr($row['horatermi'], 0, -3);
        $objetivo = $row['objetivo'];
        $nomeParticipantes = $row['nome_participantes'];
        $nomeDeliberadores = $row['nome_deliberadores'];
        $deliberacoes = $row['deliberacoes'];
        $textop = $row['texto_princ'];


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
            <br>
            <table style="border: 1px solid black; padding: 8px 0px;">
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
                        <td style="border: 1px solid black;"s>ANEXO 4</td>
                    </tr>
                </tbody>
            </table>

            <h1 style="text-align: center;">Ata de encontro N°'.$idAssunto.'</h1>
            
            <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
                <tbody>
                    <tr style="text-align: center; background-color: #c0c0c0">
                        <td style="border: 1px solid black; height: 30px "><b>Data:</b></td>
                        <td style="height: 30px; border: 1px solid black;"><h4>Horário de Inicio:</h4></td>
                        <td style="height: 30px; border: 1px solid black;"><b>Horário de Término:</b></td>
                        <td style="height: 30px; border: 1px solid black;"><b>Tempo estimado:</b></td>
                    </tr>
                    <tr style="text-align: center; ">
                        <td style="border: 1px solid black; height: 30px ">'.$data.'</td>
                        <td style="border: 1px solid black; height: 30px">'.$horainicio.'</td>
                        <td style="border: 1px solid black; height: 30px">'.$horafinal.'</td>
                        <td style="border: 1px solid black; height: 30px">*Colocar</td>
                    </tr>
                </tbody>
            </table>
            <br> <br> 

            <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
                <tbody>
                    <tr style="text-align: center; background-color: #c0c0c0">
                        <td style="border: 1px solid black; height: 30px"><b>Objetivo:</b></td>
                        <td style="height: 31px; border: 1px solid black; "><h4>Local:</h4></td>
                        <td style="height: 30px; border: 1px solid black;"><b>Tema:</b></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td style="border: 1px solid black; ">'.$objetivo.'</td>
                        <td style="border: 1px solid black;">'.$local.'</td>
                        <td style="border: 1px solid black;">'.$tema.'</td>
                    </tr>
                </tbody>
            </table>        
            <h2> PARTICIPANTES </h2>
            <ul>';

        // Adicionando cada participante à lista
        foreach (explode(",", $nomeParticipantes) as $participante) {
            $html .= '<li>'.$participante.'</li>';
        }
        
        $html .='<h2> DELIBERAÇÕES </h2>';

        foreach (explode(",", $nomeDeliberadores) as $deliberador) {
            $html .= '
                <table>
                    <tbody>
                        <tr style="text-align: center; ">
                            <td style="height: 31px; border: 1px solid black; background-color: #c0c0c0">'.$deliberador.'</td>';
        
            foreach (explode(",", $deliberacoes) as $delib) {
                $html .= '<td style="border: 1px solid black;">'.$delib.'</td>';
            } 
        
            $html .= '
                        </tr>
                    </tbody>
                </table>';
        }
        
        $html .= '<br><br>
        <h2> TEXTO PRINCIPAL: </h2>
        <text style="height: 30px; border: 1px solid black;">'.$textop.'</txt>
        <br><br><br><br><br>
            <hr style="margin-left: 4px;" size="10" width="50%" align="center"></hr>
                       <txt>Assinatura do Responsável</txt>
                       <br><br><br><br><br><br><br><br>

                       <table style="border: 1px solid black; padding: 8px 0px; text-align: center;">
                       <tbody>
                           <tr style="text-align: center; background-color: #c0c0c0">
                               <td style="height: 31px; border: 1px solid black; "><h4>Assinatura de presença:</h4></td>
                           </tr>
                           <tr style="text-align: center;">
                               <td style="border: 1px solid black; "></td>
                               <td style="border: 1px solid black;"></td>
                               <td style="border: 1px solid black;"></td>
                           </tr>
                       </tbody>
                   </table>    

        </body></html>';
        


        $pdf->AddPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('arquivopdf.php', 'I');
    }
        } else {
            echo "Nenhum resultado encontrado.";
        }
}

?>