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



addItemButton.addEventListener('click', function() {

    var newItem = document.getElementById('item').value.trim();
    
    if (newItem === "") {
        Swal.fire({
            title: "Você não adicionou um participante",
            text: "Adicione pelo menos 1 participante para a ata",
            icon: "error"

        });
    } 
    
    else {

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
                    url: 'registrardeliberadores.php',
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
  function enviarDadosParaServidor() {
    const toastLiveExample = document.getElementById('liveToast');

    // Recuperar o id_ata da página
    var id_ata = document.getElementById("deliberacoes").getAttribute("data-id-ata");

    var deliberador = document.querySelector('.item').value;
    var deliberacoes = document.querySelector('.facilitator-select').value;

    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
        toastBootstrap.show();        

    $.ajax({
        url: 'registrardeliberadores.php',
        method: 'POST',
        data: {
            id_ata: id_ata, 
            deliberaDores: JSON.stringify(deliberadoresSelecionadosNUM), 
            deliberAcoes: deliberacoes, 
            newItem: newItem,
        },

        success: function(response) {
            console.log("(4.2) Deu bom! AJAX está enviando os Deliberadores");
            console.log(response);
            console.log(deliberadoresSelecionadosNUM);
        },

        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        }
    });
}

enviarDadosParaServidor();
  
    var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Excluir deliberação';
        deleteButton.className = 'btn btn-danger';
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


     if (textoprincipal === ""){
        Swal.fire({
            title: "Você não informou um texto principal",
            icon: "error"
        });
    }

    else if( deliberadoresSelecionadosLabel.length === 0 ){

        Swal.fire({
            title: "Preencha o espaço de deliberações",
            icon: "error"
        });
    }

    else {

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

                console.log ("AJAX DO TEXTO FOI PUXADO");
                
                setTimeout(function() {
                    var url = 'paghistorico.php';
                    window.location.href = url;
                }, 1500);
            }            
        });
    }
}