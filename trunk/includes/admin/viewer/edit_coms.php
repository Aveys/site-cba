
<div id="content" class="black">
                      
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Commentaire(s)
                </div>
                <div class="content coms">
                    <div class="center" >
                         <table>
                            <thead>
                                <th>Auteur</th><th>Titre du post</th><th>Commentaires</th><th>Date</th><th>Edit</th><th>Supprimer</th>
                            </thead>
                            <tbody>
                            <?php
                                $result = sql_all_coms();
                                while ($row = mysql_fetch_assoc($result)) {
                                    //Information sur l'utilisateur avec sont ID
                                    if(!isset($row["COM_PARENT"]))
                                    {
                                        $infoUser = sql_info_user($row["USER_ID"]); 
                                        $infoPost = mysql_fetch_assoc(sql_post_of_idPost($row["POST_ID"])); 
                                        //On remplit la table des articles
                                        echo "<tr>";                               
                                            echo "<td>".$infoUser["USER_LOGIN"]."</td>";
                                            echo "<td>".$infoPost["POST_TITLE"]."</td>";
                                            echo "<td>".$row["COM_CONTENT"]."</td>";
                                            echo "<td>".$row["COM_DATE"]."</td>";
                                            echo "<td><a href='?mode=editCom&id=".$row["COM_ID"]."'><img alt='Stul' src='img/icons/pencil.png' width='24' height='24'/></a></td>";
                                            echo "<td><a href='../stul_actions.php?mode=delCom&id=".$row["COM_ID"]."'><img alt='Stul' src='img/icons/trash.png' width='24' height='24'/></a></td>";
                                        echo "</tr>";
                                        afficheComOfComAdmin($row["COM_ID"]);
                                    }                                                                
                                }
                            ?>
                            </tbody>
                        </table>
                        <div class="cb"></div>
                    </div>
                </div>
            </div>

           
</div>
<?php
/*  affiche les commentaires du commentaire proposé avec ajout des formulaires d'ajout et de suppression de ces coms
*/
function afficheComOfComAdmin($id_com_parent)
{
    $result = sql_com_of_com_post_with_log($id_com_parent);
    if(mysql_num_rows($result) > 0){
            echo "</table>";
            echo "<div id='comOfCom'>";            
            /*?><div class="title">
                Commentaire(s) du commentaire
            </div><?php*/
            echo "<table>";
            echo "<tbody>";
            while ($row = mysql_fetch_assoc($result)) {
                //Information sur l'utilisateur avec sont ID
                $infoUser = sql_info_user($row["USER_ID"]); 
                $infoPost = mysql_fetch_assoc(sql_post_of_idPost($row["POST_ID"])); 
                //On remplit la table des articles
                echo "<tr>";                               
                    echo "<td style='background-color: white;'>".$infoUser["USER_LOGIN"]."</td>";
                    echo "<td style='background-color: white;'>".$infoPost["POST_TITLE"]."</td>";
                    echo "<td style='background-color: white;'>".$row["COM_CONTENT"]."</td>";
                    echo "<td style='background-color: white;'>".$row["COM_DATE"]."</td>";
                    echo "<td style='background-color: white;'><a href='?mode=editCom&id=".$row["COM_ID"]."'><img alt='Stul' src='img/icons/pencil.png' width='24' height='24'/></a></td>";
                    echo "<td style='background-color: white;'><a href='../stul_actions.php?mode=delCom&id=".$row["COM_ID"]."'><img alt='Stul' src='img/icons/trash.png' width='24' height='24'/></a></td>";
                echo "</tr>";                                                     
            }
            echo "</tbody></table>";
            echo "</div>";
            echo "<table>";
    }
}
?>
