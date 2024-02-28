
    <?php 
    include ("conexao.php");
    include ("acoesform.php");

    ?>
    
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
      
        
            <div class="row">
                    <input type="hidden">
                    <div class="col">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="updateName" placeholder="Nome" disabled="">
                    </div>
                    <div class="col">
                        <label for="cont2">E-mail</label>
                        <input type="email" class="form-control" name="updateEmail" placeholder="E-mail">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Contato Um</label>
                        <input type="text" class="form-control" name="updateCont1" placeholder="Contato" value="84981361552" disabled="">
                    </div>
                    <div class="col">
                        <label for="cont2">Contato Dois</label>
                        <input type="text" class="form-control" name="updateCont2" placeholder="Contato" value="" disabled="">
                    </div>
                </div>
                <div class="row" style="margin: 5px;">
                    <div class="col">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control" name="updateRG" placeholder="RG" value="1734718" disabled="">
                    </div>
                    <div class="col">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" name="updateCPF" placeholder="CPF" value="03385038464" disabled="">
                    </div>
                </div>
                <div class="form-group" style="margin: 20px; margin-top: 0px;">
                    <label for="insti">Instituição</label>
                    <input type="text" class="form-control" name="updateInsti" placeholder="Instituição" value="CC-HRG" disabled="">
                </div>
                <div>
            
        
                <button type="button" data-toggle="modal" class="btn reset btn-labeled" style="color:#00a24d;" id="63"> 
                    <span class="btn-label"><i class="fas fa-sync"></i></span> 
                    <span>Resetar senha</span> 
                </button>
                <button type="button" data-toggle="modal" class="btn edit btn-labeled" style="color:#00a24d;" id="63"> 
                    <span class="btn-label">
                        <i class="far fa-edit"></i>
                    </span>
                    <span>Editar usuário</span>
                </button>
            </div>
        </div>
        </div>
    </body>
    </html>

