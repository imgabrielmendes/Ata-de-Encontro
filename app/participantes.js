var form = document.getElementById('addForm');
var itemList = document.getElementById('items');
var filter = document.getElementById('filter');
var addNewTextBoxBtn = document.getElementById('addNewTextBox');
var newItemCounter = 1;

form.addEventListener('submit', addItem);
itemList.addEventListener('click', removeItem);
filter.addEventListener('keyup', filterItems);
addNewTextBoxBtn.addEventListener('click', addNewTextBox);

function addItem(e) {

    e.preventDefault();
    var newItem = document.getElementById('item').value.trim();
    if (newItem === "") {

        Swal.fire({
        title: "Você não add um participantes",
        text: "Adicione pelo menos 1 participante para a ata",
        icon: "error"
        });

    } 
    
      else {
          var li = document.createElement('li');
            li.className = 'list-group-item';
            li.appendChild(document.createTextNode(newItem));

          var deleteBtn = document.createElement('button');
            deleteBtn.className = 'btn btn-danger btn-sm float-right delete';
            deleteBtn.appendChild(document.createTextNode('X'));
            li.appendChild(deleteBtn);
            itemList.appendChild(li);
      }

    document.getElementById('item').value = ''; // Limpa o campo de texto
}

function removeItem(e) {
    if (e.target.classList.contains('delete')) {
        if (confirm('Tem certeza?')) {
            var li = e.target.parentElement;
            itemList.removeChild(li);
        }
    }
}

function filterItems(e) {
  
    var text = e.target.value.toLowerCase();
    var items = itemList.getElementsByTagName('li');

    Array.from(items).forEach(function (item) {
        var itemName = item.firstChild.textContent.toLowerCase();
        if (itemName.indexOf(text) !== -1) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }

        });
}

function addNewTextBox() {

    var newDiv = document.createElement('div');
        newDiv.className = 'row';

    var mainContainer = document.createElement('main');
        mainContainer.className = 'container_fluid d-flex justify-content-center align-items-center';

    var col9 = document.createElement('div');
        col9.className = 'col-9';

    var select = document.createElement('select');
        select.className = 'form-control';
        select.id = 'selecionandoparticipa';
        select.name = 'facilitador';

    pegarfa.forEach(function (item) {
        
        var option = document.createElement('option');
            option.value = item['nome_facilitador'] + ' <' + item['cargo'] + '>';
            option.text = item['nome_facilitador'] + ' <' + item['cargo'] + '>';
            select.appendChild(option);
    });

    var col3 = document.createElement('div');
    col3.className = 'col-3';
    var button = document.createElement('button');

        button.className = 'col-4 btn btn-success text-center';
        button.innerText = '+';
        col3.appendChild(button);
        col9.appendChild(select);
        mainContainer.appendChild(col9);
        newDiv.appendChild(mainContainer);
        newDiv.appendChild(col3);
        document.getElementById('addForm').appendChild(newDiv);
}