
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
                                <th>Nom</th><th>Description</th><th>Edit</th><th>Supprimer</th>
                            </thead>
                            <tbody>
                            <?php
                                $result = sql_allCat();
                                while ($row = mysql_fetch_assoc($result)) {
                                    //On remplit la table des cat
                                    echo "<tr>";
                                        echo "<td>".$row["CATEGORY_NAME"]."</td>";                               
                                        echo "<td>".$row["CATEGORY_DESC"]."</td>";
                                        echo "<td><a href='?mode=editCat&id=".$row["CATEGORY_ID"]."'><img alt='Stul' src='img/icons/pencil.png' width='24' height='24'/></a></td>";
                                        echo "<td><a href='../stul_actions.php?mode=delCat&id=".$row["CATEGORY_ID"]."'><img alt='Stul' src='img/icons/trash.png' width='24' height='24'/></a></td>";
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
