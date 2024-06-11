var deliberadoresSelecionadosNUM = [];
var deliberadoresSelecionadosLabel = [];

new MultiSelectTag('deliberador', {
    rounded: true, 
    shadow: false,     
    placeholder: 'Search', 
    tagColor: {
        textColor: '#1C1C1C',
        borderColor: '#4F4F4F',
        bgColor: '#F0F0F0',
    },
    onChange: function(selected_ids, selected_names) {

        deliberadoresSelecionadosNUM = selected_ids;
        deliberadoresSelecionadosLabel = selected_names;

        console.log(deliberadoresSelecionadosNUM);
        console.log(deliberadoresSelecionadosLabel);
    }
});

document.getElementById('addItemButton').addEventListener('click', function() {
    var newItem = document.querySelector('.item').value.trim();
    var deliberadoresSelecionados = document.querySelector('.facilitator-select').selectedOptions;
    var deliberadoresSelecionadosLabel = Array.from(deliberadoresSelecionados).map(option => option.label);
    var deliberadoresSelecionadosNUM = Array.from(deliberadoresSelecionados).map(option => option.value);
    var idAata = document.querySelector('.item').getAttribute('data-id-ata');

    if (newItem === "" && deliberadoresSelecionadosLabel.length === 0) {
        Swal.fire({
            title: "Preencha os campos de deliberação",
            icon: "error"
        });
        return;
    } else {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'enviardeli.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if(xhr.readyState == 4 && xhr.status == 200) {

            location.reload();
            var toastLiveExample = document.getElementById('liveToast2');
           
            } else if (xhr.readyState == 4) {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao inserir a deliberação.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 2500
                }).then((result) => {
                    if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {

const toastLiveExample = document.getElementById('liveToast2');
const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
toastBootstrap.show();
                    }

                });
            }
        }
        xhr.send('id_ata=' + encodeURIComponent(idAata) + '&deliberaDores=' + JSON.stringify(deliberadoresSelecionadosNUM) + '&newItem=' + encodeURIComponent(newItem));
        }
    });


var participantesAdicionados = [];

var itemList = document.getElementById('items');
var filter = document.getElementById('filter');
var addItemButton = document.getElementById('addItemButton');
var mensagemInfo = document.getElementById('infoMessage');



//LINKANDO AS VARÍAVEIS QUE VÃO SER ENVIADO JUNTO COM PARTICIPANTES
// Declare uma variável de contagem
// Declare uma variável de contagem global

// Adicione o evento de clique para o botão 'addItemButton'
addItemButton.addEventListener('click', function() {
    var newItem = document.getElementById('item').value.trim();
    
    // Se o campo estiver vazio, exiba um alerta
    if (newItem === "") {
        Swal.fire({
            title: "Você não adicionou um participante",
            text: "Adicione pelo menos 1 participante para a ata",
            icon: "error"
        });
    } else {


        var inputField = document.getElementById('item');
        inputField.parentNode.removeChild(inputField);

        var textListItemDiv = document.createElement('div');
        textListItemDiv.className = 'list-group-item';
        textListItemDiv.textContent = newItem;

        itemList.appendChild(textListItemDiv);

        var textLabelElement = document.createElement('label');
        textLabelElement.textContent = newItem;
        textListItemDiv.appendChild(textLabelElement);

        selectedDeliberators.forEach(function(deliberator) {
            var deliberatorDiv = document.createElement('div');
            deliberatorDiv.className = 'form-control bg-body-secondary border rounded';
            var deliberatorLabel = document.createElement('label');
            
            deliberatorLabel.textContent = deliberator;
            deliberatorDiv.appendChild(deliberatorLabel);
            itemList.appendChild(deliberatorDiv);
        });

        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Excluir';
        deleteButton.className = 'btn btn-danger btn-sm ml-2 delete-item';
        deleteButton.addEventListener('click', function() {
            itemList.removeChild(textListItemDiv);
            selectedDeliberators.forEach(function(deliberator) {
                var deliberatorDiv = document.querySelector('.form-control.bg-body-secondary.border.rounded:contains(' + deliberator + ')');
                itemList.removeChild(deliberatorDiv);
            });
            deleteButton.remove(); 
        });

        // Cria e adiciona a label "Deliberação" + contador
        var deliberationLabel = document.createElement('label');
        textListItemDiv.appendChild(deliberationLabel);
    }
});

document.getElementById('addItemButton').addEventListener('click', function() {
    var newItem = document.querySelector('.item').value.trim();
    
    if (newItem === "" && deliberadoresSelecionadosLabel.length === 0) {
        Swal.fire({
            title: "Preencha os campos de deliberação",
            icon: "error"
        });
        return;
    } else if (newItem === "") {
        Swal.fire({
            title: "Você não adicionou uma deliberação",
            text: "Adicione pelo menos 1 deliberação para a ata",
            icon: "error"
        });
        return;

    } else if (deliberadoresSelecionadosLabel.length === 0) {
        Swal.fire({
            title: "Você não adicionou um deliberador",
            text: "Adicione pelo menos 1 deliberador para a deliberação",
            icon: "error"
        });
        return;

    } else {

        // Incrementa o contador de ações bem-sucedidas
        const toastLiveExample = document.getElementById('liveToast')
        var deliberador = document.querySelector('.item').value;
        var deliberacoes = document.querySelector('.facilitator-select').value;

        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
        toastBootstrap.show();        
        $.ajax({
            url: 'registrarpagdeliberacoes.php',
            method: 'POST',
            data: {
                deliberaDores: JSON.stringify(deliberadoresSelecionadosNUM), 
                deliberAcoes: deliberacoes, 
                newItem: newItem,
            },
            success: function(response) {
                console.log(response);
                console.log(deliberadoresSelecionadosNUM);
            },
            error: function(error) {
                console.error('Erro na solicitação AJAX:', error);
            }
        });

    }
});



var botaohist = document.getElementById('finalizarAtaBtn');
botaohist.addEventListener('click', irparaHist);

function irparaHist() {
    console.log("Ok, a função de ir para histórico e registrar texto foi puxada");

    var textoprincipal = document.getElementById('textoprinc').value;

        Swal.fire({
            title: "Confirmação",
            text: "Deseja Finalizar encontro ou continuar modificando?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Finalizar",
            cancelButtonText: "Continuar"
        }).then((result) => {

            if (result.isConfirmed) {

                Swal.fire({
                    title: "Perfeito!",
                    text: "Seu texto principal foi Adicionado!",
                    icon: "success",
                });

                setTimeout(function() {
                    var url = 'paghistorico.php';
                    window.location.href = url;
                }, 1500);

                
            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        });
    
}


