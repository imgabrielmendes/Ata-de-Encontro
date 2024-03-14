

var form = document.getElementById('selecionandoparticipante');
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
                window.alert("Você não escreveu nenhuma deliberação");
            } else {
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
            var newTextBox = document.createElement('input');
            newTextBox.setAttribute('type', 'text');
            newTextBox.setAttribute('id', 'item' + newItemCounter);
            newTextBox.setAttribute('class', 'form-control');
            newTextBox.setAttribute('placeholder', 'Adicionar nova tarefa...');
            document.getElementById('addForm').appendChild(newTextBox);
            newItemCounter++;
        }