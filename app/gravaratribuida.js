var participantesSelecionados = [];
var participantesSelecionadosLabel = [];

new MultiSelectTag('participantesadicionados1', {
    rounded: true, 
    shadow: false,     
    placeholder: 'Search', 
    tagColor: {
        textColor: '#1C1C1C',
        borderColor: '#4F4F4F',
        bgColor: '#F0F0F0',
    },
    onChange: function(selected_ids, selected_names) {

        participantesSelecionados = selected_ids;
        participantesSelecionadosLabel = selected_names;

        console.log(participantesSelecionados);
        console.log(participantesSelecionadosLabel);
        console.log("select atribuida");
    }
});
var botaoatribuicao= document.getElementById("atribuida");
botaoatribuicao.addEventListener('click', gravaratribuida);


function gravaratribuida(){


    var nomeparticipante = document.getElementById("participantesadicionados1").option;

    if (nomeparticipante.trim() === "")
    {
        
        Swal.fire({
            title: "Erro no registro",
            text: "Preencha todas as caixas do formulário",
            icon: "error"
          });

          console.log ("(X) Puxou a function da modal, mas não preencheu todas as informações")
          console.log ("Que bom, o seu nome é: " + nomeparticipante )
    } 
    
    else {

        Swal.fire({
            title: "Cadastrado com sucesso!",
            text: "Atualize a página e continue a operação",
            icon: "success"
          });

        console.log ("(3.1) As informações de participante foram enviadas");
        // console.log (caixamatricula + " " +caixadenome + " " + caixadeemail)

    }
    if (nomeparticipante !=="")
   
//Primeira solicitação AJAX para enviarprobanco.php
$.ajax({
    url: 'enviarprobancoatribuida.php',
    method: 'POST',
    data: {
        participanteatribu: JSON.stringify(participantesSelecionados),
        
        // tempoestimado: tempoes,
    },
    success: function () {
        console.log("(3) Deu bom! AJAX está enviando");

    },

    error: function (error) {
        console.error('Erro na solicitação AJAX:', error);
        // console.log(facilitadores);
    },
});


}