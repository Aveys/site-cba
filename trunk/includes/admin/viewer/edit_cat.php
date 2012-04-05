<?php 

$idCat = $_GET["id"];  

$result = sql_allCat_of_idCat($idCat);
$row = mysql_fetch_assoc($result);

?>
<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Editer la catégorie
                </div>
                <div class="content"> 
                 <form method="post" action='../../../<?php echo $fAdminAction;?>'> 
                    <div class="input textarea">
                    <p>
                        <label for="textTitle">Nom</label>
                        <input type="text" name="title" value='<?php echo $row["CATEGORY_NAME"];?>'/>
                    </p>
                    <p>
                        <label for="content">Description</label>
                        <textarea name="content" rows="7" class="wysiwyg" cols="4">
                            <?php echo $row["CATEGORY_DESC"];?>
                        </textarea>
                    </p>
                    </div>
                    <input type="hidden" name="id_cat" value='<?php echo $idCat;?>'/>
                    <div class="input">
                       
                            <input type="submit" value="Mettre à jour la categorie" name="action"/>
                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
