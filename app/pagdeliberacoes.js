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

addItemButton.addEventListener('click', function() {
    var newItem = document.getElementById('item').value.trim();
    
    // Obtém o elemento <select>
    // var selectElement = document.getElementById('selectFacilitators');
    // Obtém o valor selecionado
    // var selectedFacilitator = document.querySelector('.facilitator-select').value;
    
    if (newItem === "") {
        Swal.fire({
            title: "Você não adicionou um participante",
            text: "Adicione pelo menos 1 participante para a ata",
            icon: "error"

        });
    } 
    
    else {

        // Remove a caixa de texto existente
        var inputField = document.getElementById('item');
        inputField.parentNode.removeChild(inputField);

        // Cria uma div para a list-group-item do texto digitado
        var textListItemDiv = document.createElement('div');
        textListItemDiv.className = 'list-group-item';
        textListItemDiv.textContent = newItem;

        itemList.appendChild(textListItemDiv);

        // Cria uma label para o texto digitado
        var textLabelElement = document.createElement('label');
        textLabelElement.textContent = newItem;
        textListItemDiv.appendChild(textLabelElement);

        // Adiciona os deliberadores selecionados à lista
        selectedDeliberators.forEach(function(deliberator) {

            var deliberatorDiv = document.createElement('div');
            deliberatorDiv.className = 'form-control bg-body-secondary border rounded';
            var deliberatorLabel = document.createElement('label');
            
            deliberatorLabel.textContent = deliberator;
            deliberatorDiv.appendChild(deliberatorLabel);
            itemList.appendChild(deliberatorDiv);



        });

        // Adiciona um botão de exclusão para o item
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
    }

    else if (newItem === ""){

        Swal.fire({
            title: "Você não adicionou uma deliberação",
            text: "Adicione pelo menos 1 deliberação para a ata",
            icon: "error"
        });
        
        return;
    }

    else if (deliberadoresSelecionadosLabel.length === 0) {

        Swal.fire({
          title: "Você não adicionou um deliberador",
          text: "Adicione pelo menos 1 deliberador para a deliberação",
          icon: "error"
      });
      
      return;
  }
    else {

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
    }
            
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
            deleteButton.remove(); 

            const toastLiveExample = document.getElementById('liveToast2');
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
                toastBootstrap.show();

            });

    var textListItemDiv = document.createElement('div');
        textListItemDiv.className = 'black text-break form-control border rounded';
        textListItemDiv.textContent = newItem;

    var facilitatorListItemDiv = document.createElement('div');
        facilitatorListItemDiv.className = 'form-control bg-body-secondary border rounded';
        facilitatorListItemDiv.textContent = deliberadoresSelecionadosLabel;

    var itemList = document.getElementById('inputContainer');
        itemList.appendChild(textListItemDiv);
        itemList.appendChild(facilitatorListItemDiv);
        itemList.appendChild(deleteButton);

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
            text: "Deseja continuar modificando ou ir para o histórico?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ir para o histórico",
            cancelButtonText: "Continuar modificando",
            // Adiciona o terceiro botão ao footer
            footer: "<button id='updateAndContinueBtn' class='btn btn-info'>Atualizar e continuar</button>"
        }).then((result) => {
            if (result.isConfirmed) {
                // Se o usuário escolher ir para o histórico, exibe mensagem de sucesso
                Swal.fire({
                    title: "Perfeito!",
                    text: "Seus Deliberadores foram registrados",
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
                        console.log ("AJAX DO TEXTO FOI PUXADO");
                        
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
            } else if (result.isDismissed) {
                // Se o usuário escolher continuar modificando, não faz nada
            }
        });

        // Adiciona um event listener para o botão "Atualizar e continuar"
        document.getElementById('updateAndContinueBtn').addEventListener('click', function() {
            // Coloque aqui a lógica para atualizar e continuar na página
            console.log("Atualizando e continuando na página...");
        });
    }
}


