// Função para abrir o modal com os detalhes da linha clicada
function abrirModalDetalhes(registro) {
    var modalContent = document.getElementById("modalContent");
    var html = `
        <div class="row">
            <div class="col-3">
                <label><b>Solicitação:</b></label>
                <ul class="form-control bg-body-secondary">${registro.data_solicitada}</ul>
            </div>
            <div class="col-3">
                <label><b>Objetivo:</b></label>
                <ul class="form-control bg-body-secondary">${registro.objetivo}</ul>
            </div>
            <div class="col-3">
                <label><b>Facilitador:</b></label>
                <ul class="form-control bg-body-secondary">${registro.facilitador}</ul>
            </div>
            <div class="col-3">
                <label><b>Local:</b></label>
                <ul class="form-control bg-body-secondary">${registro.local}</ul>
            </div>
            <div class="col">
                <b>Tema:</b>
                <ul class="form-control bg-body-secondary">${registro.tema}</ul>
            </div>
        </div>`;
    modalContent.innerHTML = html;

    // Exibir o modal
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}

// Função para fechar o modal
function fecharModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}
