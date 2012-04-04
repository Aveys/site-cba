<?php
   include_once($a_fmConnect);
   include_once($a_fmEscape);
   /* fonction sql d'insertion dans la bdd d'un nouveau post
   */
   function addArticle($texte, $pseudo,$title,$tag,$category){
      mysql_query("insert into STUL_POST(post_content, user_id, post_date,post_title,post_tag,category_id) values ('".escape($texte)."','".escape($pseudo)."',now(),'".escape($title)."','".escape($tag)."','".escape($category)."')");
      //mysql_query("insert into synchro_jaime_log(id_log, id_article, jaime) values ('".$pseudo."','".mysql_insert_id()."',0)");
   }
   /* fonction sql d'insertion dans la bdd d'un nouveau commentaire avec un lien sur un post
   */
   function sql_commenter($_POST)
   {
      if(isset($_POST['id_parent']))
         $query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date,com_parent) values('".escape($_SESSION['id'])."','".escape($_POST['id'])."','".escape($_POST['commentaire'])."',now(),'".escape($_POST['id_parent'])."')";
      else
         $query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date) values('".escape($_SESSION['id'])."','".escape($_POST['id'])."','".escape($_POST['commentaire'])."',now())";
      mysql_query($query) or die(mysql_error());
   }
   /* fonction qui test si on s'est bien connecte (bon pass et login) puis charge l'id et le login dans la variable de session
   */
   function sql_connexion_user($_POST)
   {
      if ( checkLogin($_POST["pseudo"], $_POST["mdp"])){
         unset($_SESSION['erreur_connect']);
         $_SESSION["pseudo"] = $_POST["pseudo"];
         $query = "select user_id from STUL_USERS where user_login='".escape($_POST["pseudo"])."' and user_pass='".escape(sha1($_POST["mdp"]))."'";
         $result = mysql_query($query) or die(mysql_error());
         $row = mysql_fetch_assoc($result);
         $_SESSION["id"] = $row["user_id"];
      }
   }
   /* fonction admin qui permet d'ajouter un utilisateur en verifiant qu'il est pas deja le meme login dans la BDDD*/
   function sql_inscrire_user_by_admin($login, $pass, $pseudo, $email, $dateReg, $status)
   {
      $query = "select * from STUL_USERS where user_login='".$login."'";
      $result=mysql_query($query);
      if(mysql_num_rows($result) == 0)
      {
         mysql_query("insert into STUL_USERS (USER_LOGIN, USER_PASS, USER_DISPLAYNAME, USER_MAIL, USER_REGISTERED, USER_STATUS  ) 
                              values ('".escape($login)."','".escape($pass)."','".escape($pseudo)."','".escape($email)."','".escape($dateReg)."', '".escape($status)."')"); 
         echo '<script language="Javascript">document.location.replace("../../includes/admin/viewer/index.php?mode=editComptes");</script>';
      }
      else
      {
         $_SESSION["erreur_inscrip"] = "Ce login existe deja"; 
         echo '<script language="Javascript">document.location.replace("../../includes/admin/viewer/index.php?mode=addCompte");</script>';
      }
   }
   /* fonction qui permet d'ajouter un login avec son pass dans la bdd en test si le login n'existe pas deja
   */
   function sql_inscrire_user($_POST)
   {
      $query = "select * from STUL_USERS where user_login='".escape($_POST["pseudo"])."'";
      $result=mysql_query($query);
      if(mysql_num_rows($result) == 0)
      {
         addPseudo($_POST["pseudo"], $_POST["mdp"], $_POST["mail"]);
      }
      else
      {
         $_SESSION["erreur_inscrip"] = "Ce pseudo existe deja";
         echo '<script language="Javascript">document.location.replace("../?page=inscription");</script>';
      }
   }
   /* fonction qui insert un nouveau login avec son pass dans la bdd 
   */
   function addPseudo($pseudo, $mdp,$mail){
         mysql_query("insert into STUL_USERS(USER_LOGIN, user_pass,user_mail) 
                              values ('".escape($pseudo)."',
                                    '".sha1(escape($mdp))."',
                                    '".escape($mail)."')");
   }
   /* test si l'utilisateur a rentrer le bon mot de pass et le bon login pour se connecte
   */
   function checkLogin( $pseudo, $mdp){
      $result=mysql_query("select * from STUL_USERS");
      while($row=mysql_fetch_assoc($result)){
         if($pseudo == $row["USER_LOGIN"]){
            if(sha1($mdp) == $row["USER_PASS"])
               return true;
            else
               $_SESSION['erreur_connect'] = "Mauvais mot de passe";
         }
         else
            $_SESSION['erreur_connect'] = "Ce login n'existe pas, veuillez vous inscrire en cliquant sur le bouton inscription";
      }
      return false;
   }

   /*Fonction pour editer completement le compte user*/
   function sql_allEdit_user($idUser, $login, $pass, $pseudo, $email, $status)
   {
      mysql_query("update STUL_USERS set user_login='".escape($login)."', user_pass='".escape($pass)."', user_displayname='".escape($pseudo)."', user_mail='".escape($email)."', user_status='".escape($status)."' where user_id='".escape($idUser)."'");
   }
   /* fonction qui edite le profil demande
   */
   function sql_edit_user($_POST)
   {
      mysql_query("update STUL_USERS set mail = '".escape($_POST["mail"])."' where user_id='".escape($_POST["id"])."'");
      // mysql_query("update log set date_naissance = '".$_POST["naissance"]."' where login='".$_POST["id"]."'");
      echo "<script language='Javascript'>document.location.replace('./?page=profil&id=".$_POST["id"]."');</script>";
   }
   /* supprime le compte d'un utilisateur par sont ID
   */
   function sql_delete_user($idUser)
   {
      mysql_query("delete from STUL_USERS where user_id='".escape($idUser)."'");
   }
   /* fonction qui renvoie l'id de l'utilisateur ayant poster 
   */
   function sql_user_who_post($postId)
   {
      $rowLog=mysql_fetch_assoc(mysql_query("select u.USER_ID from STUL_POST p join STUL_USERS u on u.USER_ID=p.USER_ID where p.POST_ID='".escape($postId)."'"));
      return $rowLog['USER_ID'];
   }

   function sql_all_post()
   {
      return mysql_query("select * from STUL_POST");
   }
   function sql_all_users()
   {
      return mysql_query("select * from STUL_USERS");
   }
   function sql_all_coms()
   {
      return mysql_query("select * from STUL_COMMENT");
   }
   /* return tout les commentaires correspond a l'idpost proposé
   */
   function sql_com_of_post_with_log($idPost)
   {
      return mysql_query("select c.com_id,u.user_login, u.user_id ,c.com_content,c.com_date,c.com_parent,c.post_id from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.post_id='".escape($idPost)."' order by c.com_date");
   }
   /* return tout les commentaires correspond au commentaire proposé
   */
   function sql_com_of_com_post_with_log($idComParent)
   {
      return mysql_query("select * from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.com_parent='".escape($idComParent)."' order by c.com_date");
   }
   /* return le login en fonction de l'iduser
   */
   function sql_user_of_id($idUser)
   {
      $row = mysql_fetch_assoc((mysql_query("select user_login from STUL_USERS where user_id='".escape($idUser)."'")));
      return $row["user_login"];
   }
   /* renvoie toutes les infos de l'utilisateur proposé
   */
   function sql_info_user($idUser)
   {
      return mysql_fetch_assoc(mysql_query("select * from STUL_USERS where user_id='".escape($idUser)."'"));
   }
   /* return le statut de l'utilisateur proposé (admin,visiteur,membre...)
   */
   function sql_user_status($idUser)
   {
      $row = mysql_fetch_assoc(mysql_query("select user_status from STUL_USERS where user_id='".escape($idUser)."'"));
      return $row['user_status'];
   }
   /* test si l'idUser proposé existe dans la bdd
   */
   function idUser_exist($idUser)
   {
      if(sql_user_of_id($idUser))
         return true;
      else
         return false;
   }
   /* supprime le commentaire proposé avec suppression de ses commentaires en cascade
   */
   function sql_delete_com($idCom)
   {
      mysql_query("delete from STUL_COMMENT where com_id='".escape($idCom)."'");
      $result=sql_com_of_com_post_with_log($idCom);
      while ($row = mysql_fetch_assoc($result)) {
         sql_delete_com($row['com_id']);
      }
   }
   /* edite le commentaire proposé
   */
   function sql_edit_com($post)
   {
      if(!isset($post['commentaire']))
         $post['commentaire'] = $post['content'];
      else
         $post['commentaire'] = escape($post['commentaire']);
      mysql_query("update STUL_COMMENT set com_content = '".$post['commentaire']."' where com_id='".escape($post['id_com'])."'");
   }
   /* edite le post proposé
   */
   function sql_edit_post($post)
   {//post_content = '".$post['article']."'
      mysql_query("update STUL_POST set post_content='".escape($post['content'])."', post_title='".escape($post['title'])."', post_tag='".escape($post["tags"])."', post_category='".escape($post["category"])."' where post_id='".escape($post['id_post'])."'");
   }
   /* supprime le post proposé avec suppression de ses commentaires en cascade
   */
   function sql_delete_post($idPost)
   {
      mysql_query("delete from STUL_POST where post_id='".escape($idPost)."'");
      $result=sql_com_of_post_with_log($idPost);
      while ($row = mysql_fetch_assoc($result)) {
         sql_delete_com($row['com_id']);
      }
   }
   function sql_post_of_idPost($postId)
   {
      return mysql_query("select * from STUL_POST p where p.post_id='".escape($postId)."'"); 
   }
   function sql_com_of_idCom($comId)
   {
      return mysql_query("select * from STUL_COMMENT c where c.com_id='".escape($comId)."'"); 
   }
   function sql_post_exist($postId)
   {
      $result = sql_post_of_idPost($postId);
      if(mysql_num_rows($result) > 0)
         return true;
      else
         return false;
   }
   function sql_title_of_post($postId)
   {
      $row = mysql_fetch_assoc(sql_post_of_idPost($postId));
      return $row['POST_TITLE'];
   }
   function sql_recherche_post_title($search)
   {
      return mysql_query("select * from STUL_POST where post_title LIKE '%".escape($search)."%'");
   }
   function sql_recherche_post_content($search)
   {
      return mysql_query("select * from STUL_POST where post_content LIKE '%".escape($search)."%'");
   }
   function sql_recherche_post_tag($search)
   {
      return mysql_query("select * from STUL_POST where post_tag LIKE '%".escape($search)."%'");
   }
   function sql_recherche_com_content($search)
   {
      return mysql_query("select p.POST_ID,p.POST_TITLE,p.USER_ID,p.POST_DATE,p.CATEGORY_ID,p.POST_STATUS,p.POST_TYPE,p.POST_CONTENT,p.POST_TAG from STUL_POST p join STUL_COMMENT c on p.post_id=c.post_id where c.com_content LIKE '%".escape($search)."%'");
   }
   function sql_recherche($search)
   {
      $result[] = sql_recherche_post_title($search);
      $result[] = sql_recherche_post_content($search);
      $result[] = sql_recherche_post_tag($search);
      $result[] = sql_recherche_com_content($search);
      return $result;
   }
   /* fonction qui retourne le nombre de connexion à la date $date
   */
   function sql_number_of_connexion_date($date)
   {
      $result = mysql_fetch_assoc(mysql_query('select count(*) as "nb" from STUL_VISITES where jour="'.escape($date).'"'));
      return $result['nb'];
   }
   /* fonction qui retourne le nombre de connexion durant la periode allant de $dateDebut à $dateFin
   */
   function sql_number_of_connexion_period($dateDebut,$dateFin)
   {
      if($dateDebut > $dateFin)
      {
         $tmp = $dateFin;
         $dateFin = $dateDebut;
         $dateDebut = $tmp;
      }
      $result = mysql_fetch_assoc(mysql_query('select count(*) as "nb" from STUL_VISITES where jour >= "'.escape($dateDebut).'" and jour <= "'.$dateFin.'"'));
      return $result['nb'];
   }