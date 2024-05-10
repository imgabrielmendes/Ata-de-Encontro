<?php

namespace formulario;

include_once ("app/acoesform.php");
include ("conexao.php");


//Testar conexao com banco de dados
$puxarform= new AcoesForm;
$facilitadores=$puxarform->selecionarFacilitadores();
//funções de encotrar pessoas
$pegarfa=$puxarform->pegarfacilitador();
// Puxar local
$pegarlocal=$puxarform->pegarlocais();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ata de encontro - HRG</title>
  <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="view/css/styles.css">
  <link rel="stylesheet" href="view/css/bootstrap.min.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="view/css/bootstrap.css">
  <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

</head>

<body>

<style>
          body{
        background-color: rgba(240, 240, 240, 0.41);
      }

  .content-header{
        background-color: #001f3f;
    }
    </style>
      <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-border-hrg">
            <div class="container-fluid">
                <a class="navbar-brand" href="http://10.1.1.31:80/centralservicos/"><img src="http://10.1.1.31:80/centralservicos/resources/img/central-servicos.png" alt="Central de Serviço" style="width: 160px">
                </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarCentral" aria-controls="navBarCentral" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
      

      <div class="collapse navbar-collapse" id="navBarCentral">
      </div>
    </div>
  </nav>
  <div class="content-header shadow" style="border-bottom: solid 1px gray;">
      <div class="container-fluid">
        <div class="row py-1">
          <div class="col-sm-6">
            <h2 class="m-3 text-light shadow"><i class="fas fa-users"></i> Ata de encontro</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!--FORMULÁRIO-->
</div>
  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8 mt-5">
        <!--2° LINHA DO FORMULÁRIO DA ATA----------------------->
        <div class="row"> <!---COLUNA NOME + DATA---->

          <!--Título do formulário ----------------------->

          <div class="col-md-12 text-center">
            <h2>Formulário de Solicitação </h2>
          </div>
          <br><br><br>
          
          <!---ABA DE DATA---->
          <div class="col-3">
            <label><b>Data*</b></label>
            <input id="datainicio" class="form-control col-12 col-md-6" placeholder="dd-mm-aaaa" min="2024-04-01" type="date">
          </div>
          
              <!--CONDIÇÃO PARA QUE O USUARIO NÃO COLOQUE DIAS ANTERIORES--->
              <script>
                var hoje = new Date().toISOString().split('T')[0];
                document.getElementById("datainicio").setAttribute("min", hoje);
              </script>


          <!---ABA DE HORÁRIO INICIO---->
          <div class="col-3">
            <label for="nomeMedico"><b>Horário de Início*:</b></label>
            <br>
            <input class="form-control col-12 col-md-6" type="time" id="horainicio" name="appt" min="" max="18:00">
          </div>

          <!---ABA DE HORÁRIO TERMINO---->
          <div class="col-3">
            <label for="form-control"> <b> Horário de Término:</b> </label>
            <input class="form-control" type="time" id="horaterm" name="appt" min="13:00" max="12:00">
          </div>

          <!---ABA DE TEMPO ESTIMADO ---->
          <div class="col-3">
            <label for="form-control"> <b> Tempo Estimado (horas):</b> </label>
            <input value="1" class="form-control" type="number" id="tempoestim" name="appt" min="0" max="5">
          </div>
          <br>

           <!---ABA DE OBJETIVO - REUNIÃO---->
          <div class="col" id="objetivo">
            <label for="form-control"> <b>Objetivo:</b> </label>
            <label class="form-control">
              <input type="checkbox" class="objetivo" name="objetivo" id="reuniao" value="Reunião" > Reunião</label>
          </div>

           <!---ABA DE OBJETIVO - TREINAMENTO---->
          <div class="col">
            <br>
            <label class="form-control">
              <input type="checkbox" class="objetivo" name="objetivo" id="treinamento" value="Treinamento"> Treinamento</label>
          </div>

        <!---ABA DE OBJETIVO - CONSULTA---->
          <div class="col">
            <br>
            <label class="form-control">
              <input type="checkbox" class="objetivo" name="objetivo" id="consulta" value="Consulta"> Consulta </label>
          </div>

          <!--- ABA DE SELECIONAR LOCAL ---->
          <div class="col-4">
            <label for="nomeFacilitador"><b>Informe o Local</b></label>
            <select class="form-control" id="pegarlocal">
              <option disabled> - Informe o Local - </option>
              <option> 
              
              <?php foreach ($pegarlocal as $locais) : ?>
              <option value="<?php echo $locais['locais'] ?>" data-tokens="<?php echo $locais['locais']; ?>">
              <?php echo $locais['locais'] ?> <?php endforeach ?>
              </option>

            </select>
          </div>

          <br><br>
          <!---ABA DE ADICIONAR FACILITADORES---->
          <div class="col-4"> <label for="form-control"> <b> Facilitador(res) responsável*:</b> </label> </div>
          <br>     
          <div class="col-8">
          <select class="col-8 form-control" id="selecionandofacilitador" name="facilitador" multiple>
              <optgroup label="Selecione Facilitadores">
                  <?php foreach ($pegarfa as $facnull) : ?>
                      <option value="<?php echo $facnull['id']; ?>"
                          data-tokens="<?php echo $facnull['nome_facilitador']; ?>">
                          <?php echo $facnull['nome_facilitador']; ?>
                      </option>
                  <?php endforeach ?>
              </optgroup>
          </select>

          </div>
 
          <!--CAIXA DE TEXTO SOBRE O QUE SE TRATA A ATA-->

          <div class="col"><b>Tema*:</b>
            <br>
            <input id="temaprincipal" class="form-control" type="text" />
          </div>

          <!--BOTÕES-->
          <div class="row">

            <div class="col  "><br>
              <div class="btn-atas">
                
              <button id="botaoregistrar" type="button" class="btn btn-success">salvar</button>

              <button id="botaoregistrar" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modaldeemail">Cadastre-se</button>
              </div>
              
              <div class="modal fade" id="modaldeemail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="col modal-title fs-5" id="staticBackdropLabel">Registro de usuário</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                              <form>
                                <div class="mb-3">

                                  <label class="col-form-label">Nome completo:</label>
                                  <input type="text" class="form-control" id="caixanome">
                                </div>

                                <div class="mb-3">
                                  <label class="col-form-label">Informe o Email</label>
                                  <input type="email" class="form-control" id="caixadeemail">
                                </div>

                                <div class="row">
                                <label class="col-4 form-label">Matricula: </label>
                                <label id="labelcargo" class="col-8 form-label">Cargo: </label>
                                <div class="col-4">
                                <input type="text" maxlength="4" class="form-control" id="caixamatricula">
                                </div>  

                                <div class="col-8">
                                <input type="text" class="col-5 form-control" id="caixacargo">
                              </div></div>
                              </form>

                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                              <button id="registraremail" type="button" class="btn btn-primary">Registrar</button>

                            </div>
                          </div>
                        </div>
                      </div>


      <script src="view\js\multi-select-tag.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
      <script src="view/js/bootstrap.js"></script>
      <script src="app/gravar.js"></script>

</body>

</html>