<?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $id = $_POST['id'];
                $datasolicitada = $_POST['datainicio'];
                $horainic = $_POST['horainicio'];
                $horaterm = $_POST['horaterm'];
                $tema = $_POST['tema'];
                $objetivo = $_POST['objetivo'];
                $local = $_POST['local'];

                $sql_update = "UPDATE assunto SET data_solicitada = ?, hora_inicial = ?, hora_termino = ?, tema = ?, objetivo = ?, local = ? WHERE id = ?";
                $stmt_update = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt_update, 'ssssssi', $datasolicitada, $horainic, $horaterm, $tema, $objetivo, $local, $id);

                if (mysqli_stmt_execute($stmt_update)) {
                    echo "Dados atualizados com sucesso!";
                } else {
                    echo "Erro ao atualizar os dados: " . mysqli_error($conn);
                }
                mysqli_stmt_close($stmt_update);
            }

            mysqli_close($conn);
?>
