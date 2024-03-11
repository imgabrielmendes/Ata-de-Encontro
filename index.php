<?php

namespace formulario;

include ("vendor/autoload.php");
include_once ("app/acoesform.php");
include ("conexao.php");


//Testar conexao com banco de dados
$puxarform= new AcoesForm;
$facilitadores=$puxarform->selecionarFacilitadores();

//funções de encotrar pessoas
$pegarfa=$puxarform->pegarfacilitador();
$pegarcoo=$puxarform->pegarcoordenador();

//Puxar local
$pegarlocal=$puxarform->pegarlocais();

// o numero 2 significa que foi iniciado, o 1 signifca que não
// $status= session_start();
// $name = session_name();

// echo "<pre>"; print_r($status); echo "</pre>";
// echo "<pre>"; print_r($name); echo "</pre>";


// $start=session_start();
// echo "<pre>"; print_r($arrayStatus[$status] ?? ''); echo "</pre>";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ata de encontro - HRG</title>
  <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

  <!---------------------------------------------------------------->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="view/css/styles.css">
  <link rel="stylesheet" href="view/css/bootstrap.min.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="view/css/bootstrap.css">
  <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">
</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar shadow">
      <div id="container">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"></a>
          <h1 id="tittle" class="">Ata de Encontro</h1>
        </div>
      </div>
    </nav>
  </header>

  <!--FORMULÁRIO-->

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8">
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
            <input id="datainicio" class="form-control col-12 col-md-6" placeholder="dd-mm-aaaa" type="date">
          </div>


          <!---ABA DE HORÁRIO INICIO---->
          <div class="col-3">
            <label for="nomeMedico"><b>Horário de Início*:</b></label>
            <br>
            <input class="form-control col-12 col-md-6" type="time" id="horainicio" name="appt" min="09:00" max="18:00">
          </div>

 <!---ABA DE HORÁRIO TERMINO---->
          <div class="col-3">
            <label for="form-control"> <b> Horário de Término:</b> </label>
            <input class="form-control" type="time" id="horaterm" name="appt" min="13:00" max="12:00">
          </div>

 <!---ABA DE TEMPO ESTIMADO ---->
          <div class="col-3">
            <label for="form-control"> <b> Tempo Estimado (horas):</b> </label>
            <input class="form-control" type="input" id="tempoestim" name="appt" min="13:00" max="12:00">
          </div>
          <br>

           <!---ABA DE OBJETIVO - REUNIÃO---->
          <div class="col" id="objetivo">
            <label for="form-control"> <b>Objetivo:</b> </label>
            <label class="form-control">
              <input type="checkbox" class="objetivo" name="objetivo" id="reuniao" value="reuniao" > Reunião</label>
          </div>

           <!---ABA DE OBJETIVO - TREINAMENTO---->
          <div class="col">
            <br>
            <label class="form-control">
              <input type="checkbox" class="objetivo" name="objetivo" id="treinamento" value="treinamento"> Treinamento</label>
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
              <option> <?php foreach ($pegarlocal as $locais) : ?>
              <option value="<?php echo $locais['locais'] ?>" data-tokens="<?php echo $locais['locais']; ?>">
                <?php echo $locais['locais'] ?>
              <?php endforeach ?>
              </option>
            </select>
          </div>

          <br><br>

          <!---ABA DE ADICIONAR FACILITADORES---->
          <div class="col-4"> <label for="form-control"> <b> Facilitador(res) responsável*:</b> </label> </div>
          <br>
          <div class="col-8"  >
          <select class=" col-8 form-control" id="selecionandofacilitador">
          <optgroup label="Sem cargos">
              <option>
              <?php foreach ($pegarfa as $facnull) : ?>
                        <option value="<?php echo $facnull['nome_facilitador'] ." "."<". $facnull ['cargo'].">"; ?>"
                        data-tokens="<?php echo $facnull['nome_facilitador']; ?>">

                        <?php echo $facnull['nome_facilitador'] ?>
                </option>
                
                <?php endforeach ?>
                </option> 
          </select>

          </div>

          <!--CAIXA DE TEXTO SOBRE O QUE SE TRATA A ATA-->

          <div class="col-12"><b>Tema*:</b>
            <br>
            <input id="temaprincipal" class="form-control" type="text" />
          </div>

          <!--BOTÕES-->
          <div class="row">

            <div class="col  "><br>
              <div class="btn-atas">

              <button id="botaoregistrar" type="button" class="btn btn-success" data-bs-toggle="modal">
                        salvar
                      </button>
      
                      <!--TENTANDO LINKAR O BOTÃO COM O MODAL "registraremail.php"-->

                      <!-------------------- BOTÃO ------------------->
                      <!-- <button id="botaoregistrar" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldeemail">
                        Registrar Email
                      </button>

                      <!-------------------- MODAL ------------------->
                      <div class="modal fade" id="modaldeemail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Registro de usuário</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                              <form>
                                <div class="mb-3">

                                  <label type="email" for="recipient-name" class="col-form-label">Nome completo:</label>
                                  <input type="text" class="form-control" id="caixanome">
                                </div>

                                <div class="mb-3">
                                  <label type="email" for="recipient-name" class="col-form-label">Informe o Email</label>
                                  <input type="text" class="form-control" id="caixadeemail">
                                </div>

                                <label type="email" for="recipient-name" class="col-form-label">Informe o Cargo</label>

                                <select type="text" class="form-control" id="nomeFacilitador">
                                  <option disabled> - Informe aqui - </option>
                                </select>

                              </form>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                              <button id="registraremail" type="button" class="btn btn-primary">Registrar</button>

                            </div>
                          </div>
                        </div>
                      </div> 
              </div>
              <!--- COMANDO PARA ENVIAR AS INFORMAÇÕES DO BOTÃO PARA O BANCO DE DADOS----->
              <script>

              </script>

              <br><br>

      <script src="app/gravar.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>

</html>