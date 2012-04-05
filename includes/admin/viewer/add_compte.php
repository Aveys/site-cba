<div id="content" class="black">
            
                    
           

             <!--Bloc pour le mode Comptes-->
            <div class="bloc">
                <div class="title">            
                    Ajouter un compte
                </div>
                <div class="content"> 
                <?php if(isset($_SESSION["erreur_inscrip"]))
                {           
                    ?>
                    <div class="notif error">
                         <?php echo $_SESSION["erreur_inscrip"]; ?>
                    </div>
                    <?php
                    unset($_SESSION["erreur_inscrip"]);
                }       
                ?>


                 <form method="POST" action='../../../<?php echo $fAdminAction;?>' onSubmit="return validLogin(this)"> 
                    <div class="input textarea">
                    <p>
                        <label for="login">Login</label>
                        <input type="text" name="login" class="login "value=''/>
                    </p>
                    <p>
                        <label for="password">Mots de passe</label>
                        <input type="text" name="password" value='' class="mdp"/>
                        <span class="help-inline"></span>
                    </p> 
                    <p>
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" value='' class='pseudo'/>
                    </p>
                    <p>
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="email mailcheck" value=''/>
						<span class="help-inline"></span>
                    </p>
                    <p>
                        <label for="dateReg">Date d'enregistrement</label>
                        <input type="text" name="dateReg"  value='<?php echo date("Y-m-d H:i:s");?>' readonly/>
                    </p>
                    <p>
                        <label for="status">Status (0:Anonyme 1:Membre 2:Admin)</label>                                             
                        <input type="text" name="status" value=''/>
                    </p>

                    </div>
                    <div class="input">                       
                            <input type="submit" value="Ajouter ce compte" name="action"/>                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>