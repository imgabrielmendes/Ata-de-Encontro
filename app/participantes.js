console.log();

var participantesAdicionados = [];
var botaocont = document.getElementById('botaocontinuarata');
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
        
        var li = document.createElement('li');
        li.className = 'list-group-item';
        li.appendChild(document.createTextNode(newItem));

        var deleteBtn = document.createElement('button');
        deleteBtn.className = 'col-3 btn btn-danger float-left delete';
        deleteBtn.appendChild(document.createTextNode('X'));

        deleteBtn.addEventListener('click', function() {
            if (confirm('Tem certeza?')) {
                itemList.removeChild(li);
                var index = participantesAdicionados.indexOf(newItem);
                if (index !== -1) {
                    participantesAdicionados.splice(index, 1);
                }
            }
        });

        li.appendChild(deleteBtn);
        itemList.appendChild(li);

        participantesAdicionados.push(newItem);
        document.getElementById('item').value = '';
    }
});

function addDeliberacoes() {
    console.log("adadasdasdsad");
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
            console.log(participantesAdicionados);

            Swal.fire({
                title: "Perfeito!",
                text: "Seus participantes foram registrados",
                icon: "success"
            });

            window.location.href = 'pagdeliberacoes.php';

            participantesAdicionados = [];
            atualizarListaParticipantes();

        },
        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        }
    });
}

// Função para limpar visualmente a lista de participantes
function atualizarListaParticipantes() {
    itemList.innerHTML = ''; // Limpa a lista visualmente
}

botaocont.addEventListener('click', addDeliberacoes);

