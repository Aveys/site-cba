
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
                     Graphique des historique de connexions
                </div>
                <div>
                    <div class="content" id="line">
                        <table class="graph type-line dots tips">
                        <!--<caption>Historique</caption>-->
                        <thead>
                        <tr>
                            <td>
                            </td>
                            <th scope="col">
                                00h00
                            </th>
                            <th scope="col">
                                01h00
                            </th>
                            <th scope="col">
                                02h00
                            </th>
                            <th scope="col">
                                03h00
                            </th>
                            <th scope="col">
                                04h00
                            </th>
                            <th scope="col">
                                05h00
                            </th>
                            <th scope="col">
                                05h00
                            </th>
                            <th scope="col">
                                05h00
                            </th>
                            <th scope="col">
                                06h00
                            </th>
                            <th scope="col">
                                07h00
                            </th>
                            <th scope="col">
                                08h00
                            </th>
                            <th scope="col">
                                09h00
                            </th>
                            <th scope="col">
                                10h00
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">
                                Nombre de connexion
                            </th>
                            <td>
                                1
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                5
                            </td>
                            <td>
                                10
                            </td>
                            <td>
                                50
                            </td>
                            <td>
                                2
                            </td>
                        </tr>                        
                        </tbody>
                        </table>
                    </div>
                   
     
                </div>
            </div>  

           
</div>
