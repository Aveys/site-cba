
<div id="content" class="black">
                      
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Comptes
                </div>
                <div class="content articles">
                    <div class="center" >
                         <table>
                            <thead>
                                <th>Login</th><th>Mots de passe</th><th>Pseudo</th><th>E-mail</th><th>Date d'enregistrement</th><th>Status</th><th>Editer</th><th>Supprimer</th>
                            </thead>
                            <tbody>
                            <?php
                                $result = sql_all_users();
                                while ($row = mysql_fetch_assoc($result)) {
                                    //Faudrait rajouter une table pour les status
                                    //Gestion des status
                                    if(isset($row["USER_STATUS"]))
                                    {
                                        switch ($row["USER_STATUS"]) {
                                            case 0:
                                                $status = "Anonyme";
                                            break;
                                            case 1:
                                                $status = "Membres";
                                            break; 
                                            case 2:
                                                $status = "Admin";
                                            break;                                            
                                            default:break;
                                        }
                                    }
                                    //On remplit la table des comptes
                                    echo "<tr>";
                                        echo "<td>".$row["USER_LOGIN"]."</td>";                               
                                        echo "<td>".$row["USER_PASS"]."</td>";
                                        echo "<td>".$row["USER_DISPLAYNAME"]."</td>";
                                        echo "<td>".$row["USER_MAIL"]."</td>";
                                        echo "<td>".$row["USER_REGISTERED"]."</td>";
                                        echo "<td>".$status."</td>";                                        
                                        echo "<td><a href='?mode=editCompte&id=".$row["USER_ID"]."'><img src='img/icons/pencil.png' width='24' height='24'/></a></td>";
                                        echo "<td><a href='../stul_actions.php?mode=delCompte&id=".$row["USER_ID"]."'><img src='img/icons/trash.png' width='24' height='24'/></a></td>";
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
