
function excluirParticipante(id_ata, participante) {
    if (confirm("Tem certeza de que deseja excluir o participante '" + participante + "'?")) {
        $.ajax({
            url: 'excluirparticipante.php',
            method: 'POST',
            data: {
                id_ata: id_ata,
                participante: participante
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.success) {
                    console.log("Participante excluído com sucesso:", res.message);

                    // Remove visualmente o participante da tabela
                    var participanteRow = document.getElementById('participante-' + id_ata + '-' + participante);
                    if (participanteRow) {
                      participanteRow.remove();
                    }
                } else {
                    alert("Erro ao excluir o participante: " + res.message);
                }
            },
            error: function(error) {
                console.error('Erro na solicitação AJAX:', error);
                alert('Erro ao excluir o participante. Tente novamente.');
            }
        });
    }
  }



// excluirparticipante.php