

// Pegar inputs 
var gravarinformacoes = document.getElementById("botaoregistrar");

// Pegar caixas do fomulário

// PEGAR A ID
// var linhaSelecionada = document.querySelector('#suaTabela tr.selecionado');
// var idDaLinha = linhaSelecionada.getAttribute('id');


//1° LINHAS
var data = document.getElementById("datainicio");
var horainicio = document.getElementById("horainicio").value;
var horaterm = document.getElementById("horaterm").value;
var tempoes = document.getElementById("tempoestim").value;

// 2° LINHAS
var objetivomarc = document.getElementsByName("objetivo");
var objetivoSelecionado = null;

//3° LINHA
var facilitadores = document.getElementById("selecionandofacilitador").value;

// 4° LINHA
var temaprincipal = document.getElementById("temaprincipal");

function gravando() {

    // var idDaLinha = response.idDaLinha; // Puxando a id

    var data = document.getElementById("datainicio").value;
    var horainicio = document.getElementById("horainicio").value;
    var horaterm = document.getElementById("horaterm").value;
    var tempoes = document.getElementById("tempoestim").value;

    var objetivomarc = document.getElementsByName("objetivo");
    var objetivoSelecionado = null;

    for (var op = 0; op < objetivomarc.length; op++) {
        if (objetivomarc[op].checked) {
            objetivoSelecionado = objetivomarc[op].value;
            break;
        }
    }

    var local = document.getElementById("pegarlocal").value;
    var facilitadores = document.getElementById("selecionandofacilitador").value;
    var temaprincipal = document.getElementById("temaprincipal");

    var conteudo = temaprincipal.value;
    var data = document.getElementById("datainicio").value;

    if (data.trim() === "" || horainicio.trim() === "" || objetivoSelecionado.trim() === "" || conteudo.trim() === "" || tempoes.trim()==="") {

        Swal.fire({
            title: "Erro no registro",
            text: "Preencha todas as caixas obrigatórias",
            icon: "error"
        });

        console.log("(X) Puxou a function, mas está faltando informações");
        console.log(objetivoSelecionado).values;
        console.log(local);
        console.log(facilitadores);
    } else {
        Swal.fire({
            title: "Ata registrada com sucesso!",
            icon: "success"
        });

        // window.alert("Identifiquei, o texto foi: " + facilitadores + conteudo + ", o objetivo é: " + objetivoSelecionado + ", o horário é: " + horainicio + " e a data é: " + data);

        console.log("(1) A função 'gravando()' foi chamada");
        console.log(facilitadores);

        // Primeira solicitação AJAX para enviarprobanco.php
        $.ajax({
            url: 'enviarprobanco.php',
            method: 'POST',
            data: {

                // idLinha: idDaLinha,
                facilitadores: facilitadores,
                texto: conteudo,
                horai: horainicio,
                horat: horaterm,
                datainic: data,
                objetivos: objetivoSelecionado,
                local: local,
                tempoestimado: tempoes,
            },
            
            success: function () {
                console.log("(2) Deu bom! AJAX está enviando");

                // Redirecionando para pagparticipantes.php
                window.location.href = 'pagparticipantes.php' +
                '?facilitadores=' + encodeURIComponent(facilitadores) +
                '&conteudo=' + encodeURIComponent(conteudo) +
                '&horainicio=' + encodeURIComponent(horainicio) +
                '&horaterm=' + encodeURIComponent(horaterm) +
                '&data=' + encodeURIComponent(data) +
                '&objetivoSelecionado=' + encodeURIComponent(objetivoSelecionado) +
                '&local=' + encodeURIComponent(local) ;                
            },
            error: function (error) {
                console.error('Erro na solicitação AJAX:', error);
                console.log(facilitadores);
            },
        });

        // Segunda solicitação AJAX para pagdeliberacoes.php
        $.ajax({
            url: 'pagparticipantes.php',
            method: 'POST',
            data: {
                facilitadores: facilitadores,
                texto: conteudo,
                horai: horainicio,
                horat: horaterm,
                datainic: data,
                objetivos: objetivoSelecionado,
                local: local,
                tempoestimado: tempoes,
            },
            success: function (response) {
                console.log("(3) Deu bom! AJAX está enviando para pagdeliberacoes.php");
                console.log(response);
            },
            error: function (error) {
                console.error('Erro na solicitação AJAX para pagdeliberacoes.php:', error);
            }        
        });

    }
}

// Botões
gravarinformacoes.addEventListener('click', gravando);


