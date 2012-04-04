<?php 

$idCom = $_GET["id"];  

$result = sql_com_of_idCom($idCom);
$row = mysql_fetch_assoc($result);

?>
<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Editer le commentaire
                </div>
                <div class="content"> 
                 <form method="POST" action='../../../<?php echo $fAdminAction;?>'> 
                    <div class="input textarea">
                    <p>
                        <label for="content">Editer le texte</label>
                        <textarea name="content" rows="7" class="wysiwyg" cols="4">
                            <?php echo $row["COM_CONTENT"];?>
                        </textarea>
                    </p>
                    </div>
                    <input type="hidden" name="id_com" value='<?php echo $idCom;?>'/>
                    <div class="input">
                       
                            <input type="submit" value='Mettre à jour le commentaire' name="action"/>
                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
