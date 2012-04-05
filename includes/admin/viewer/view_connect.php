
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
            <div class="bloc">
                <div class="title">
                     Graphique des historiques de connexions
                </div>
                <div>
                <div id="graphique">
                    <div class="content" id="line">
                        <table class="graph type-line dots tips">
                        <!--<caption>Historique</caption>-->
                        <thead>
                        <tr>
                            <td>
                            </td>
                            <?php
                                $nb_col=24;
                                for ($i=0; $i <= $nb_col; $i++) { 
                                   echo "<th scope='col'>".$i."</th>";
                                }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                Nombre de connexion
                            </th>
                            <?php
                                $nb_col=24;
                                $date_debut=date('Y-m-d 00:i:s');
                                $date_fin=date('Y-m-d 00:i:s');
                                for ($i=0; $i <= $nb_col; $i++) { 
                                    $tmp = $date_debut;
                                    $tmp = str_replace(" 00:", " ".$i.":", $tmp);
                                    $tmp2 = $date_fin;
                                    $tmp2 = str_replace(" 00:", " ".($i+1).":", $tmp2);
                                    echo "<td>".sql_number_of_connexion_period($tmp,$tmp2)."</td>";
                                }
                            ?>
                        </tr>                        
                        </tbody>
                        </table>
                                <?php echo "$date_debut" ?>
                    </div>
                </div>
                </div>
            </div>  

           
</div>
