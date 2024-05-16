var idataSelecionados = [];
var participantesSelecionados = [];
var participantesSelecionadosLabel = [];

new MultiSelectTag('participantesadicionado', {
    rounded: true,
    shadow: false,
    placeholder: 'Search',
    tagColor: {
        textColor: '#1C1C1C',
        borderColor: '#4F4F4F',
        bgColor: '#F0F0F0',
    },
    onChange: function(selected_ids, selected_names) {
        // Recuperar o id_ata da página
        var id_ata = document.getElementById("participantesadicionado").getAttribute("data-id-ata");

        // Verificar se o id_ata está definido
        if (id_ata) {
            participantesSelecionados = selected_ids;
            participantesSelecionadosLabel = selected_names;

            // console.log("ID da página:", id_ata);
            console.log("Participantes selecionados:", participantesSelecionados);
            console.log("Nomes dos participantes selecionados:", participantesSelecionadosLabel);
        } else {
            console.error("id_ata não está definido.");
        }
    }
});

var botaoatribuicao = document.getElementById("atribuida");
botaoatribuicao.addEventListener('click', gravaratribuida);

function gravaratribuida() {
    var nomeparticipante = document.getElementById("participantesadicionado").value;

    if (nomeparticipante.trim() === "") {
        Swal.fire({
            title: "Erro no registro",
            text: "Preencha todas as caixas do formulário",
            icon: "error"
        });

        console.log("(X) Puxou a function da modal, mas não preencheu todas as informações");
        return; // Sai da função se os campos não estiverem preenchidos
    }

    Swal.fire({
        title: "Cadastrado com sucesso!",
        text: "Atualize a página e continue a operação",
        icon: "success"
    });

    console.log("(3.1) As informações de participante foram enviadas");

    // Recuperar o id_ata da página
    var id_ata = document.getElementById("participantesadicionado").getAttribute("data-id-ata");
    console.log(id_ata);

    // Verificar se o id_ata está definido
    if (!id_ata) {
        console.error("id_ata não está definido.");
        return; // Sai da função se id_ata não estiver definido
    }

    // Primeira solicitação AJAX para enviarprobanco.php
    $.ajax({
        url: 'enviarprobancoatribuida.php',
        method: 'POST',
        data: {
            id_ata: id_ata, // Envia o id_ata junto com os dados
            participanteatribu: JSON.stringify(participantesSelecionados),
            // tempoestimado: tempoes,
        },
        success: function() {
            console.log("(3) Deu bom! AJAX está enviando");
            console.log(id_ata);
    
            setTimeout(function() {
                window.location.href = 'paghistorico.php';
            }, 1500);
        },
        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        },
    });
    
}
