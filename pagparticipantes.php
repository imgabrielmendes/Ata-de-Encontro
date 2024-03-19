<?php

// namespace formulario;

// include ("vendor/autoload.php");
// include_once ("app/acoesform.php");
// include ("conexao.php");

// $puxarform= new AcoesForm;
// $facilitadores=$puxarform->selecionarFacilitadores();
// $pegarfa=$puxarform->pegarfacilitador();
// //var_dump($pegarfa);

// //PUXANDO OS VALORES QUE ESTÃO SENDO INSERIDOS NA PÁGINA PRINCIPAL ATRAVÉS DA CHAMADA AJAX NO "gravar.js
// $facilitadores = $_GET['facilitadores'];
// $conteudo = $_GET['conteudo'];
// $horainicio = $_GET['horainicio'];
// $horaterm = $_GET['horaterm'];
// $data = $_GET['data'];
// $objetivoSelecionado = $_GET['objetivoSelecionado'];
// $local = $_GET['local'];

echo "Facilitadores - $facilitadores, 
      Conteúdo - $conteudo, 
      Horário de Início - $horainicio, 
      Horário de Término - $horaterm, 
      Data - $data, 
      Objetivos - $objetivoSelecionado, 
      Local - $local";

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ata de encontro - HRG</title>
  <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">

  <!---------------------------------------------------------------->
  <script src="view/js/popper.min.js" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="view/css/styles.css">
  <link rel="stylesheet" href="view/css/bootstrap.min.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.css">
  <link rel="stylesheet" href="view/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="view/css/bootstrap.css">
  <link rel="stylesheet" href="view/css/selectize.bootstrap5.min.css">

  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-JCHjo1FjBu5zj08fFZ8niXNt6IuPO3WJ10Ii+XXITZ7IU46Scij9MJTf/ZZTK5HVm/BwOxAnoxO8cSvDaz9VWg==" crossorigin="anonymous" />

  <link rel="stylesheet" href="view/fontawesome/">
</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar shadow ">
      <div id="container">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php"  style="background-color: #20315f;">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"  style="background-color: #20315f;"></a>
          <h1 id="tittle" class="text-center">2° FASE</h1>
        </div>
      </div>
    </nav>
  </header>

  <!--FORMULÁRIO-->

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container_fluid d-flex justify-content-center align-items-center">
      <div class="form-group col-8">
        <div class="row"> 
          
    <div class="accordion" id="accordionPanelsStayOpenExample">

      <div class="accordion-item shadow">
        <h2 class="accordion-header">
          <button class="accordion-button shadow-sm text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne" style="background-color: #001f3f;">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
          <i class="fa-solid fa-circle-info"></i>
            <h5>Informações de Registro</h5>
          </button>
        </h2>

    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body" style="background-color: rgba(240, 240, 240, 0.41);">
          <div class="col-md-12 text-center">         
        
          </div>     

          <!---- PRIMEIRA LINHA DO REGISTRO ---->
          <div class="row">
            <br>
                  <div class="col-3">
                    <label>Data*</label>
                    <ul class="form-control bg-body-secondary"> <?php echo $data;  ?> </ul>
                  </div>
          
                  <!---ABA DE HORÁRIO INICIO---->
                  <div class="col-3">
                    <label for="nomeMedico"><b>Horário de Início*:</b></label>
                    <br>
                    <ul class="form-control bg-body-secondary"><?php echo $horainicio; ?></ul>
                  </div>

                  <!---ABA DE HORÁRIO TERMINO---->
                  <div class="col-3">
                    <label for="form-control"> <b> Horário de Término:</b> </label>
                    <ul class="form-control bg-body-secondary"><?php echo $horaterm; ?></ul>
                  </div>

                  <!---ABA DE TEMPO ESTIMADO ---->
                  <div class="col-3">
                    <label for="form-control"> <b>Tempo Estimado:</b> </label>
                    <ul class="form-control bg-body-secondary">Colocar resultado</ul>
                  </div>
          </div>

          <div class="row">
            <div class="col-6 ">
              <label><b> Facilitador(res) responsável:</b></label>
              <ul class="form-control bg-body-secondary"><?php echo $facilitadores; ?></ul>            
            </div>
          
 
          <div class="col-3">
            <label><b>Local:</b></label>
            <ul class="form-control bg-body-secondary border rounded"><?php echo $local; ?></ul>
          </div>

          <div class="col-3">
              <label for="form-control"> <b>Objetivo:</b> </label>
              <label class="form-control bg-body-secondary border rounded">
                <input type="checkbox" disabled checked> <?php echo $objetivoSelecionado; ?>
            </div>

            <div class="row">
                <div class="col">
                  <b>Tema:</b> 
                </div>
                <div class="row">
                <div class="col-12">
                  <ul class="form-control bg-body-secondary"><?php echo $conteudo; ?></ul>
                  </div></div>       
            </div>

    
            </div>
    </div>
</div>
  </div>

<!-----------------------------2° FASE-------------------------------->
<br>
<div class="accordion">
<div class="accordion-item shadow">
  <h2 class="accordion-header">
    <div class="accordion-button shadow-sm text-white" style="background-color: #1c8f69;;">
    <i class="fa-solid fa-circle-info"></i>
    <h5>Participantes</h5>
</div>
  </h2>                                                                                                                                       
        <main class="container-fluid ">
        <div class="row">
          <form id="addForm">
              <div class="form-group ">
                  <br>
                  <div  id="items" class="col-10 list-group"></div>
                  
                  <label for="item"><b>Informe os participantes<b></label>
                  <div class="row">
                    <div class="col-10"> 
                    <select id="item" class="form-control" placeholder="Participantes...">
                      <?php foreach ($pegarfa as $facnull) : ?>
                          <option value="<?= $facnull['nome_facilitador'] . " <" . $facnull['cargo'] . ">"; ?>">
                              <?= $facnull['nome_facilitador'] . " <" . $facnull['cargo'] . ">"; ?>
                             
                            </option>
                            
                      <?php endforeach ?><option value="teste">testee</option>
                        <option value="teste">testee</option>
                        <option value="teste">testee</option>
                        <option value="teste">testee</option>
                  </select>
                </div>
                  <div class="col-2">
                  <button type="button" id="addItemButton" class="btn btn-primary ">+</button>
                  </div> 
                </div>
                  </div>
                       
             
          </form>
          <div  class="row">
          <div class="col">
           <button style="width: 30%; padding:0px;margin:5px; background-color:white; color:#353535; border:none;" id="botaoregistrar" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modaldeemail">
              Clique aqui para cadastrar usúario 
            </button>
       </div>
      </div>
    </div>
<br>
           
      <!--BOTÕES-->
      <div class="container d-flex justify-content-center">
        <div class="row">

          <div class="col">
              <button id="botaocontinuarata" type="button" class="btn btn-success" data-bs-toggle="modal">
                Continuar ata
              </button>
              <script>
                function abrirDeliberacoes(){
                  window.location.href = 'pagdeliberacoes.php';
                }
              </script>

        </div>
        <div class="col">
                  
              <button onclick="abrirHistorico()"  id="botaoregistrar" type="button" class="btn btn-primary" data-bs-toggle="modal">
                Atualizar a ata
              </button>
            </div>
            </div>
              <script>
        function abrirHistorico() {
            window.location.href = 'paghistorico.php';
        }
    </script>
            </div>
        </div>
      </div>

            </div>
</main>
                      <!------------------ MODAL ------------------>
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

                                  <label type="email" for="recipient-name" class="col-form-label">Nome completo:</label>
                                  <input type="text" class="form-control" id="caixanome">
                                </div>

                                <div class="mb-3">
                                  <label type="email" for="recipient-name" class="col-form-label">Informe o Email</label>
                                  <input type="text" class="form-control" id="caixadeemail">
                                </div>

                                <label type="email" for="recipient-name" class="col-form-label">Informe o Cargo</label>

                                <input type="text" class="form-control" id="caixacargo">

                              </form>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                              <button id="registraremail" type="button" class="btn btn-primary">Registrar</button>

                            </div>
                          </div>
                        </div>
                      </div> 
                      
<<<<<<< HEAD
=======
<!-------------------- BOTÃO DA MODAL ------------------->
                      <div class="row">
          <div class="col-10">
           <button id="botaoregistrar" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modaldeemail">
              Seu usuário não está cadastrado? <b>clique aqui</b>
            </button>
</div>
       </div>
      </div>
>>>>>>> 6efe61e14139a8b23b0fd3fe587036b31823d01d
</div>
           <!-------------------- BOTÃO DA MODAL ------------------->
         

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="view/js/bootstrap.js"></script>
    <script src="app/participantes.js"></script>

</body>

</html>