<?php 

$idArticle = $_GET["id"];  

$result = sql_post_of_idPost($idArticle);
$row = mysql_fetch_assoc($result);
$allCat = sql_allCat();

?>
<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Editer l'article "<?php echo $row["POST_TITLE"];?>"
                </div>
                <div class="content"> 
                 <form method="post" action='../../../<?php echo $fAdminAction;?>' enctype="multipart/form-data"> 
                    <div class="input textarea">
                    <p>
                        <label for="textTitle">Titre</label>
                        <input type="text" name="title" value='<?php echo $row["POST_TITLE"];?>'/>
                    </p>
                    <p>
                        <img id="miniature_image" alt="stul" src=
                        <?php 
                            $img = img_of_post($row['POST_ID']);
                            $tab_url_img = explode(SITE, $img); 
                            echo "'../../../".$tab_url_img[1]."' ";
                        ?>
                        onload="redimImage(200,200,this)" onchange="redimImage(200,200,this)" />   
                        <label for="image">Choisissez une image</label>
                            <input type="radio" name="image" value="image_up" id="image_up" onclick="affichage_champ_fichier('fichier_a_uploader');cacher_champ_fichier('fichier_existant');" />Image de votre ordinateur<span class="espace"></span>             
                            <input type="radio" name="image" value="image_default" id="image_default" onclick="cacher_champ_fichier('fichier_a_uploader');cacher_champ_fichier('fichier_existant');" />Image par défaut<span class="espace"></span>
                            <input type="radio" name="image" value="image_existante" id="radio_image_existante" checked="checked" onclick="affichage_champ_fichier('fichier_existant');cacher_champ_fichier('fichier_a_uploader');" />Image déjà uploadée </br>
                            <div id="fichier_existant" style="visibility: visible; height:auto; width:auto;"><select name="image_bdd" onclick="change_image(this)">
                                <?php
                                    $allImg = all_image_upload();
                                    while($rowImg=mysql_fetch_assoc($allImg)){
                                        $path = $rowImg["upload_dir"].$rowImg["upload_filename"];
                                        $tab_path_img = explode(SITE, $path);
                                        echo "<option value='".$tab_path_img[1]."' "; 
                                        if($rowImg['UPLOAD_ID'] == $row['IMG_ID'])
                                            echo "selected='selected'";
                                        echo ">".$rowImg['upload_description']."</option>";
                                    }
                                ?>
                            </select></div>
                            <div id="fichier_a_uploader"><input name="fichier" type="file" onchange="afficher_image_uploadee('fichier_a_uploader');" /></div>
                            <?php
                              if(isset($_SESSION['erreur_upload']) ) 
                              {
                                echo $_SESSION['erreur_upload'];
                              }
                            ?>
                    </p>
                     <p>
                        <label for="category">Categorie</label>
                        <?php
                            echo '<select name=cat>';
                                while($rowCat=mysql_fetch_assoc($allCat)){
                                    echo "<option value='".$rowCat['CATEGORY_ID']."' ";
                                    if ($rowCat['CATEGORY_ID'] == $row["CATEGORY_ID"]) {
                                        echo "selected='selected'";
                                    }
                                    echo ">".$rowCat['CATEGORY_NAME']."</option>";
                                }
                            echo '</select>';
                        ?>
                    </p>
                    <p>
                        <label for="tags">Tags</label>
                        <input type="text"  name="tags" value="<?php echo $row["POST_TAG"];?>"/>
                    </p>
                    <p>
                        <label for="content">Editer le texte</label>
                        <textarea name="content" rows="7" class="wysiwyg" cols="4">
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
