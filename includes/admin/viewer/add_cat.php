<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Ajouter un article
                </div>
                <div class="content"> 
                 <form method="post" action='../../../<?php echo $fAdminAction;?>' onSubmit="return validArticle(this)"> 
                    <div class="input textarea">
                    <p>
                        <label for="name">Nom</label>
                        <input type="text"  name="name" value="" onBlur="verifTitre(this)"/>
                    </p>
                    <p>
                        <label for="desc">Description</label>
                        <textarea name="desc" id="test" rows="7" class="wysiwyg" cols="4" onBlur="verifText(this)"></textarea>
                    </p>
                    </div>
                    <div class="input">                       
                            <input type="submit" id="submit" value="Ajouter cette categorie" name="action"/>                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
