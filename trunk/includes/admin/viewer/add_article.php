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
                        <label for="title">Titre</label>
                        <input type="text"  name="title"  value="" onBlur="verifTitre(this)"/>
                    </p>
                     <p>
                        <label for="category">Categorie</label>
                        <?php
                            $allCat = sql_allCat();
                            echo '<select name=category>';
                                while($rowCat=mysql_fetch_assoc($allCat)){
                                    echo "<option value='".$rowCat['CATEGORY_ID']."'>".$rowCat['CATEGORY_NAME']."</option>";
                                }
                            echo '</select>';
                        ?>
                    </p>
                    <p>
                        <label for="tags">Tags</label>
                        <input type="text"  name="tags" value="" onBlur="verifTags(this)"/>
                    </p>
                    <p>
                        <label for="content">Ajouter du texte</label>
                        <textarea name="content" id="test" rows="7" class="wysiwyg" cols="4" onBlur="verifText(this)"></textarea>
                    </p>
                    </div>
                    <div class="input">                       
                            <input type="submit" id="submit" value="Ajouter article" name="action"/>                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
