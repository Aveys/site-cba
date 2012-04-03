<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Ajouter un article
                </div>
                <div class="content"> 
                 <form method="POST" action='../../../<?php echo $fAdminAction;?>'> 
                    <div class="input textarea">
                    <p>
                        <label for="textTitle">Titre</label>
                        <input type="text" id="title" name="title" class="." onFocus="empty(this)" onBlur="empty(this)" value=""/>
                    </p>
                    <p>
                        <label for="textarea2">Ajouter du texte</label>
                        <textarea name="content" id="test" rows="7" class="wysiwyg" cols="4">.</textarea>
                    </p>
                    </div>
                    <div class="input">
                       
                            <input type="submit" id="submit" value="Ajouter l'article" onSubmit="validForm()" name="action"/>
                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
