
<div id="content" class="black">
                      
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Articles
                </div>
                <div class="content articles">
                    <div class="center" >
                         <table>
                            <thead class="head_table">
                                <th>Titre</th><th>Auteur</th><th>Catégories</th><th>Tags</th><th>Commentaires</th><th>Date</th><th>Edit</th><th>Supprimer</th>
                            </thead>
                            <tbody>
                            <?php
                                $result = sql_all_post();
                                while ($row = mysql_fetch_assoc($result)) {
                                    //Information sur l'utilisateur avec sont ID
                                    $infoUser = sql_info_user($row["USER_ID"]); 
                                    //Information sur la cat avec sont ID
                                    $infoCat = mysql_fetch_assoc(sql_allCat_of_idCat($row["CATEGORY_ID"])); 
                                    //On remplit la table des articles
                                    echo "<tr>";
                                        echo "<td>".$row["POST_TITLE"]."</td>";                               
                                        echo "<td>".$infoUser["USER_LOGIN"]."</td>";
                                        echo "<td>".$row["POST_TAG"]."</td>";
                                        echo "<td>".$infoCat["CATEGORY_NAME"]."</td>";
                                        echo "<td>".sql_count_com($row["POST_ID"])."</td>";
                                        echo "<td>".$row["POST_DATE"]."</td>";
                                        echo "<td><a href='?mode=editArticle&id=".$row["POST_ID"]."'><img alt='Stul' src='img/icons/pencil.png' width='24' height='24'/></a></td>";
                                        echo "<td><a href='../stul_actions.php?mode=delArticle&id=".$row["POST_ID"]."'><img alt='Stul' src='img/icons/trash.png' width='24' height='24'/></a></td>";
                                    echo "</tr>";    
                                                                
                                }
                            ?>
                            </tbody>
                        </table>
                        <div class="cb"></div>
                    </div>
                </div>
            </div>

           
</div>
