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


var botaohist = document.getElementById('abrirhist');
botaohist.addEventListener('click', irparaHist);

function irparaHist() {
    console.log("Ok, a função de ir para histórico e registrar texto foi puxada");

    var textoprincipal = document.getElementById('textoprinc').value;
    console.log(textoprincipal);

    if (textoprincipal === "") {
        Swal.fire({
            title: "Você não informou um texto principal",
            icon: "error"
        });
    } else if (deliberadoresSelecionadosLabel.length === 0) {
        Swal.fire({
            title: "Preencha o espaço de deliberações",
            icon: "error"
        });
    } else {
        Swal.fire({
            title: "Perfeito!",
            text: "Seus Deliberadores foram registrados",
            icon: "success",
        });

        $.ajax({
            url: 'textprincbanco.php',
            method: 'POST',
            data: {
                textoprincipal1: textoprincipal,
            },
            success: function() {
                console.log("AJAX DO TEXTO FOI PUXADO");
                // Adicione aqui qualquer ação adicional que você queira realizar após o sucesso da requisição AJAX
            },
            error: function(error) {
                console.error('Erro na solicitação AJAX:', error);
            }
        });
    }
}
var botaoatribuicao = document.getElementById("atribuida");
botaoatribuicao.addEventListener('click', gravaratribuida);

function gravaratribuida() {
    // Recuperar o id_ata da página
    var id_ata = document.getElementById("participantesadicionado").getAttribute("data-id-ata");
    console.log(id_ata);

    // Verificar se o id_ata está definido
    if (!id_ata) {
        console.error("id_ata não está definido.");
        return; // Sai da função se id_ata não estiver definido
    }

    // Exibir popup de confirmação
    Swal.fire({
        title: "Confirmação",
        text: "Tem certeza que deseja finalizar o encontro?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Sim"
        
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'enviarprobancoatribuida.php',
                method: 'POST',
                data: {
                    id_ata: id_ata, 
                    participanteatribu: JSON.stringify(participantesSelecionados),

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
            Swal.fire({
                title: "Cadastrado com sucesso!",
                text: "Atualize a página e continue a operação",
                icon: "success"
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("addForm").addEventListener("submit", function(event) {
        event.preventDefault(); 
        var select = document.getElementById("participantesadicionado");
        var selectedOptions = select.selectedOptions;
        for (var i = 0; i < selectedOptions.length; i++) {
            var selectedOption = selectedOptions[i];
            var participante = selectedOption.textContent.trim();
            var participanteId = selectedOption.value;
            if (!participanteJaAdicionado(participante)) {
                adicionarParticipanteAoLabel(participante);
                selectedOption.remove(); 
            }
        }
    });
});
    $(document).ready(function() {
        $('#participantesadicionado').change(function() {
            var selected_ids = [];
            var selected_names = [];
            $('#participantesadicionado option:selected').each(function() {
                selected_ids.push($(this).val());
                selected_names.push($(this).text());
            });
            console.log(selected_ids);
            console.log(selected_names);
        });
    });
    function participanteJaAdicionado(participante) {
        var label = document.getElementById("participantesLabel");
        return label.textContent.includes(participante);
    }
    function adicionarParticipanteAoLabel(participante) {
        var label = document.getElementById("participantesLabel");
        var participanteItem = document.createElement("span");
        participanteItem.textContent = participante;
        participanteItem.classList.add("badge", "bg-secondary", "me-1");
        label.appendChild(participanteItem);
    }
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("addForm").addEventListener("submit", function(event) {
            event.preventDefault(); 
            var select = document.getElementById("participantesadicionado");
            var selectedOptions = select.selectedOptions;
            for (var i = 0; i < selectedOptions.length; i++) {
                var selectedOption = selectedOptions[i];
                var participante = selectedOption.textContent.trim();
                var participanteId = selectedOption.value;
                if (!participanteJaAdicionado(participante)) {
                    adicionarParticipanteAoLabel(participante);
                    selectedOption.remove(); 
                }
            }
        });
        $('#participantesadicionado').change(function() {
            var selected_ids = [];
            var selected_names = [];
            $('#participantesadicionado option:selected').each(function() {
                selected_ids.push($(this).val());
                selected_names.push($(this).text());
            });
    
            console.log(selected_ids);
            console.log(selected_names);
        });
    });
    function participanteJaAdicionado(participante) {
        var label = document.getElementById("participantesLabel");
        return label.textContent.includes(participante);
    }
    function adicionarParticipanteAoLabel(participante) {
        var label = document.getElementById("participantesLabel");
        var participanteItem = document.createElement("span");
        participanteItem.textContent = participante;
        participanteItem.classList.add("badge", "bg-secondary", "me-1");
        label.appendChild(participanteItem);
    }