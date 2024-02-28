var gravarinformacoes = document.getElementById("botaosolicitar");
var temaprincipal = document.getElementById("temaprincipal");
var facilitadores = document.getElementById("selecionandofacilitador");


console.log (facilitadores);

function gravando(){
    alert('A função foi ativada!');
}
gravarinformacoes.addEventListener('click', gravando);

// ---------------------------------------------------------------------

function mostrartema (temaprincipal){
    if (temaprincipal !==""){
        window.document.write("Seu tema principal é" + temaprincipal.innertext);
    } 
    else {
        window.document.write("Funçaõ não encontrada")
    };

    return mostrartema;
}




//temaprincipal - 