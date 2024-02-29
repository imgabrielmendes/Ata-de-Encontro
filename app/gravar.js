var gravarinformacoes = document.getElementById("botaosolicitar");
var temaprincipal = document.getElementById("temaprincipal");
var facilitadores = document.getElementById("selecionandofacilitador");


//console.log (facilitadores);

// Tentando puxar o que vai ser executado após o click do botão
    function gravando(temaprincipal){

        // Linkando a variável da função com a id da textarea dentro do index
        var temaprincipal = document.getElementById("temaprincipal");
        var conteudo = temaprincipal.value;

        //console.log(conteudo);

        //trim() usado para verificar se o campo está vazio.
        if (conteudo.trim() === ""){
            window.alert("a textarea tá vazia");
        }   else {
                window.alert("Identifiquei, a text foi: " + conteudo)};
                    console.log("a função 'gravando' foi puxada");
                    
                        return gravando;
        } gravarinformacoes.addEventListener('click', gravando);
    
/////// COMANDO PARA ENVIAR AS INFORMAÇÕES DO BOTÃO PARA O BANCO DE DADOS
        // Quando o botão é clicado
        $('#botaosolicitar').click(function() {

             if (conteudo !=="") {
            // Faz uma solicitação AJAX para o arquivo PHP no servidor
            $.ajax({
                url: 'enviarprobanco.php',
                method: 'POST',
                data: 
                { 
                    conteudo: conteudo
                },

                 success: function(response) {
                    console.log("Deu bom! Ele está enviando para o arquivo")
                    console.log(response);
                },

                error: function(error) {
                    console.error('Erro na solicitação AJAX:', error);
                }
            });
        });
    }
// ---------------------------------------------------------------------

function mostrartema (temaprincipal){
  
}




//temaprincipal - 