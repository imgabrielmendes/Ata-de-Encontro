var gravarinformacoes = document.getElementById("botaosolicitar");
var temaprincipal = document.getElementById("temaprincipal");
var facilitadores = document.getElementById("selecionandofacilitador");


//console.log (facilitadores);

// Tentando puxar o que vai ser executado após o click do botão
    function gravando(temaprincipal){

        // Linkando a variável da função com a id da textarea dentro do index
        var temaprincipal = document.getElementById("temaprincipal").value;
        
        //trim() usado para verificar se o campo está vazio.
        if (temaprincipal.trim() === ""){

            window.alert("a textarea tá vazia");

        }   else {
                window.alert("Identifiquei, a text foi:" . temaprincipal)};

        console.log("a função 'gravando' foi puxada");

        return gravando;
        
    } gravarinformacoes.addEventListener('click', gravando);

// ---------------------------------------------------------------------

function mostrartema (temaprincipal){
  
}




//temaprincipal - 