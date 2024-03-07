
// AS VARIÁVEIS ESTÃO NA ORDEM QUE É SOLICITADA NO FORMULÁRIO
var data, horainic, horaterm,tempoes
    objetivo, local,
    facilitadores,
    temaprincipal,
    gravarinformacoes;

// Pegar inputs 
var gravarinformacoes = document.getElementById("botaosolicitar");

// Pegar caixas do fomulário
//1° LINHAS
var data = document.getElementById("datainicio").value;
var horainic = document.getElementById("horainicio").value;
var horaterm = document.getElementById("horaterm").value;
var tempoes = document.getElementById("iddoinput"); //FALTANDO

// 2° LINHAS
var objetivomarc = document.getElementsByName("objetivo"); // MUDAR
var objetivoSelecionado = null;

var local = document.getElementById("iddolocal"); //FALTANDO

//3° LINHA
var facilitadores = document.getElementById("selecionandofacilitador");

// 4° LINHA
var temaprincipal = document.getElementById("temaprincipal");

function gravando() {

    // Linkando a variável da função com a id da textarea dentro do index
    var conteudo = temaprincipal.value;
    var data = document.getElementById("datainicio").value;

// ------------------------------------------------------------------------------------------
    // BOTÕES DE OBJETIVO
    //CONDIÇÃO PARA AS OPÇÕES DE OBJETIVOS
    for (var op = 0; op < objetivomarc.length; op++) {
        if (objetivomarc[op].checked) {
            objetivoSelecionado = objetivomarc[op].value;
            break;
        }
    }

// ------------------------------------------------------------------------------------------

    // CRIANDO CONDIÇÕES PARA QUE SÓ ENVIE PARA O AJAX SE TUDO ESTIVER PREENCHIDO
    // trim() usado para verificar se o campo está vazio
    if (data.trim() === "" || horainic.trim() === ""|| horaterm.trim()==="" || tempoes.trim()==="" || objetivoSelecionado.trim() === "" || local.trim()==="" || facilitadores.trim() ==="" || conteudo.trim() === "") 
            {   
        Swal.fire({
            title: "Erro no registro",
            text: "Preencha todas as caixas obrigatórias",
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
var caixadenome, caixadeemail;

var caixadenome = document.getElementById("caixanome").value;
var caixadeemail = document.getElementById("caixadeemail").value;

var botaoemail = document.getElementById("registraremail");

function gravaremail(){
   
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
    
// Botões
gravarinformacoes.addEventListener('click', gravando);
botaoemail.addEventListener('click', gravaremail);



