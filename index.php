<?php 
  namespace formulario;
  
  include ("vendor/autoload.php");
  include_once ("app/acoesform.php");

  //Testar conexao com banco de dados
  include ("conexao.php");



// o numero 2 significa que foi iniciado, o 1 signifca que não
//$status= session_start();
//$name = session_name();

//echo "<pre>"; print_r($status); echo "</pre>";
//echo "<pre>"; print_r($name); echo "</pre>";


//$start=session_start();
//echo "<pre>"; print_r($arrayStatus[$status] ?? ''); echo "</pre>";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ata de encontro - HRG</title>
    <link rel="icon" href="view\img\Logobordab.png" type="image/x-icon">
        
    <script src="view/jquery-3.7.1.js"></script>

    <!--SELECTIZER---------------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>

    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
    integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
    
<!---------------------------------------------------------------->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="view/css/styles.css" media="screen" />

</head>
<body>

<!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar">
      <div class="container">
        <a class="navbar-brand position-absolute top-100 start-0 translate-middle">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php">
            <img alt="Logo" width="40%" height="40%" class="d-inline-block align-text-top"
          src="view\img\Logobordab.png"></a>
          <h1 id="tittle" class="container d-flex justify-content-center align-items-center text-light">Ata de Encontro</h1>
              
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


            <!---ABA DE SELECIONAR FACILITADORES---->
            <div class="col">
              <label for="nomeFacilitador"><b>Informe o Local</b></label>
              <select type="text" class="form-control" id="nomeFacilitador">
                <option disabled> - Informe o Local - </option>
                <option>l1</option>
                <option>l2</option>
                <option>l3</option>              
              </select>  
            </div>

              <!---ABA DE DATA---->
              <div class="col">
                <label for="nomeMedico"><b>Data</b></label>
                <input class="form-control col-12 col-md-6" placeholder="dd-mm-aaaa" type="date">
              </div>
              

              <!---ABA DE HORÁRIO---->
              <div class="col">
                <label for="nomeMedico"><b>Horário de Início:</b></label>
                <br>
                <input class="form-control col-12 col-md-6" type="time" id="appt" name="appt" min="09:00" max="18:00">
              </div>
          
<br>

<br>
<!--2° LINHA DO FORMULÁRIO DA ATA----------------------->
          <!---ABA DE OBJETIVOS---->   
          <div class="formulario_ata">

                
          <div class="row ">
            <div class="col ">
              <label for="objetivo"> <b>Objetivo do Encontro:</b></label>
            </div>

          <!---ABA DE MARCAÇÕES de OBJETIVOS----> 
        <div class="row"> 
          <div class="row ">
          <div class="col ">
                      <label class="form-control">
                      <input type="radio" class="objetivo" name="objetivo[]" id="reunião" value="1" checked="">  Reunião </label></div>

                  
                  <div class="col">
                    <label class="form-control">
                      <input type="radio" class="objetivo" name="objetivo[]" id="treinamento" value="2" checked=""> Treinamento </label></div>

                     
                    <div class="col">
                      <label class="form-control">
                      <input type="radio" class="objetivo" name="objetivo[]" id="consulta" value="3" checked=""> Consulta/Parecer </label></div>

                <!---Horário de Término---->  
                    <div class="col-4">
                    <label for="nomeMedico"><b>Horário de Término:</b></label>
                    <br>
                      <input class="form-control " type="time" id="appt" name="appt" min="09:00" max="18:00">
                    </div>
          </div>
        </div> 
      </div> 
      </div> 
<br>
<br>

<!---3 ° SELEÇÃO DOS FACILITADORES + VIZUALIZAÇÃO DOS SELECIONADOS----->

              <!---CHECK DE FACILITADOR---->  

              <label><b>Add Facilitador</b></label>
              <div class="row">
                  <form class="row">                 
                      <div class="col-5">
                          <div class="multiselect" onclick="SelecionarFacilitador()"></div>
                          <select id="select-gear" class="demo-default form-group" multiple placeholder="Select gear">
                              <option disabled class="form-control disable" name="Informe os facilitadores da ata">Informe os facilitadores da ata:</option>
                              <optgroup label="ADM">
                                <option>

                                <!----<?php
                                        foreach ($hgjg as $resMed) :
                                    ?> 
                                        <option value="<?php echo $resMed['nome_facilitador'] . '/' . $resMed['email_facilitador'] ?>" data-tokens="<?php echo $resMed['NOME']; ?>">
                                            <?php echo 'CRM: ' . $resMed['PSV_CRM'] . ' - ' . $resMed['NOME']; ?>
                                        </option>
                                    <?php
                                    endforeach;
                                    ?> --->

                                </option>
                                
                              <optgroup label="Coordenação">
                                <option>FAC1</option>
                                <option>FA21</option>
                              <optgroup label="Supervisão">
                                <option>SUP1</option>
                                <option>SUP1</option>
                            </select>
                          </div>

                        <!---CHECK DE FACILITADOR---->  
                        <div class="col-7">
                        <div class="multiselect"></div>
                          <select class="form-control">
                            <option disabled> <?php  ?> </option>    
                          </select></div>
                </form>
              </div>
          </div>

<br>
                  <!--CAIXA DE TEXTO SOBRE O QUE SE TRATA A ATA-->
                  <div class="row">     
                      <div class="col"><b>Tema principal</b></div>
                      <br>
                      <textarea type= "text" class="form-control"></textarea> 
                  </div>

                  <!--CAIXA DE TEXTO SOBRE O QUE SE TRATA A ATA-->
                  <div class="row">     
                      <div spellcheck="textarea" class="col"><b>Informe uma descrição</b></div>
                      <br>
                      <textarea type= "text" class="form-control"></textarea> 
                  </div>
<br>
<br>

            <!--BOTÕES-->
            <div class="row">
            <div class="col  ">
              <div  class="lineButtons col d-flex justify-content-center align-items-center ">
                    <a href="app/abrirata.php" class="btn btn-success">Solicitar uma ata<a>
                      <tr>    

                    <!--TENTANDO LINKAR O BOTÃO COM O MODAL "registraremail.php"-->  

                   <!-------------------- BOTÃO ------------------->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Registrar Email
                  </button>

                  <!-------------------- MODAL ------------------->
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                              <input type="text" class="form-control" id="recipient-name">
                            </div>

                            <div class="mb-3">
                              <label type="email" for="recipient-name" class="col-form-label">Informe o Email</label>
                              <input type="text" class="form-control" id="recipient-name">
                            </div>

                            
                            <label type="email" for="recipient-name" class="col-form-label">Informe o Cargo</label>
                            <select type="text" class="form-control" id="nomeFacilitador">
                              <option disabled> - Informe o Local - </option>
                              <option>l1</option>
                              <option>l2</option>
                              <option>l3</option>  
                                          
                            </select>  

                          </form>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            
<br> <br>

<!-----------------------HISTÓRICO DE ATAS-------------->

<div class="row">
  <div>  <div class="container-fluid">
        <div class="col-md-12 text-center"> <h2> Histórico de ATAS </h2> </div> 
        <nav>    
          <div class="table shadow d-flex justify-content-center align-items-center">
            <tr>aba de data</tr>
            <tr>título da ata</tr>
            <tr>algum código de indetificação</tr>
            <tr>informação</tr>
            <tr>caixa de doc para importar arquivo da ATA</tr>
            </div>
            
      </nav> </div>
     
      
      
       
    
</main> 
</div>  
</class>  
</body>
</html>
