console.log();

var participantesAdicionados = [];
var botaohist = document.getElementById('abrirhist');

var itemList = document.getElementById('items');
var filter = document.getElementById('filter');
var addItemButton = document.getElementById('addItemButton');
var mensagemInfo = document.getElementById('infoMessage');

//LINKANDO AS VARÍAVEIS QUE VÃO SER ENVIADO JUNTO COM PARTICIPANTES

// Adiciona um evento de clique ao botão "addItemButton"
addItemButton.addEventListener('click', function() {
    var newItem = document.getElementById('item').value.trim();
    
    // Obtém o elemento <select>
    var selectElement = document.getElementById('selectFacilitators');
    // Obtém o valor selecionado
    var selectedFacilitator = selectElement.value;
    
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

        // Cria uma div para a list-group-item do texto digitado
        var textListItemDiv = document.createElement('div');
        textListItemDiv.className = 'list-group-item';

        // Cria uma label para o texto digitado
        var textLabelElement = document.createElement('label');
        textLabelElement.textContent = newItem;
        textListItemDiv.appendChild(textLabelElement);

        // Adiciona a div da list-group-item de texto à lista
        itemList.appendChild(textListItemDiv);

        // Cria uma div para a list-group-item do facilitador selecionado
        var facilitatorListItemDiv = document.createElement('div');
        facilitatorListItemDiv.className = 'form-control bg-body-secondary border rounded';

        // Cria uma label para o facilitador selecionado
        var facilitatorLabelElement = document.createElement('label');
        facilitatorLabelElement.textContent = selectedFacilitator;
        facilitatorListItemDiv.appendChild(facilitatorLabelElement);

        // Adiciona a div da list-group-item de facilitador à lista
        itemList.appendChild(facilitatorListItemDiv);
    }
});

document.getElementById('addItemButton').addEventListener('click', function() {
    // Captura o texto digitado e o facilitador selecionado
    var newItem = document.querySelector('.item').value.trim();
    var selectedFacilitator = document.querySelector('.facilitator-select').value;

    // Verifica se o texto e o facilitador foram preenchidos
    if (newItem === "" || selectedFacilitator === "") {
        alert("Por favor, preencha todos os campos.");
        return;
    }

    //Div para a list-group-item do texto digitado
    var textListItemDiv = document.createElement('div');
    textListItemDiv.className = 'black text-break form-control border rounded';
    textListItemDiv.textContent = newItem;

    //Div para a list-group-item do facilitador selecionado
    var facilitatorListItemDiv = document.createElement('div');
    facilitatorListItemDiv.className = 'form-control bg-body-secondary border rounded';
    facilitatorListItemDiv.textContent = selectedFacilitator;

    // Juntar as Divs
    var itemList = document.getElementById('inputContainer');
    itemList.appendChild(textListItemDiv);
    itemList.appendChild(facilitatorListItemDiv);

    // Limpa a caixa de texto
    document.querySelector('.item').value = "";
});

botaohist.addEventListener('click', addDeliberacoes);

function addDeliberacoes() {
    var deliberador = document.querySelector('.item').value;
    var deliberacoes = document.querySelector('.facilitator-select').value;

    $.ajax({
        url: 'registrardeliberadores.php',
        method: 'POST',
        data: {
           deliberaDores: deliberador, 
           deliberAcoes: deliberacoes, 
        },
        success: function(response) {
            console.log("(4.2) Deu bom! AJAX está enviando os Deliberadores");
            console.log(response);

            console.log(deliberacoes);
            console.log(deliberador);

            Swal.fire({
                title: "Perfeito!",
                text: "Seus Deliberadores foram registrados",
                icon: "success",
            });

            // Definindo o redirecionamento após 1.5 segundos
            setTimeout(function() {
                var url = 'paghistorico.php';
                window.location.href = url;
            }, 1500);
        },
        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        }
    });
}

botaohist.addEventListener('click', addDeliberacoes);