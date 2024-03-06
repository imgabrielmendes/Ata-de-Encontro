

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
    var conteudo = temaprincipal.value;

    var horainic = document.getElementById("horainicio").value;
    var data = document.getElementById("datainicio").value;

    // BOTÕES DE OBJETIVO
    var objetivomarc = document.getElementsByName("objetivo");
    var objetivoSelecionado = null;

    //CONDIÇÃO PARA AS OPÇÕES DE OBJETIVOS
    for (var op = 0; op < objetivomarc.length; op++) {
        if (objetivomarc[op].checked) {
            objetivoSelecionado = objetivomarc[op].value;
            break;
        }
    }

    // CRIANDO CONDIÇÕES PARA QUE SÓ ENVIE PARA O AJAX SE TUDO ESTIVER PREENCHIDO
    // trim() usado para verificar se o campo está vazio.
    if (conteudo.trim() === ""||horainic.trim() === ""||data.trim() === ""||objetivoSelecionado.trim() === "") 
    
            {   
        Swal.fire({
            title: "Erro no registro",
            text: "Preencha todas as caixas do formulário",
            icon: "error"
          }); 
        
          console.log("(X) Puxou a function, mas está faltando informações");
        }
        
    else {

        Swal.fire({
            title: "Ata registrada com sucesso!",
            icon: "success"
          });

        window.alert("Identifiquei, o texto foi: " + conteudo + ", o objetivo é: " + objetivoSelecionado + ", o horário é: " + horainic + " e a data é: " + data);

        console.log("(1) A função 'gravando()' foi chamada");
        console.log (objetivoSelecionado);

        // CÓDIGO AJAX QUE VAI ENVIAR AS INFORMAÇÕES DAS FUNCTION PARA O BANCO DE DADOS
        if (conteudo !== "" && horainic !=="" && data !=="" && objetivoSelecionado !=="") 

        $.ajax({
            url: 'enviarprobanco.php',
            method: 'POST',
            data: {
                texto: conteudo,
                horai: horainic,
                datainic: data,
                objetivos: objetivoSelecionado,
            },

            success: function (response) {

                console.log("(2) Deu bom! AJAX está enviando");
                console.log(response);
            },
            error: function (error) {
                console.error('Erro na solicitação AJAX:', error);
            }
        });
    }
}

///------------BOTÃO DE REGISTRAR EMAIL DENTRO DA MODAL------------------------------
var botaoemail = document.getElementById("registraremail");

function gravaremail(){

    var caixadenome = document.getElementById("caixanome").value;
    var caixadeemail = document.getElementById("caixadeemail").value;
   
    if (caixadenome.trim() ==="" || caixadeemail.trim() ==="")
    {
        
        Swal.fire({
            title: "Erro no registro",
            text: "Preencha todas as caixas do formulário",
            icon: "error"
          });
          console.log ("(X) Puxou a function da modal, mas não preencheu todas as informações")
    } 

    //if (caixadeemail ===""){window.alert ("Você não informou o seu nome completo");} 
    
    else {

        Swal.fire({
            title: "Cadastrado com sucesso!",
            text: "Atualize a página e continue a operação",
            icon: "success"
          });

        window.alert ("Que bom, o seu nome é: " + caixadenome + " seu email é " + caixadeemail);
        console.log ("(3.1) As informações de email foram enviadas");

        if (caixadenome !=="" && caixadeemail !=="") 

        $.ajax({
            url: 'registrarfacilitadores.php',
            method: 'POST',
            data: {
               caixaname: caixadenome,
               caixaemail: caixadeemail
            },

            success: function (response) {
                console.log("(3.2) Deu bom! AJAX está enviando");
                console.log(response);
            },
            error: function (error) {
                console.error('Erro na solicitação AJAX:', error);
            }
        });
    }

    }
    
//    

var adddeli =document.getElementById("iddobotao").addEventListener('click', deliberacoes);

function deliberacoes(){

    var adddeli = document.getElementById("iddobotãoadd");
    adddeli.addEventListener('click', function(){

        console.log ("Botão foi selecionado")
        $.ajax({
            url: 'addfacilidar',
            method: 'POST',
            data: {
                //
                //
                //
            },
        })
    });  
}

// Botões
gravarinformacoes.addEventListener('click', gravando);
botaoemail.addEventListener('click', gravaremail);



