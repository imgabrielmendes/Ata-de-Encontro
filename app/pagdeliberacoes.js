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

console.log();

var participantesAdicionados = [];

var itemList = document.getElementById('items');
var filter = document.getElementById('filter');
var addItemButton = document.getElementById('addItemButton');
var mensagemInfo = document.getElementById('infoMessage');



//LINKANDO AS VARÍAVEIS QUE VÃO SER ENVIADO JUNTO COM PARTICIPANTES
// Declare uma variável de contagem
// Declare uma variável de contagem global
var acoesBemSucedidas = 0;

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

        acoesBemSucedidas++;

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

        itemList.appendChild(deleteButton);

        // Cria e adiciona a label "Deliberação" + contador
        var deliberationLabel = document.createElement('label');
        deliberationLabel.textContent = "<b>Deliberação N°" + acoesBemSucedidas + "</b>";
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
        acoesBemSucedidas++;

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
                console.log("(4.2) Deu bom! AJAX está enviando os Deliberadores");
                console.log(response);
                console.log("AAAAAAAAAAAAA");
                console.log(deliberadoresSelecionadosNUM);
            },
            error: function(error) {
                console.error('Erro na solicitação AJAX:', error);
            }
        });

        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'x';
        deleteButton.className = 'col btn btn-danger btn-mt mt-2';
        deleteButton.style.right = '9px'; 
        deleteButton.style.top = '0px'; 
        deleteButton.style.width = '37px'; 
        deleteButton.style.height = '37px'; 

        deleteButton.addEventListener('click', function() {  
            itemList.removeChild(textListItemDiv);
            itemList.removeChild(facilitatorListItemDiv);
            itemList.removeChild(deliberationLabel);
            deleteButton.remove(); 

            const toastLiveExample = document.getElementById('liveToast2');
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
            toastBootstrap.show();
        });

        

        var textListItemDiv = document.createElement('div');
        textListItemDiv.className = 'black text-break form-control border rounded';
        textListItemDiv.textContent = newItem;

        // Cria e adiciona a label "Deliberação" + contador
        var deliberationLabel = document.createElement('label');
        deliberationLabel.className = "d-flex justify-content-start mb-2 badge rounded-pill text-bg-success opacity-75";
        deliberationLabel.style.marginRight = "auto";
        deliberationLabel.textContent = "Deliberação N°" + acoesBemSucedidas;
        
        // textListItemDiv.appendChild(deliberationLabel);

        var facilitatorListItemDiv = document.createElement('div');
        facilitatorListItemDiv.className = 'form-control bg-body-secondary border rounded';
        facilitatorListItemDiv.textContent = deliberadoresSelecionadosLabel;

        var itemList = document.getElementById('inputContainer');
        itemList.appendChild(deliberationLabel);
        itemList.appendChild(textListItemDiv);
        itemList.appendChild(facilitatorListItemDiv);
        itemList.appendChild(deleteButton);

    }
});



var botaohist = document.getElementById('abrirhist');
botaohist.addEventListener('click', irparaHist);

function irparaHist() {
    console.log("Ok, a função de ir para histórico e registrar texto foi puxada");

    var textoprincipal = document.getElementById('textoprinc').value;
    console.log(textoprincipal);

    // Verifica se pelo menos uma das informações está preenchida
    if (textoprincipal === "" && deliberadoresSelecionadosLabel.length === 0) {
        Swal.fire({
            title: "Preencha pelo menos uma informação",
            text: "Adicione pelo menos 1 texto principal ou 1 deliberador para a deliberação",
            icon: "error"
        });
    } else {
        // Se pelo menos uma das informações estiver preenchida, solicita confirmação do usuário
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
                // Se o usuário escolher ir para o histórico, exibe mensagem de sucesso
                Swal.fire({
                    title: "Perfeito!",
                    text: "Seu texto principal foi Adicionado!",
                    icon: "success",
                });

                // Envia os dados para o servidor
                $.ajax({
                    url: 'registrartextop.php',
                    method: 'POST',
                    data: {
                        textoprincipal1: textoprincipal,
                        // Enviar deliberadores selecionados junto com os dados
                        deliberadoresSelecionados: JSON.stringify(deliberadoresSelecionadosLabel)
                    },
                    success: function() {
                        console.log("AJAX DO TEXTO FOI PUXADO");
                        
                        // Redireciona para a página de histórico após o envio bem-sucedido
                        setTimeout(function() {
                            var url = 'paghistorico.php';
                            window.location.href = url;
                        }, 1500);
                    },
                    error: function(error) {
                        console.error('Erro na solicitação AJAX:', error);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Se o usuário escolher continuar modificando, envia os dados para o servidor sem redirecionar
                $.ajax({
                    url: 'registrartextop.php',
                    method: 'POST',
                    data: {
                        textoprincipal1: textoprincipal,
                        deliberadoresSelecionados: JSON.stringify(deliberadoresSelecionadosLabel)
                    },
                    success: function() {
                        console.log("AJAX DO TEXTO FOI PUXADO - Continuar modificando");
                        // Exibe o toast de sucesso
                        var toastLiveExample = document.getElementById('liveToast3');
                        var toast = new bootstrap.Toast(toastLiveExample);
                        toast.show();
                    },
                    error: function(error) {
                        console.error('Erro na solicitação AJAX:', error);
                    }
                });
            }
        });
    }
}


