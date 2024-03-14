<?php 

namespace tabela;

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


  <style>
    
table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
th {
  color: white;
  background-color:#001f3f;  
    border-bottom: 4px solid green;
}
tr:hover {
  background-color: #ddd;
}
.form-group{
    margin: 0 auto;
}
  </style>
</head>
<body>

<div class="form-group col-8">
<div class="row">
<main class="col-12"> 
    
<?php
// Check if modal needs to be shown
$show_modal = true; // You can set your conditions here

if ($show_modal) {
    echo '<div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>This is a modal! You can put any content here.</p>
            </div>
          </div>';
}
?>
<table id="myTable">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Age</th>
            <th>Country</th>
            <th>Country</th>
        </tr>
    </thead>
    <tbody>
        <tr  class="openModalBtn" data-modal-id="myModal">
            <td>John</td>
            <td>30</td>
            <td>USA</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal" >
            <td>Anna</td>
            <td>25</td>
            <td>UK</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal" >
            <td>Anna</td>
            <td>25</td>
            <td>UK</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal">
            <td>Peter</td>
            <td>35</td>
            <td>Canada</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal">
            <td>John</td>
            <td>30</td>
            <td>USA</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal">
            <td>John</td>
            <td>30</td>
            <td>USA</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal" >
            <td>Anna</td>
            <td>25</td>
            <td>UK</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal">
            <td>Peter</td>
            <td>35</td>
            <td>Canada</td>
            <td>UK</td>
        </tr>
        <tr class="openModalBtn" data-modal-id="myModal">
            <td>John</td>
            <td>30</td>
            <td>USA</td>
            <td>UK</td>
        </tr>
        
    </tbody>
</table>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get all buttons that open the modal
var btns = document.querySelectorAll('.openModalBtn');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Function to open the modal
function openModal() {
  modal.style.display = "block";
}

// Function to close the modal
function closeModal() {
  modal.style.display = "none";
}

// When the user clicks on a button to open the modal
btns.forEach(function(btn) {
  btn.onclick = function() {
    var modalId = this.getAttribute('data-modal-id');
    if (modalId === 'myModal') {
      openModal();
    }
  }
});

// When the user clicks on <span> (x), close the modal
span.onclick = closeModal;

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    closeModal();
  }
}
</script>
</main>
</div></div>
</body>
</html>