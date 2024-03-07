var adddeli = document.getElementById("addDeliberacoes");
novadel.addEventListener('submit' , addDeliberacoes);

function addDeliberacoes(){

var adddeli = document.getElementById("addelibe");
var novadel = document.getElementById("novadeliber");


adddeli.addEventListener('submit', function(){

    console.log ("Botão foi selecionado");

    document.createElement("novadeliber");
    console.log(novadel);

    // $.ajax({
    //     url: 'addfacilidar',
    //     method: 'POST',
    //     data: {
    //         //
    //         //
    //         //
    //     },
    // })
});  
}

adddeli.addEventListener('click', addDeliberacoes);
