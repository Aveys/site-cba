<?php
    //require_once "../../../controller/controle_upload_image.php";
?>
<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Ajouter un article
                </div>
                <div class="content"> 
                 <form method="post" action='../../../<?php echo $fAdminAction;?>' onSubmit="return validArticle(this)" enctype="multipart/form-data"> 
                    <div class="input textarea">
                    <p>
                        <label for="title">Titre</label>
                        <input type="text"  name="title"  value="" onBlur="verifTitre(this)" id="title" />
                    </p>
                    <p>
                        <img id="miniature_image" alt="stul" src="../../../avatars/image_default.jpg" onload="redimImage(200,200,this)" onchange="redimImage(200,200,this)" />   
                        <label for="image">Choisissez une image</label>
                            <input type="radio" name="image" value="image_up" id="image_up" onclick="affichage_champ_fichier('fichier_a_uploader');cacher_champ_fichier('fichier_existant');" />Image de votre ordinateur<span class="espace"></span>             
                            <input type="radio" name="image" value="image_default" id="image_default" checked="checked" onclick="cacher_champ_fichier('fichier_a_uploader');cacher_champ_fichier('fichier_existant');" />Image par défaut<span class="espace"></span>
                            <input type="radio" name="image" value="image_existante" id="radio_image_existante" onclick="affichage_champ_fichier('fichier_existant');cacher_champ_fichier('fichier_a_uploader');" />Image déjà uploadée </br>
                            <div id="fichier_existant"><select name="image_bdd" onclick="change_image(this)">
                                <?php
                                    $allImg = all_image_upload();
                                    while($rowImg=mysql_fetch_assoc($allImg)){
                                        $path = $rowImg["upload_dir"].$rowImg["upload_filename"];
                                        $tab_path_img = explode(SITE, $path);
                                        echo "<option value='".$tab_path_img[1]."' >".$rowImg['upload_description']."</option>";
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
                            $allCat = sql_allCat();
                            echo '<select name=category >';
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
