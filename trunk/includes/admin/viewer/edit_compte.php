<?php 

$idUser = $_GET["id"];  

$row = sql_info_user($idUser);

?>
<div id="content" class="black">
            
                    
            <!--Bloc pour le mode Articles-->        
            <div class="bloc">
                <div class="title">            
                    Editer le compte de "<?php echo $row["USER_LOGIN"];?>"
                </div>
                <div class="content"> 
                 <form method="post" action='../../../<?php echo $fAdminAction;?>'> 
                    <div class="input textarea">
                    <p>
                        <label for="login">Login</label>
                        <input type="text" name="login" value='<?php echo $row["USER_LOGIN"];?>'/>
                    </p>
                    <p>
                        <label for="password">Mots de passe</label>
                        <input type="text" name="password" value='<?php echo $row["USER_PASS"];?>'/>
                    </p> 
                    <p>
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" value='<?php echo $row["USER_DISPLAYNAME"];?>'/>
                    </p>
                    <p>
                        <label for="email">E-mail</label>
                        <input type="text" name="email" value='<?php echo $row["USER_MAIL"];?>'/>
                    </p>
                    <p>
                        <label for="dateRegistred">Date d'enregistrement</label>
                        <input type="text" name="dateRegistred" disabled="" value='<?php echo $row["USER_REGISTERED"];?>'/>
                    </p>
                    <p>
                        <label for="status">Status (0:Anonyme 1:Membre 2:Admin)</label>                                             
                        <input type="text" name="status" value='<?php echo $row["USER_STATUS"];?>'/>
                    </p>

                    </div>
                    <input type="hidden" name="id_user" value='<?php echo $idUser;?>'/>
                    <div class="input">                       
                            <input type="submit" value="Mettre à jour le compte" name="action"/>                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>
