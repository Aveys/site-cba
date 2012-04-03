
<div id="content" class="black">
                      
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Articles
                </div>
                <div class="content articles">
                    <div class="center" >
                         <table>
                            <thead>
                                <th>Titre</th><th>Auteur</th><th>Catégories</th><th>Commentaires</th><th>Date</th><th>Edit</th><th>Supprimer</th>
                            </thead>
                            <tbody>
                            <?php
                                $result = sql_all_post();
                                while ($row = mysql_fetch_assoc($result)) {
                                    //Information sur l'utilisateur avec sont ID
                                    $infoUser = sql_info_user($row["USER_ID"]); 
                                    //On remplit la table des articles
                                    echo "<tr>";
                                        echo "<td>".$row["POST_TITLE"]."</td>";                               
                                        echo "<td>".$infoUser['user_login']."</td>";
                                        echo "<td>".$row["POST_CATEGORY"]."</td>";
                                        echo "<td>0</th>";
                                        echo "<td>".$row["POST_DATE"]."</td>";
                                        echo "<td><a href='?mode=editArticle&id=".$row["POST_ID"]."'><img src='img/icons/pencil.png' width='24' height='24'/></a></td>";
                                        echo "<td><a href='../stul_actions.php?mode=delArticle&id=".$row["POST_ID"]."'><img src='img/icons/trash.png' width='24' height='24'/></a></td>";
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
