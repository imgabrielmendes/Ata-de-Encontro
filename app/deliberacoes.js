console.log();

var participantesAdicionados = [];
var botaocont = document.getElementById('botaocontinuarata');
// var botaohist = document.getElementById('abrirhist');

var itemList = document.getElementById('items');
var filter = document.getElementById('filter');
var addItemButton = document.getElementById('addItemButton');
var mensagemInfo = document.getElementById('infoMessage');

//LINKANDO AS VARÍAVEIS QUE VÃO SER ENVIADO JUNTO COM PARTICIPANTES


addItemButton.addEventListener('click', function() {
    var newItem = document.getElementById('item').value.trim();
    if (newItem === "") {

        Swal.fire({
            title: "Você não adicionou um participante",
            text: "Adicione pelo menos 1 participante para a ata",
            icon: "error"
        });
        
    } else {
        // Remove a caixa de texto existente
        var inputField = document.getElementById('item');
        inputField.parentNode.removeChild(inputField);

        // Cria uma label
        var labelElement = document.createElement('label');
        labelElement.className = 'list-group-item';
        labelElement.textContent = newItem;

        // Adiciona a label à lista
        itemList.appendChild(labelElement);

        // Cria um elemento <select>
        var selectElement = document.createElement('select');
        selectElement.className = 'form-control';

        // Adiciona três opções ao <select>
        var options = ['Option 1', 'Option 2', 'Option 3'];
        options.forEach(function(optionText) {
            var option = document.createElement('option');
            option.value = optionText;
            option.textContent = optionText;
            selectElement.appendChild(option);
        });

        // Adiciona o <select> após a lista
        itemList.parentNode.insertBefore(selectElement, itemList.nextSibling);
    }
});


function addDeliberacoes() {
    console.log(participantesAdicionados);

    $.ajax({
        url: 'registrarfacilitadores.php',
        method: 'POST',
        data: {
            particadd: JSON.stringify(participantesAdicionados)
        },
        success: function(response) {
            console.log("(4.2) Deu bom! AJAX está enviando os participantes");
            console.log(response);

            var ultimoID = response.ultimoID;
            var participantesAdicionados = response.participantesAdicionados;

            var url = 'pagdeliberacoes.php' +
                '?ultimoID=' + encodeURIComponent(ultimoID) +
                '&participantesAdicionados=' + encodeURIComponent(participantesAdicionados);

            window.location.href = url;

            Swal.fire({
                title: "Perfeito!",
                text: "Seus participantes foram registrados",
                icon: "success"
            });

            // Limpa a lista de participantes adicionados
            participantesAdicionados = [];
            atualizarListaParticipantes();
        },
        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        }
    });
}

function atualizarListaParticipantes() {
    itemList.innerHTML = ''; // Limpa a lista visualmente
}

// botaocont.addEventListener('click', addDeliberacoes);
