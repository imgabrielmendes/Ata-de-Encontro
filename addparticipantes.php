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

$facilitadores=$_POST['facilitadores'];
    echo "Variáveis recebidas: Facilitadores - $facilitadores";
    var_dump($facilitadores);

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

        <h1>DEU BOM, FOI PUXADO</h1>
    <form>

    <div class="row">
        <div class="col">
            <label><b>Nome inserido:</b></label> 
            <div class="col">
            <tbody>
                
                <?php foreach ($pegarfa as $fac) ?> 
                
                    <?php echo $fac['nome_facilitador'] ?>
                <?php  ?> 
            </tbody>
        </div>
    </div>
        <script>
            console.log ("PUXOU! TA PUXANDO A PÁG");
            console.log ("O VALOR INSERIDO NO NOME ANTERIORMENTE FOI:");
        </script>
    </form>
        <script>
            
        </script>
        <div class="row">

        </div>
      <script src="app/gravar.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>

</html>