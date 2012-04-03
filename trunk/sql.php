<?php
   include_once "connect.php";
$createtable= array("
drop table if exists STUL_COMMENT;
drop table if exists STUL_OPTIONS;
drop table if exists STUL_POST;
drop table if exists STUL_USERS;",
	"create table STUL_COMMENT
	(
	   COM_ID               int not null auto_increment,
	   USER_ID              int,
	   POST_ID              int not null,
	   COM_PARENT           int,
	   COM_CONTENT          text,
	   COM_DATE             datetime,
	   primary key (COM_ID)
	);",
	"alter table STUL_COMMENT comment 'table de commentaire';",
		"create table STUL_OPTIONS
		(
		   OP_ID                int not null auto_increment,
		   OP_NAME              varchar(500) not null,
		   OP_VALUE             text,
		   primary key (OP_ID, OP_NAME)
		);",
			"create table STUL_POST
			(
			   POST_ID              int not null auto_increment,
			   USER_ID              int,
			   POST_DATE            datetime,
			   POST_CATEGORY        int,
			   POST_STATUS          smallint,
			   POST_TYPE            smallint,
			   POST_CONTENT         text,
			   POST_TAG             text,
			   primary key (POST_ID)
			);",
				"create table STUL_USERS
				(
				   USER_ID              int not null auto_increment,
				   USER_LOGIN           varchar(100),
				   USER_PASS            varchar(100),
				   USER_DISPLAYNAME     varchar(100),
				   USER_MAIL            varchar(100),
				   USER_REGISTERED      datetime,
				   USER_STATUS          smallint,
				   primary key (USER_ID)
				);",
					"ALTER TABLE  STUL_USERS ADD UNIQUE (USER_DISPLAYNAME);
					
					alter table STUL_COMMENT add constraint FK_A foreign key (POST_ID)
						  references STUL_POST (POST_ID) on delete restrict on update restrict;
					
					alter table STUL_COMMENT add constraint FK_COMMENTE foreign key (USER_ID)
						  references STUL_USERS (USER_ID) on delete restrict on update restrict;
					
					alter table STUL_COMMENT add constraint FK_EST_PARENT foreign key (COM_PARENT)
						  references STUL_COMMENT (COM_ID) on delete restrict on update restrict;
					
					alter table STUL_POST add constraint FK_EST_L_AUTEUR foreign key (USER_ID)
						  references STUL_USERS (USER_ID) on delete restrict on update restrict;");
   
   function deleteArticle($id){
         $query="delete from STUL_POST where post_id='".$id."'";
         mysql_query($query) or die(mysql_error());
   }
   
   function addArticle($texte, $pseudo, $categorie){
      include_once "connect.php";
      $query="insert into STUL_POST(post_content, user_id, post_category, post_date) values ('".$texte."','".$pseudo."','".$categorie."',now())";
      mysql_query($query) or die(mysql_error());
      //$query="insert into synchro_jaime_log(id_log, id_article, jaime) values ('".$pseudo."','".mysql_insert_id()."',0)";
      //mysql_query($query) or die(mysql_error());
   }

   function sql_commenter($_POST)
   {
      if(isset($_POST['id_parent']))
         $query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date,com_parent) values('".$_SESSION['id']."','".$_POST['id']."','".htmlspecialchars($_POST['commentaire'])."',now(),'".$_POST['id_parent']."')";
      else
         $query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date) values('".$_SESSION['id']."','".$_POST['id']."','".htmlspecialchars($_POST['commentaire'])."',now())";
      mysql_query($query) or die(mysql_error());
   }

   function sql_connexion_user($_POST)
   {
      if ( checkLogin($_POST["pseudo"], $_POST["mdp"])){
         unset($_SESSION['erreur_connect']);
         $_SESSION["pseudo"] = $_POST["pseudo"];
         $query = "select user_id from STUL_USERS where user_login='".$_POST["pseudo"]."' and user_pass='".$_POST["mdp"]."'";
         $result = mysql_query($query) or die(mysql_error());
         $row = mysql_fetch_assoc($result);
         $_SESSION["id"] = $row["user_id"];
      }
   }

   function sql_inscrire_user($_POST)
   {
      $query = "select * from STUL_USERS where user_login='".$_POST["pseudo"]."'";
      $result=mysql_query($query);
      if(mysql_num_rows($result) == 0)
      {
         addPseudo($_POST["pseudo"], $_POST["mdp"], $_POST["mail"]);
      }
      else
      {
         $_SESSION["erreur_inscrip"] = "Ce pseudo existe deja";
         echo '<script language="Javascript">document.location.replace("inscription.php");</script>';
      }
   }
   
   function addPseudo($pseudo, $mdp,$mail){
      include_once "connect.php";
         $query="insert into STUL_USERS(USER_LOGIN, user_pass,user_mail) 
                              values ('".$pseudo."',
                                    '".$mdp."',
                                    '".$mail."')";
         mysql_query($query) or die(mysql_error());
   }
   
   function checkLogin( $pseudo, $mdp){
      $result=mysql_query("select * from STUL_USERS");
      while($row=mysql_fetch_assoc($result)){
         if($pseudo == $row["USER_LOGIN"]){
            if($mdp == $row["USER_PASS"])
               return true;
            else
               $_SESSION['erreur_connect'] = "Mauvais mot de passe";
         }
         else
            $_SESSION['erreur_connect'] = "Ce login n'existe pas, veuillez vous inscrire en cliquant sur le bouton inscription";
      }
      return false;
   }

   function sql_edit_user($_POST)
   {
      $query = "update STUL_USERS set mail = '".$_POST["mail"]."' where user_id='".$_POST["id"]."'";
      mysql_query($query) or die(mysql_error());
      /*$query = "update log set date_naissance = '".$_POST["naissance"]."' where login='".$_POST["id"]."'";
      mysql_query($query) or die(mysql_error());*/
      echo "<script language='Javascript'>document.location.replace('profil.php?id=".$_POST["id"]."');</script>";
   }

   function sql_user_who_post($postId)
   {
      $rowLog=mysql_fetch_assoc(mysql_query("select u.USER_ID from STUL_POST p join STUL_USERS u on u.USER_ID=p.USER_ID where p.POST_ID='".$postId."'"));
      return $rowLog['USER_ID'];
   }

   function sql_all_post()
   {
      return mysql_query("select * from STUL_POST p");
   }

   function sql_com_of_post_with_log($idPost)
   {
      return mysql_query("select c.com_id,u.user_login, u.user_id ,c.com_content,c.com_date,c.com_parent,c.post_id from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.post_id=".$idPost." order by c.com_date");
   }

   function sql_com_of_com_post_with_log($idComParent)
   {
      return mysql_query("select c.com_id,u.user_login, u.user_id ,c.com_content,c.com_date,c.com_parent from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.com_parent=".$idComParent." order by c.com_date");
   }

   function sql_user_of_id($idUser)
   {
      $row = mysql_fetch_assoc(mysql_query("select user_login from STUL_USERS where user_id=".$idUser));
      return $row["user_login"];
   }

   function sql_info_user($idUser)
   {
      return mysql_fetch_assoc(mysql_query("select user_mail, user_login from STUL_USERS where user_id=".$idUser));
   }

   function sql_user_status($idUser)
   {
      $row = mysql_fetch_assoc(mysql_query("select user_status from stul_users where user_id='".$idUser."'"));
      return $row['user_status'];
   }

   function idUser_exist($idUser)
   {
      if(sql_user_of_id($idUser))
         return true;
      else
         return false;
   }

   function sql_delete_com($idCom)
   {
      $query="delete from STUL_COMMENT where com_id='".$idCom."'";
      mysql_query($query) or die(mysql_error());
      $result=sql_com_of_com_post_with_log($idCom);
      while ($row = mysql_fetch_assoc($result)) {
         sql_delete_com($row['com_id']);
      }
   }

   function sql_delete_post($idPost)
   {
      $query="delete from STUL_POST where post_id='".$idPost."'";
      mysql_query($query) or die(mysql_error());
      $result=sql_com_of_post_with_log($idPost);
      while ($row = mysql_fetch_assoc($result)) {
         sql_delete_com($row['com_id']);
      }
   }