addItemButton.addEventListener('click', function() {
    var newItem = document.getElementById('item').value.trim();
    if (newItem === "") {
        Swal.fire({
            title: "Você não adicionou um participante",
            text: "Adicione pelo menos 1 participante para a ata",
            icon: "error"
        });
    } else {
        // Remove a caixa de texto existente
        var inputField = document.getElementById('item');
        inputField.parentNode.removeChild(inputField);

        // Cria um elemento <select>
        var selectElement = document.createElement('select');
        selectElement.id = 'selectItem';
        selectElement.className = 'form-control';

        // Cria uma opção padrão
        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'Selecione uma opção';
        selectElement.appendChild(defaultOption);

        // Adiciona opções ao <select> (exemplo)
        var options = ['Opção 1', 'Opção 2', 'Opção 3'];
        options.forEach(function(option) {
            var optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.text = option;
            selectElement.appendChild(optionElement);
        });

        // Adiciona o <select> ao DOM
        document.getElementById('inputFieldsContainer').appendChild(selectElement);
    }
});
