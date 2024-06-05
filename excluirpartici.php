<?php
include 'database.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['facili']) && isset($_POST['id'])) {
        $participante = $_POST['facili'];
        $id_ataenviar = $_POST['id'];

        foreach ($participante as $faci) {
            $sql_excluir_facilitador = "DELETE FROM ata_has_fac WHERE id_ata = ? AND facilitadores = ?";
            if ($stmt_excluir_facilitador = $conexao->prepare($sql_excluir_facilitador)) {
                $stmt_excluir_facilitador->bind_param("ii", $id_ataenviar, $faci);
                $stmt_excluir_facilitador->execute();
                $stmt_excluir_facilitador->close();
                echo json_encode(array("success" => true, "message" => "Participante excluído com sucesso."));
            } else {
                echo json_encode(array("success" => false, "message" => "Erro ao preparar a consulta SQL para excluir o facilitador: " . $conexao->error));
            }
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Campos 'facili' ou 'id' não estão definidos no POST."));
    }
} else {
    echo json_encode(array("success" => false, "message" => "O método de solicitação não é POST."));
}


// var facili = [];
// var buttons = document.querySelectorAll('.excluir-button');
// buttons.forEach(function(button) {
//     button.addEventListener('click', function() {
//         var index = this.getAttribute('data-index');
//         facili.push(index);
        
//     });
// });


// 
// function excluirParticipante(facili, participante) {
//     if (confirm("Tem certeza de que deseja excluir o participante '" + participante + "'?")) {
//         $.ajax({
//             url: 'excluirpartici.php',
//             method: 'POST',
//             data: {
//               facili: facili,
//             },
//             success: function(response) {
//                 var res = JSON.parse(response);
//                 if (res.success) {
//                     console.log("Participante excluído com sucesso:", res.message);

//                     var participanteElements = document.querySelector("li:contains('" + participante + "')");
//                     participanteElements.forEach(function(element) {
//                         if (element.innerText.includes(participante)) {
//                             element.remove();
//                         }
//                     });
//                 } else {
//                     alert("Erro ao excluir o participante: " + res.message);
//                 }
//             },
//             error: function(error) {
//                 console.error('Erro na solicitação AJAX:', error);
//                 alert('Erro ao excluir o participante. Tente novamente.');
//             }
//         });
//     }
// }
// function excluirParticipante(participante) {
//     if (confirm("Tem certeza de que deseja excluir o participante '" + participante + "'?")) {
//       var participanteElement = document.querySelector("li:contains('" + participante + "')");
//       if (participanteElement) {
//         participanteElement.remove();
//       } else {
//         alert("Participante não encontrado na lista.");
//       }
//     }
//   }