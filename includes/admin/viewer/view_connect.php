
<div id="content" class="black">
                      
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">
                    Comptes
                </div>
                <div class="content connexion">
                    <div class="center" >
                         <table>
                            <thead>
                                <th>Login</th><th>Debut connexion</th><th>Fin connexion</th>
                            </thead>
                            <tbody>
                            <?php
                                $result = affiche_100_last_connexion();
                                while ($row = mysql_fetch_assoc($result)) {
                                    //On remplit la table des comptes
                                    $infoUser = sql_info_user($row["USER_ID"]); 
                                    echo "<tr>";
                                        echo "<td>".$infoUser['USER_LOGIN']."</td>";                               
                                        echo "<td>".$row["date_connexion"]."</td>";
                                        if(isset($row["date_deconnexion"]))
                                            echo "<td>".$row["date_deconnexion"]."</td>";   
                                        else
                                            echo "<td>Toujours connecté</td>";
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
