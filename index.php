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
    <nav class="navbar">
      <div id="container">
        <div class="container_align"> 
          <a  href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" class="logo_hospital"
          src="view\img\Logobordab.png"></a>
          <h1 id="tittle" class="">Ata de Encontro</h1>
        </div>      
      </div>
    </nav>
  </header>

<!--FORMULÁRIO-->

<!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
<div class="box box-primary">

<main class="container d-flex justify-content-center align-items-center">
        <div class="form-group col-8">      

<!--2° LINHA DO FORMULÁRIO DA ATA----------------------->
          <div class="row"> <!---COLUNA NOME + DATA---->

          <!--Título do formulário ----------------------->

          <div class="col-md-12 text-center"> <h2>Formulário de Solicitação </h2> </div>
          <br><br><br>

            <!--- ABA DE SELECIONAR LOCAL ---->
            <div class="col">
              <label for="nomeFacilitador"><b>Informe o Local</b></label>
              <select type="text" class="form-control" id="nomeFacilitador">
                <option disabled> - Informe o Local - </option>

                  <option> <?php foreach ($pegarlocal as $locais) : ?> 

                        <option value="<?php echo $locais['locais']?>" 
                        data-tokens="<?php echo $locais['locais']; ?>">
                        <?php echo $locais['locais'] ?>

                            <?php endforeach ?>
                </option>            
              </select>  
            </div>

              <!---ABA DE DATA---->
              <div class="col">
                <label ><b>Data*</b></label>
                <input id="datainicio"class="form-control col-12 col-md-6" placeholder="dd-mm-aaaa" type="date">
              </div>
              

              <!---ABA DE HORÁRIO---->
              <div class="col">
                <label for="nomeMedico"><b>Horário de Início*:</b></label>
                <br>
                <input class="form-control col-12 col-md-6" type="time" id="horainicio" name="appt" min="09:00" max="18:00">
              </div>
          
<br>

<br>
<!--2° LINHA DO FORMULÁRIO DA ATA----------------------->
          <!---ABA DE OBJETIVOS---->  
         
          <!---ABA DE MARCAÇÕES de OBJETIVOS----> 
          
                      <div class="col-8" ><b>Facilitador(res) Responsáveis*:</b>
                      <br>
                      <!-- Um campo básico --> 
                      <input id="temaprincipal" class="form-control" type="text" /></div>

                    <div class="col-4"> 
                      <label  for="form-control"> <b> Horário de Término:</b> </label>
                      <input class="form-control" type="time" id="horaterm" name="appt" min="13:00" max="12:00">
                    </div>

<br>
<br>

 <div class="col"><br>
                    <b> Objetivo do encontro:</b></div>

                     
                    <div class="col">
                      <br>
                      <label class="form-control">
                      <input type="radio" class="objetivo" name="objetivo" id="reuniao" value="reuniao" checked=""> Reunião</label></div>

                      <div class="col">
                      <br>
                      <label class="form-control">
                      <input type="radio" class="objetivo" name="objetivo" id="treinamento" value="treinamento" checked=""> Treinamento </label></div>

                      <div class="col">
                        <br>
                      <label class="form-control">
                      <input type="radio" class="objetivo" name="objetivo" id="consulta" value="Consulta" checked=""> Consulta </label></div>

<!---3 ° SELEÇÃO DOS FACILITADORES + VIZUALIZAÇÃO DOS SELECIONADOS----->


                  <!--CAIXA DE TEXTO SOBRE O QUE SE TRATA A ATA-->
                  
                      <div class="col-12" ><b>Conteúdo abordado*:</b>
                      <br>
                      <!-- Um campo básico --> 
                      <input  id="temaprincipal" class="form-control" type="text" />
                  </div>


                 <div class="delibera">
                   <h2> Deliberações</h2>
                   <div> </div>
                   
                 </div>

                                <!---CHECK DE FACILITADOR---->  

            <div class="col">
              <label for="nomeFacilitador"><b>Informe o deliberador*:</b></label>
              <select type="text" class="form-control" id="nomeFacilitador">

                <option id="" disabled class="form-control disable" name="Informe os facilitadores da ata">Informe as deliberações*:</option>

<!---FILTRAR APENAS FUNCIONÁRIOS DA ADM---->
<form action="">
<optgroup label="Sem cargos">
<option>
        <?php foreach ($pegarfa as $facnull) : ?>
          <option value="<?php echo $facnull['cargo']; ?>"
          data-tokens="<?php echo $facnull['nome_facilitador']; ?>">

          <?php echo $facnull['nome_facilitador'] ?>
  </option>
  
    <?php endforeach ?>
  </option> 
     
<optgroup label="ADM">
  <option>
      <?php foreach ($pegarfa as $facarg) : ?> 
        <option value="<?php echo $facarg['cargo']?>" 

        data-tokens="<?php echo $facarg['nome_facilitador']; ?>">

        <?php echo $facarg['nome_facilitador'] ?>
  </option>
  
    <?php endforeach ?>
  </option> 

<!---FILTRAR APENAS FUNCIONÁRIOS DA Coordenação---->  
<optgroup label="Coordenação">
<option>
      <?php foreach ($pegarcoo as $coordenador) : ?> 

        <option value="<?php echo $coordenador['cargo']?>" 
        data-tokens="<?php echo $coordenador['nome_facilitador']; ?>">
        <?php echo $coordenador['nome_facilitador'] ?>

        </option>
          <?php endforeach ?>
        </option> 

<optgroup label="Supervisão">
  <option>SUP1</option>
  <option>SUP1</option> </form>          
              </select>  
            </div>

              

             
                        <!---CHECK DE FACILITADOR---->  
                      
                
                <div spellcheck="textarea" class="col-8">
                  <b>Informe as deliberações*</b>
                      <br>
                      <!-- Um campo básico --> 
                      <input id="temaprincipal" class="form-control" type="text" /></div>
       
</form>
  <div class="row">
    <div class="col"> <button id="addelibe" class="add-button" value="+" >+</button> </div>
  </div>   
                   
<br>
      
            <!--BOTÕES-->
            <div class="row">
            <div class="col  ">
              <div  class="btn-atas">
                    <a type="input" id="botaosolicitar"  class="btn btn-success">Solicitar uma ata<a>
                      <tr>    

                    <!--TENTANDO LINKAR O BOTÃO COM O MODAL "registraremail.php"-->  

                   <!-------------------- BOTÃO ------------------->
                  <button id="botaoregistrar"  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldeemail">
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

<br> <br>
</main> 

<!-----------------------HISTÓRICO DE ATAS-------------->

<div>
  <div>  <div class="container">
        <div class="col-md-12 text-center"> <h2> Histórico de ATAS </h2> </div> 
        <br>
        <nav>    
        <table class="table table-striped">

        <thead>
    <tr>
      <th scope="col">Data de Solicitação</th>
      <th scope="col">Facilitador Responsável</th>
      <th scope="col">Tema principal</th>
      <th scope="col">*Espaço para uma doc box (ou tentar colocar uma)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
     
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
    
    </tr>

        </table>
            
      </nav> </div>  
</div>  
</class>  

<script src="app/gravar.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>
</html>
