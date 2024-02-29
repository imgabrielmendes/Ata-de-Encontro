var gravarinformacoes = document.getElementById("botaosolicitar");
var temaprincipal = document.getElementById("temaprincipal");
var facilitadores = document.getElementById("selecionandofacilitador");
var conteudo; 



function gravando() {
    // Linkando a variável da função com a id da textarea dentro do index
    var temaprincipal = document.getElementById("temaprincipal");
    conteudo = temaprincipal.value;

    // trim() usado para verificar se o campo está vazio.
    if (conteudo.trim() === "") {
        window.alert("A textarea está vazia");
    } else {
        window.alert("Identifiquei, o texto foi: " + conteudo);
        console.log("(1) A function 'gravando()' foi chamada");
   

// CÓDIGO AJAX QUE VAI ENVIAR AS INFORMAÇÕES DAS FUNCTION PARA O BANCO DE DADOS

        if (conteudo !== "") {

            $.ajax({
                url: 'enviarprobanco.php',
                method: 'POST',
                data: { informacao: "enviar"},


                success: function(response) {
                    console.log("(2) Deu bom! AJAX está enviando");
                    console.log(response);
                },
                error: function(error) {
                    console.error('Erro na solicitação AJAX:', error);
                }
            });
        }
    }
}

// Adiciona um ouvinte de evento ao botão
gravarinformacoes.addEventListener('click', gravando);
