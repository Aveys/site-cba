<?php 

$idArticle = $_GET["id"];  

$result = sql_post_of_idPost($idArticle);
$row = mysql_fetch_assoc($result);

?>
<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Editer l'article "<?php echo $row["POST_TITLE"];?>"
                </div>
                <div class="content"> 
                 <form method="POST" action='../../../<?php echo $fAdminAction;?>'> 
                    <div class="input textarea">
                    <p>
                        <label for="textTitle">Titre</label>
                        <input type="text" name="title" value='<?php echo $row["POST_TITLE"];?>'/>
                    </p>
                    <p>
                        <label for="textarea2">Editer le texte</label>
                        <textarea name="article" rows="7" class="wysiwyg" cols="4">
                            <?php echo $row["POST_CONTENT"];?>
                        </textarea>
                    </p>
                    </div>
                    <input type="hidden" name="id_post" value='<?php echo $idArticle;?>'/>
                    <div class="input">
                       
                            <input type="submit" value="Mettre à jour" name="action"/>
                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
