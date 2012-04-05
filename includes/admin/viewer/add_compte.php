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


                 <form method="post" action='../../../<?php echo $fAdminAction;?>' onSubmit="return valid(this)"> 
                    <div class="input textarea">
                    <p>
                        <label for="login">Login</label>
                        <input type="text" name="login" value='' onBlur="verifLogin(this)"/>
                    </p>
                    <p>
                        <label for="password">Mots de passe</label>
                        <input type="text" name="password" value='' onBlur="verifMdp(this)"/>
                        <span class="help-inline"></span>
                    </p> 
                    <p>
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" value='' onBlur="verifPseudo(this)"/>
                    </p>
                    <p>
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="email mailcheck" value='' onBlur="verifMail(this)"/>
						<span class="help-inline"></span>
                    </p>
                    <p>
                        <label for="dateReg">Date d'enregistrement</label>
                        <input type="text" name="dateReg"  value='<?php echo date("Y-m-d H:i:s");?>' readonly/>
                    </p>
                    <p>
                        <label for="status">Status (0:Anonyme 1:Membre 2:Admin)</label>                                             
                        <input type="text" name="status" value='' onBlur="verifStatus(this)"/>
                    </p>

                    </div>
                    <div class="input">                       
                            <input type="submit" value="Ajouter ce compte" name="action"/>                      
                    </div>
                  </form>
                </div>
            </div>

           
</div>