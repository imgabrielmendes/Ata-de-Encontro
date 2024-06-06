<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_ata']) && isset($_POST['index'])) {
        $id_ata = $_POST['id_ata'];
        $index = $_POST['participante'];
        var_dump($index);
    
        $sql = "DELETE FROM  ata_has_fac WHERE id_ata = ? AND facilitadores = $index";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ii", $id_ata, $index);
        if ($stmt->execute()) {
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false, "message" => "Erro ao excluir participante do banco de dados"));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Parâmetros 'id_ata' ou 'index' não foram recebidos"));
    }
} else {
    echo json_encode(array("success" => false, "message" => "O método de requisição não é POST"));
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