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
            if (response = true){
                location.reload();

                const toastLiveExample = document.getElementById('liveToast2');
                var reset = location.reload();
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
                toastBootstrap.show();

                
            }
        },

        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        }
    });
}

