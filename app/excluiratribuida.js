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
                    // Remover o participante da lista no frontend
                    var participanteElements = document.querySelectorAll("li");
                    participanteElements.forEach(function(element) {
                        if (element.innerText.includes(participante)) {
                            element.remove();
                        }
                    });
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
function excluirDeliberacao(id_ata, deliberacao) {
    if (confirm("Tem certeza de que deseja excluir a deliberação '" + deliberacao + "'?")) {
        $.ajax({
            url: 'excluirparticipante.php',
            method: 'POST',
            data: {
                id_ata: id_ata,
                deliberacao: deliberacao
            },
            success: function(response) {
                var res = JSON.parse(response);
                if (res.success) {
                    console.log("Deliberação excluída com sucesso:", res.message);
                    // Remover a deliberação da lista no frontend
                    $(".list-group-item:contains('" + deliberacao + "')").remove();
                    // Após excluir a deliberação, também exclua os deliberadores
                    excluirDeliberadores(id_ata, deliberacao);
                } else {
                    alert("Erro ao excluir a deliberação: " + res.message);
                }
            },
            error: function(error) {
                console.error('Erro na solicitação AJAX:', error);
                alert('Erro ao excluir a deliberação. Tente novamente.');
            }
        });
    }
}

function excluirDeliberadores(id_ata, deliberacao) {
    $.ajax({
        url: 'excluirDeliberadores.php', // Ajuste o nome do arquivo PHP conforme necessário
        method: 'POST',
        data: {
            id_ata: id_ata,
            deliberacao: deliberacao
        },
        success: function(response) {
            var res = JSON.parse(response);
            if (res.success) {
                console.log("Deliberadores excluídos com sucesso:", res.message);
            } else {
                console.error("Erro ao excluir os deliberadores:", res.message);
            }
        },
        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
            alert('Erro ao excluir os deliberadores. Tente novamente.');
        }
    });
}



// excluirparticipante.php