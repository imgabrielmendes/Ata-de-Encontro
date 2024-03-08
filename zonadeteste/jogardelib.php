 <div class="delibera">
                   <h2> Deliberações</h2>
                   <div> </div>
                   
                 </div> -->

          <!---CHECK DE FACILITADOR---->
          <!-- <form class="row" id="novadeliber">
         <div class="col">
              <label for="nomeFacilitador"><b>Informe o deliberador*:</b></label>
              <select type="text" class="form-control" id="nomeFacilitador">

                <option id="" disabled class="form-control disable" name="Informe os facilitadores da ata">Informe as deliberações*:</option> -->


          <!---FILTRAR APENAS FUNCIONÁRIOS DA ADM---->

          <!--<optgroup label="Sem cargos">
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
                      <option value="<?php echo $facarg['cargo'] ?>" 

                      data-tokens="<?php echo $facarg['nome_facilitador']; ?>">

                      <?php echo $facarg['nome_facilitador'] ?>
                </option>
                
                  <?php endforeach ?>
                </option>  -->

          <!---FILTRAR APENAS FUNCIONÁRIOS DA Coordenação---->
          <!-- <optgroup label="Coordenação">
              <option>
                    <?php foreach ($pegarcoo as $coordenador) : ?> 

                      <option value="<?php echo $coordenador['cargo'] ?>" 
                      data-tokens="<?php echo $coordenador['nome_facilitador']; ?>">
                      <?php echo $coordenador['nome_facilitador'] ?>

                      </option>
                        <?php endforeach ?>
                      </option> 

              <optgroup label="Supervisão">
                <option>SUP1</option>
                <option>SUP1</option>           
                            </select>  
                          </div> -->

          <!---CHECK DE FACILITADOR---->


          <!-- <div spellcheck="textarea" class="col-8">
                  <b>Informe as deliberações*</b>
                      <br> -->
          <!-- Um campo básico -->
          <!-- <input id="temaprincipal" class="form-control" type="text" /></div>
       
                </form>
                  <div class="row">
                    <div class="col"> 
                      <button type="submit" id="addelibe" class="add-button" value="+"> + </button> 
                    </div>
                  </div>   
  </form>                   