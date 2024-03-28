<?php
            //Conexão com o banco de dados (substitua os valores pelos seus próprios)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "atareu";

            //Cria a conexão
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Checa a conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // Consulta SQL para selecionar os dados
            $sql = "SELECT data_registro, facilitador, tema, objetivo, local, status FROM assunto ORDER BY `data_registro` desc";
            $result = $conn->query($sql);

            

            // ?>

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

  
</head>

<body>

  <!--BARRA DE NAVEGAÇÃO-->
  <header>
    <nav class="navbar shadow ">
      <div id="container">
        <div class="container_align">
          <a href="http://agendamento.hospitalriogrande.com.br/views/admin/index-a.php"  style="background-color: #20315f;">
            <img alt="Logo" class="logo_hospital" src="view\img\Logobordab.png"  style="background-color: #20315f;"></a>
          <h1 id="tittle" class="text-center">Histórico</h1>
        </div>
      </div>
    </nav>
  </header>
  

  <!--PRIMEIRA LINHA DO FORMULÁRIO DA ATA---------------->
  <div class="box box-primary">
    <main class="container d-flex justify-content-center align-items-center">
      <div class="form-group col-12">
        <div class="row"> 

          <!----LEGENDA DA TABELA------->
        <caption id="caption" style="caption-side: top;display: flex;padding-top: 0;font-size: 14px;"
    class="text-uppercase pb-0 mr-0">
    <div class="collapse show">
        <ul class="d-flex flex-wrap row text-right" style="list-style-type: none;justify-content: right;">
            <li class="col">
                <span class='badge bg-primary'>ABERTA</span>
                <label>Ata aberta</label>
            </li>
            <li class="col">
                <span class='badge bg-warning'>PROCESSO</span>
                <label>Ata em processo</label>
            </li>
            <li class="col">
                <span class='badge bg-success'>FECHADA</span>
                <label>Ata fechada</label>
            </li>
        </ul>
    </div>
</caption>
          <!---- PRIMEIRA LINHA DO REGISTRO ---->
       



<!-- Button to trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display:none;" id="modalTrigger">
  Launch modal
</button> -->

<!-- Modal -->
<!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> -->
        <!-- Content to display in the modal -->
        <!-- <p>This is the modal content.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->


<div class="form-group col-10">
      <div class="row">
      <div class="container">
      <div class="col">

<table  id="myTable" class="table table-striped">
  <thead>
    <tr class="col">
      <th>Solicitação</th>
      <th>objetivo</th>
      <th>facilitador</th>
      <th>tema</th>
      <th>local</th>
      <th>status</th>
    </tr>
  </thead>
  <tbody>

  <div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
        Filtro de Registro
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body">

<!--barra de pesquisa para filtro-->
<input type="text" id="filtroInput" onkeyup="filtrarRegistros()" placeholder="Filtrar registros...">
<script>
  
    // Função para filtrar registros
    function filtrarRegistros() {
        var input, filtro, tabela, linhas, celula, texto;
        input = document.getElementById("filtroInput");
        filtro = input.value.toUpperCase();
        tabela = document.getElementById("myTable");
        linhas = tabela.getElementsByTagName("tr");

        // Iterar sobre todas as linhas da tabela e esconder aquelas que não correspondem ao filtro
        for (var i = 0; i < linhas.length; i++) {
            celula = linhas[i].getElementsByTagName("td");
            for (var j = 0; j < celula.length; j++) {
                if (celula[j]) {
                    texto = celula[j].innerText.toUpperCase() || celula[j].textContent.toUpperCase();
                    if (texto.indexOf(filtro) > -1) {
                        linhas[i].style.display = "";
                        break;
                    } else {
                        linhas[i].style.display = "none";
                    }
                }
            }
        }
    }
</script>     
 </div>
  </div>
  </div>
  
</div>
<br>
  <div class="form-group col-8">
    <div class="row">
        <main class="col-12">       
           <?php
            // Conexão com o banco de dados (substitua os valores pelos seus próprios)
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "atareu";

            // Cria a conexão
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Checa a conexão
            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // Consulta SQL para selecionar os dados
            $sql = "SELECT data_solicitada ,facilitador, tema, hora_inicial, hora_termino, data_solicitada, objetivo, local, status 
            FROM assunto 
            
            ORDER BY data_registro DESC";

            $result = $conn->query($sql);
            ?>

            <tbody>
                <?php
                // Exibe os dados em cada linha da tabela
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["data_solicitada"] . "</td>";
                        echo "<td>" . $row["objetivo"] . "</td>";
                        echo "<td>" . $row["facilitador"] . "</td>";
                        echo "<td>" . $row["tema"] . "</td>";
                        echo "<td>" . $row["local"] . "</td>";
                        echo '<td class="status_button" >' . $row['status'] . '</td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum resultado encontrado.</td></tr>";
                }
                $conn->close();
                ?>
                </tbody>

  </tbody>
    <?php
      // Sample data
      // $users = array(
      //   array('id' => '18/03', 'objetivo' => 'reuniao', 'facilitador' => 'Jhon' ,'tema' => 'organização' ,'local' => 'sala 15','status' => 'Aberta'   ),
      //   array('id' => '18/03', 'objetivo' => 'reuniao', 'facilitador' => 'Eduarda' ,'tema' => 'organização' ,'local' => 'sala 10','status' => 'Aberta'   ),
      //   array('id' => '18/03', 'objetivo' => 'reuniao', 'facilitador' => 'Gabriel' ,'tema' => 'organização' ,'local' => 'sala 1','status' => 'Fechada'   ),
      //   array('id' => '18/03', 'objetivo' => 'reuniao', 'facilitador' => 'Lucas' ,'tema' => 'organização' ,'local' => 'sala 13','status' => 'Aberta'   ),
      //   array('id' => '18/03', 'objetivo' => 'reuniao', 'facilitador' => 'Pedro' ,'tema' => 'organização' ,'local' => 'sala 2','status' => 'Fechada'   ),
      //   array('id' => '18/03', 'objetivo' => 'reuniao', 'facilitador' => 'Jonas' ,'tema' => 'organização' ,'local' => 'sala 17','status' => 'Aberta'   ),
      //   array('id' => '18/03', 'objetivo' => 'reuniao', 'facilitador' => 'Luan' ,'tema' => 'organização' ,'local' => 'sala 23','status' => 'Aberta'   ),

      // );

      // Loop through each user and create a row
      // foreach ($users as $user) {
      //   echo '<tr class="table-row" data-toggle="modal" data-target="#myModal">';
      //   echo '<td>' . $user['id'] . '</td>';
      //   echo '<td>' . $user['objetivo'] . '</td>';
      //   echo '<td>' . $user['facilitador'] . '</td>';
      //   echo '<td>' . $user['tema'] . '</td>';
      //   echo '<td>' . $user['local'] . '</td>';
      //   echo '<td class="status_button" >' . $user['status'] . '</td>';
      //   echo '</tr>';
      // }
    ?>
  </tbody>
</table>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalContent"></div>
    </div>
</div>

<script>

var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the table
var table = document.getElementById("myTable");

    table.addEventListener("click", function(event) {
        var target = event.target;
        if (target.tagName === 'TD') {
            var row = target.parentNode;
            var rowData = row.querySelectorAll('td');
            var modalContent = document.getElementById("modalContent");
            modalContent.innerHTML = "<h2>Row Details</h2>";
            for (var i = 0; i < rowData.length; i++) {
                modalContent.innerHTML += "<p><strong>" + table.rows[0].cells[i].innerHTML + ": </strong>" + rowData[i].innerHTML + "</p>";
            }
            modal.style.display = "block";
        }
    });
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

   // Get all buttons with the class 'status-button'
   var buttons = document.querySelectorAll('.status_button');

// Loop through each button
buttons.forEach(function(button) {
    // Check the text content of the button
    var buttonText = button.textContent.trim();

    // Add or remove classes based on the text content
    if (buttonText === 'Aberta') {
        button.style.backgroundColor = 'green';
    } else if (buttonText === 'Fechada') {
        button.style.backgroundColor = 'red';
    }
});

    
</script>

       <script src="view/js/bootstrap.js"></script>
    </div>
</div>
</div>
</div>
 </main>
<!-----------------------------2° FASE-------------------------------->

</body>

</html>