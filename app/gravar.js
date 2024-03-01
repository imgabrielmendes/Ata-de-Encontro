// Pegar inputs 
var gravarinformacoes = document.getElementById("botaosolicitar");
var temaprincipal = document.getElementById("temaprincipal");
var data = document.getElementById("datainicio").value;


// Pegar seletores
var facilitadores = document.getElementById("selecionandofacilitador");
var horainic = document.getElementById("horainicio").value;
var horaterm = document.getElementById("horaterm");



function gravando() {
    // Linkando a variável da função com a id da textarea dentro do index
    var temaprincipal = document.getElementById("temaprincipal");
    conteudo = temaprincipal.value;

    var horainic = document.getElementById("horainicio").value;
    var data = document.getElementById("datainicio").value;
    //console.log(data);


    // CRIANDO CONDIÇÕES PARA QUE SÓ ENVIE PARA O AJAX SE TUDO ESTIVER PREENCHIDO
    // trim() usado para verificar se o campo está vazio.

    if (conteudo.trim() === "") {

        window.alert("A textarea está vazia");
    } 

    if (horainic.trim() === "") {

        window.alert("O hórario de inicio está vazio");

    } 

    if (data.trim() === "") {

        window.alert("Você não inseriu uma data para a ata");

    } 
        else {
        window.alert("Identifiquei, o texto foi: <br>" + conteudo + " e seu horário é: <br>" + horainic + " e seu horário é:<br>" + data);

        console.log("(1) A function 'gravando()' foi chamada");
   

// CÓDIGO AJAX QUE VAI ENVIAR AS INFORMAÇÕES DAS FUNCTION PARA O BANCO DE DADOS

        if (conteudo !== "" && horainic !=="" && data !=="") {

            $.ajax({
                url: 'enviarprobanco.php',
                method: 'POST',
                data: {                        
                        texto: conteudo,
                        horai: horainic,
                        datainic: data
                      },


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
