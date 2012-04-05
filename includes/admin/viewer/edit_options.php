<div id="content" class="black">            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Options du site
                </div>
                <div class="content"> 
                 <form method="post" action='../../../<?php echo $fAdminAction;?>'> 
                    <div class="input textarea">
                    <p>
                        <label for="nameSite">Nom du site</label>
                        <input type="text" name="nameSite" value='TEST'/>
                    </p>
                     
                    <input type="hidden" name="id_post" value='<?php echo $idArticle;?>'/>
                    <div class="input">
                       
                            <input type="submit" value="Mettre à jour" name="action"/>
                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
