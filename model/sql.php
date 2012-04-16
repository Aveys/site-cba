<?php
   include_once($a_fmConnect);
   include_once($a_fmEscape);

/* FONCTIONS RELATIVES A LA RECHERCHE */
                     /*
                        recherche tous les posts ayant dans leur titre le mot $search
                     */
                     function sql_recherche_post_title($search)
                     {
                        return mysql_query("select * from STUL_POST where post_title LIKE '%".escape($search)."%'");
                     }
                     /*
                        recherche tous les posts ayant dans leur contenu le mot $search
                     */
                     function sql_recherche_post_content($search)
                     {
                        return mysql_query("select * from STUL_POST where post_content LIKE '%".escape($search)."%'");
                     }
                     /*
                        recherche tous les posts ayant dans leurs tags le mot search
                     */
                     function sql_recherche_post_tag($search)
                     {
                        return mysql_query("select * from STUL_POST where post_tag LIKE '%".escape($search)."%'");
                     }
                     /*
                        recherche tous les posts ayant un commentaire contenant le mot $search
                     */
                     function sql_recherche_com_content($search)
                     {
                        return mysql_query("select p.POST_ID,p.POST_TITLE,p.USER_ID,p.POST_DATE,p.CATEGORY_ID,p.POST_STATUS,p.POST_TYPE,p.POST_CONTENT,p.POST_TAG from STUL_POST p join STUL_COMMENT c on p.post_id=c.post_id where c.com_content LIKE '%".escape($search)."%'");
                     }
                     /*
                        recherche tous les posts ayant dans leurs com,tag,titre ou contenu le mot search
                     */
                     function sql_recherche($search)
                     {
                        $result[] = sql_recherche_post_title($search);
                        $result[] = sql_recherche_post_content($search);
                        $result[] = sql_recherche_post_tag($search);
                        $result[] = sql_recherche_com_content($search);
                        return $result;
                     }


/* FONCTIONS RELATIVES AUX CONNEXIONS ET AUX DECONNEXIONS D'UN UTILISATEUR INSCRIT */
                     /*
                        retourne un tableau d'id et de login de tous les utilisateurs connectés
                     */
                     function who_is_log()
                     {
                        $user_connect = array();
                        $result = mysql_query("select u.USER_ID,u.USER_LOGIN from STUL_LOG l join STUL_USERS u on l.user_id = u.user_id where l.date_deconnexion IS NULL");
                        while ($row = mysql_fetch_assoc($result)) {
                           if(!isset($_SESSION['id']) || $row['USER_ID'] != $_SESSION['id'])
                           $user_connect[] = array('id'=>$row['USER_ID'],'login'=>$row['USER_LOGIN']);
                        }
                        return $user_connect;
                     }
                     /* 
                        fonction qui test si on s'est bien connecte (bon pass et login) puis charge l'id et le login dans la variable de session
                     */
                     function sql_connexion_user($_POST)
                     {
                        if ( checkLogin($_POST["pseudo"], $_POST["mdp"])){
                           unset($_SESSION['erreur_connect']);
                           $_SESSION["login"] = $_POST["pseudo"];
                           $query = "select user_id from STUL_USERS where user_login='".escape($_POST["pseudo"])."' and user_pass='".escape(sha1($_POST["mdp"]))."'";
                           $result = mysql_query($query) or die(mysql_error());
                           $row = mysql_fetch_assoc($result);
                           $_SESSION["id"] = $row["user_id"];
                           sql_log_connexion();
                        }
                     }
                     /*
                        fonction qui ajoute la date de connexion de l'utilisateur actuel dans la table STUL_LOG
                     */
                     function sql_log_connexion()
                     {
                        if(isset($_SESSION['id']))
                        {
                           if(!is_connect($_SESSION['id']) && sql_date_add_few_minute(sql_datedeco_of_idlog(sql_last_connexion_of_iduser($_SESSION['id'])),1) <= sql_datetime_now())
                           {
                              $query = "insert into STUL_LOG(user_id,date_connexion,date_deconnexion) values('".escape($_SESSION['id'])."',now(),NULL)";
                              $result = mysql_query($query);
                           }
                           else if(!is_connect($_SESSION['id']))
                           {
                              mysql_query("update STUL_LOG set date_deconnexion = NULL where id='".escape(sql_last_connexion_of_iduser($_SESSION['id']))."'");
                           }
                        }
                     }
                     /*
                        renvoie l'id de la dernier connexion effectuer par l'utilisateur ayant l'id $id
                     */
                     function sql_last_connexion_of_iduser($id)
                     {
                        $result = mysql_query("SELECT id FROM `STUL_LOG` WHERE `USER_ID`='".$id."' order by `date_connexion` DESC");
                        if($result)
                        {
                           $row = mysql_fetch_assoc($result);
                           return $row['id'];
                        }
                        else
                           return NULL;
                     }
                     /*
                        renvoie la date et l'heure de deconnexion de l'id $id_log ou null si il est toujours connecté 
                     */
                     function sql_datedeco_of_idlog($id_log)
                     {
                        $result = mysql_query("SELECT date_deconnexion FROM `STUL_LOG` WHERE ID=".$id_log);
                        if($result)
                        {
                           $row = mysql_fetch_assoc($result);
                           return $row['date_deconnexion'];
                        }
                        else
                           return NULL;
                     }
                     /* 
                        test si l'utilisateur a rentrer le bon mot de pass et le bon login pour se connecte
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
                     /*
                        deconnecte ajoute la date et l'heure de deconnexion de l'utilisateur dans la table STUL_LOG
                     */
                     function sql_add_log_deconnexion()
                     {
                        if(isset($_SESSION['id']))
                           mysql_query("update STUL_LOG set date_deconnexion=now() where ID='".sql_last_connexion_of_iduser($_SESSION['id'])."' and date_deconnexion IS NULL");
                     }
                     /*
                        test si l'utilisateur ayant l'id $id_user est connecté
                     */
                     function is_connect($id_user)
                     {
                        $result = mysql_query("SELECT id FROM `STUL_LOG` WHERE `USER_ID`='".$id_user."' and date_deconnexion IS NULL");
                        if(mysql_num_rows($result) > 0)
                           return true;
                        else
                           return false;
                     }
                     /* 
                        fonction qui ajoute une connexion dans la table STUL_VISITES
                     */
                     function sql_new_connexion()
                     {
                        mysql_query('insert into STUL_VISITES(jour) values(now())');
                     }
                     /* 
                        fonction qui retourne le nombre de connexion à la date $date
                     */
                     function sql_number_of_connexion_date($date)
                     {
                        $result = mysql_fetch_assoc(mysql_query('select count(*) as "nb" from STUL_VISITES where jour="'.escape($date).'"'));
                        return $result['nb'];
                     }
                     /* 
                        fonction qui retourne le nombre de connexion durant la periode allant de $dateDebut à $dateFin
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
                     /*
                        retourne les 100 dernieres connexion effectuer en mode inscrit
                     */
                     function affiche_100_last_connexion()
                     {
                        return mysql_query("select * from STUL_LOG order by DATE_CONNEXION DESC LIMIT 100");
                     }

/* FONCTIONS RELATIVES A L'INSCRIPTION D'UN UTILISATEUR */
                     /* 
                        fonction admin qui permet d'ajouter un utilisateur en verifiant qu'il est pas deja le meme login dans la BDD
                     */
                     function sql_inscrire_user_by_admin($login, $pass, $pseudo, $email, $dateReg, $status)
                     {
                        $query = "select * from STUL_USERS where user_login='".$login."'";
                        $result=mysql_query($query);
                        if(mysql_num_rows($result) == 0)
                        {
                           mysql_query("insert into STUL_USERS (USER_LOGIN, USER_PASS, USER_DISPLAYNAME, USER_MAIL, USER_REGISTERED, USER_STATUS  ) 
                                                values ('".escape($login)."','".escape(sha1($pass))."','".escape($pseudo)."','".escape($email)."','".escape($dateReg)."', '".escape($status)."')"); 
                           echo '<script language="Javascript">document.location.replace("../../includes/admin/viewer/index.php?mode=editComptes");</script>';
                        }
                        else
                        {
                           $_SESSION["erreur_inscrip"] = "Ce login existe deja"; 
                           echo '<script language="Javascript">document.location.replace("../../includes/admin/viewer/index.php?mode=addCompte");</script>';
                        }
                     }
                     /* 
                        fonction qui permet d'ajouter un login avec son pass dans la bdd en test si le login n'existe pas deja
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
                     /* 
                        fonction qui insert un nouveau login avec son pass dans la bdd 
                     */
                     function addPseudo($pseudo, $mdp,$mail){
                           mysql_query("insert into STUL_USERS(USER_LOGIN, user_pass,user_mail) 
                                                values ('".escape($pseudo)."',
                                                      '".sha1(escape($mdp))."',
                                                      '".escape($mail)."')");
                     }

/* FONCTIONS RELATIVES AUX COMMENTAIRES */
                     /* 
                        fonction sql d'insertion dans la bdd d'un nouveau commentaire avec un lien sur un post
                     */
                     function sql_commenter($_POST)
                     {
                        if(isset($_POST['id_parent']))
                           $query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date,com_parent) values('".escape($_SESSION['id'])."','".escape($_POST['id'])."','".escape($_POST['commentaire'])."',now(),'".escape($_POST['id_parent'])."')";
                        else
                           $query = "insert into STUL_COMMENT(user_id,post_id,com_content,com_date) values('".escape($_SESSION['id'])."','".escape($_POST['id'])."','".escape($_POST['commentaire'])."',now())";
                        mysql_query($query);
                     }
                     /*
                        renvoie tous les commentaires rentrés dans la bdd
                     */
                     function sql_all_coms()
                     {
                        return mysql_query("select * from STUL_COMMENT");
                     }
                     /* 
                        return tout les commentaires correspond a l'idpost proposé
                     */
                     function sql_com_of_post_with_log($idPost)
                     {
                        return mysql_query("select c.com_id,u.user_login, u.user_id ,c.com_content,c.com_date,c.com_parent,c.post_id from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.post_id='".escape($idPost)."' order by c.com_date DESC");
                     }
                     /* 
                        return tout les commentaires correspond au commentaire proposé
                     */
                     function sql_com_of_com_post_with_log($idComParent)
                     {
                        return mysql_query("select * from STUL_COMMENT c join STUL_USERS u on c.user_id=u.user_id where c.com_parent='".escape($idComParent)."' order by c.com_date DESC");
                     }
                     /* 
                        supprime le commentaire proposé avec suppression de ses commentaires en cascade
                     */
                     function sql_delete_com($idCom)
                     {
                        mysql_query("delete from STUL_COMMENT where com_id='".escape($idCom)."'");
                        $result=sql_com_of_com_post_with_log($idCom);
                        while ($row = mysql_fetch_assoc($result)) {
                           sql_delete_com($row['com_id']);
                        }
                     }
                     /* 
                        edite le commentaire proposé
                     */
                     function sql_edit_com($post)
                     {
                        if(!isset($post['commentaire']))
                           $post['commentaire'] = $post['content'];
                        else
                           $post['commentaire'] = escape($post['commentaire']);
                        mysql_query("update STUL_COMMENT set com_content = '".$post['commentaire']."' where com_id='".escape($post['id_com'])."'");
                     }
                     /*
                        retourne toutes les infos de la table STUL_COMMENT du commentaire ayant l'id $comId
                     */
                     function sql_com_of_idCom($comId)
                     {
                        return mysql_query("select * from STUL_COMMENT c where c.com_id='".escape($comId)."'"); 
                     }
                     /*
                        retourne le nombre de commentaire du post ayant pour id $idPost
                     */ 
                     function sql_count_com($idPost)
                     {
                        $row = mysql_fetch_assoc(mysql_query("select count(*) as nb from STUL_COMMENT where POST_ID='".$idPost."'"));
                        return $row["nb"];
                     }

/* FONCTIONS RELATIVES AUX POSTS */
                     /* 
                        fonction sql d'insertion dans la bdd d'un nouveau post
                     */
                     function addArticle($texte, $pseudo,$title,$tag,$category,$file_img,$deja_upload){
                        if($deja_upload === false)
                        {
                           mysql_query("insert into STUL_UPLOAD(upload_filename, upload_dir, upload_date,upload_type,upload_description) values ('".escape($file_img['filename'])."','".escape($file_img['dir'])."',now(),'".escape($file_img['type'])."','".escape($title)."')");
                           mysql_query("insert into STUL_POST(post_content, user_id, post_date,post_title,post_tag,category_id,img_id) values ('".escape($texte)."','".escape($pseudo)."',now(),'".escape($title)."','".escape($tag)."','".escape($category)."','".mysql_insert_id()."')");
                        }
                        else if($deja_upload == "default")
                        {
                           if(($id_img=img_of_filename("image_default.jpg")) === false)
                              $id_img = 1;
                           mysql_query("insert into STUL_POST(post_content, user_id, post_date,post_title,post_tag,category_id,img_id) values ('".escape($texte)."','".escape($pseudo)."',now(),'".escape($title)."','".escape($tag)."','".escape($category)."','".$id_img."')");
                        }
                        else
                        {
                           if(($filename = strrchr($deja_upload, "/")) === false)
                              $filename = $deja_upload;
                           else
                           {
                              $tmp = explode("/", $filename);
                              $filename = $tmp[1];
                           }
                           if(($id_img=img_of_filename($filename)) === false)
                              $id_img = 1;
                           mysql_query("insert into STUL_POST(post_content, user_id, post_date,post_title,post_tag,category_id,img_id) values ('".escape($texte)."','".escape($pseudo)."',now(),'".escape($title)."','".escape($tag)."','".escape($category)."','".$id_img."')");
                        }

                        //mysql_query("insert into synchro_jaime_log(id_log, id_article, jaime) values ('".$pseudo."','".mysql_insert_id()."',0)");
                     }
                     /* 
                        fonction qui renvoie l'id de l'utilisateur ayant poster 
                     */
                     function sql_user_who_post($postId)
                     {
                        $rowLog=mysql_fetch_assoc(mysql_query("select u.USER_ID from STUL_POST p join STUL_USERS u on u.USER_ID=p.USER_ID where p.POST_ID='".escape($postId)."'"));
                        return $rowLog['USER_ID'];
                     }
                     /*
                        retourne tous les post dans l'ordre de date du plus recent au plus vieux
                     */
                     function sql_all_post()
                     {
                        return mysql_query("select * from STUL_POST p order by p.post_date DESC");
                     }
                     /* 
                        edite le post proposé
                     */
                     function sql_edit_post($post,$file_img,$deja_upload)
                     {
                        if($deja_upload === false)
                        {
                           mysql_query("insert into STUL_UPLOAD(upload_filename, upload_dir, upload_date,upload_type,upload_description) values ('".escape($file_img['filename'])."','".escape($file_img['dir'])."',now(),'".escape($file_img['type'])."','".escape($post['title'])."')");
                           mysql_query("update STUL_POST set post_content='".escape($post['content'])."', post_title='".escape($post['title'])."', post_tag='".escape($post["tags"])."', category_id='".escape($post["cat"])."', img_id='".mysql_insert_id()."' where post_id='".escape($post['id_post'])."'");
                        }
                        else if($deja_upload == "default")
                        {
                           if(($id_img=img_of_filename("image_default.jpg")) === false)
                              $id_img = 1;
                           mysql_query("update STUL_POST set post_content='".escape($post['content'])."', post_title='".escape($post['title'])."', post_tag='".escape($post["tags"])."', category_id='".escape($post["cat"])."', img_id='".$id_img."' where post_id='".escape($post['id_post'])."'");
                        }
                        else
                        {
                           if(($filename = strrchr($deja_upload, "/")) === false)
                              $filename = $deja_upload;
                           else
                           {
                              $tmp = explode("/", $filename);
                              $filename = $tmp[1];
                           }
                           if(($id_img=img_of_filename($filename)) === false)
                              $id_img = 1;
                           mysql_query("update STUL_POST set post_content='".escape($post['content'])."', post_title='".escape($post['title'])."', post_tag='".escape($post["tags"])."', category_id='".escape($post["cat"])."', img_id='".$id_img."' where post_id='".escape($post['id_post'])."'");
                        }
                     }
                     /* 
                        supprime le post proposé avec suppression de ses commentaires en cascade
                     */
                     function sql_delete_post($idPost)
                     {
                        mysql_query("delete from STUL_POST where post_id='".escape($idPost)."'");
                        $result=sql_com_of_post_with_log($idPost);
                        while ($row = mysql_fetch_assoc($result)) {
                           sql_delete_com($row['com_id']);
                        }
                     }
                     /*
                        retourne toutes les informations de la table STUL_POST de l'id $postId
                     */
                     function sql_post_of_idPost($postId)
                     {
                        return mysql_query("select * from STUL_POST p where p.post_id='".escape($postId)."'"); 
                     }
                     /*
                        test si le postId existe
                     */
                     function sql_post_exist($postId)
                     {
                        $result = sql_post_of_idPost($postId);
                        if(mysql_num_rows($result) > 0)
                           return true;
                        else
                           return false;
                     }
                     /*
                        renvoie le titre du post ayant pour id $postId
                     */
                     function sql_title_of_post($postId)
                     {
                        $row = mysql_fetch_assoc(sql_post_of_idPost($postId));
                        return $row['POST_TITLE'];
                     }
                     /*
                        retourne le nombre de post enregistré dans la bdd
                     */
                     function sql_count_post()
                     {
                        $row = mysql_fetch_assoc(mysql_query("select count(*) as nb from STUL_POST"));
                        return $row["nb"];
                     }
                     /*
                        retourne le chemin enregistré dan sla bdd de l'image uploadé du post ayant pour id $idPost
                     */
                     function img_of_post($idPost)
                     {
                        $result = mysql_fetch_assoc(mysql_query("select up.upload_filename,up.upload_dir from STUL_POST p join STUL_UPLOAD up on p.img_id=up.UPLOAD_ID where p.POST_ID='".$idPost."'"));
                        return $result['upload_dir'].$result['upload_filename'];
                     }

/* FONCTIONS RELATIVES AUX UTILISATEURS */
                     /*
                        Fonction pour editer completement le compte user
                     */
                     function sql_allEdit_user($idUser, $login, $pass, $pseudo, $email, $status)
                     {
                        mysql_query("update STUL_USERS set user_login='".escape($login)."', user_pass='".escape($pass)."', user_displayname='".escape($pseudo)."', user_mail='".escape($email)."', user_status='".escape($status)."' where user_id='".escape($idUser)."'");
                     }
                     /* 
                        fonction qui edite le profil demande
                     */
                     function sql_edit_user($_POST)
                     {
                        mysql_query("update STUL_USERS set mail = '".escape($_POST["mail"])."' where user_id='".escape($_POST["id"])."'");
                        // mysql_query("update log set date_naissance = '".$_POST["naissance"]."' where login='".$_POST["id"]."'");
                        echo "<script language='Javascript'>document.location.replace('./?page=profil&id=".$_POST["id"]."');</script>";
                     }
                     /* 
                        supprime le compte d'un utilisateur par sont ID
                     */
                     function sql_delete_user($idUser)
                     {
                        mysql_query("delete from STUL_USERS where user_id='".escape($idUser)."'");
                     }
                     /*
                        renvoie tous les utilisateurs inscrits dans la base
                     */
                     function sql_all_users()
                     {
                        return mysql_query("select * from STUL_USERS");
                     }
                     /* 
                        return le login en fonction de l'iduser
                     */
                     function sql_user_of_id($idUser)
                     {
                        $row = mysql_fetch_assoc((mysql_query("select user_login from STUL_USERS where user_id='".escape($idUser)."'")));
                        return $row["user_login"];
                     }
                     /* 
                        renvoie toutes les infos de l'utilisateur proposé
                     */
                     function sql_info_user($idUser)
                     {
                        return mysql_fetch_assoc(mysql_query("select * from STUL_USERS where user_id='".escape($idUser)."'"));
                     }
                     /* 
                        return le statut de l'utilisateur proposé (admin,visiteur,membre...)
                     */
                     function sql_user_status($idUser)
                     {
                        $row = mysql_fetch_assoc(mysql_query("select user_status from STUL_USERS where user_id='".escape($idUser)."'"));
                        return $row['user_status'];
                     }
                     /* 
                        test si l'idUser proposé existe dans la bdd
                     */
                     function idUser_exist($idUser)
                     {
                        if(sql_user_of_id($idUser))
                           return true;
                        else
                           return false;
                     }

/* FONCTIONS RELATIVES AUX CATEGORIES */
                     /*
                        retourne le nom de la categorie dont l'id est $num
                     */
                     function getCategory($num){
                        $result=mysql_fetch_assoc(mysql_query('select CATEGORY_NAME as "nom" from STUL_CATEGORY WHERE CATEGORY_ID = "'.$num.'";'));
                        return $result["nom"];
                     }
                     /*
                        retourne toutes les infos de la table STUL_CATEGORY sur toutes les categories
                     */
                     function sql_allCat(){
                        return mysql_query('select * from STUL_CATEGORY'); 
                     }
                     /*
                        retourne toutes les infos de la table STUL_CATEGORY de la categorue dont l'id est $idCat
                     */
                     function sql_allCat_of_idCat($idCat){
                        return mysql_query('select * from STUL_CATEGORY where CATEGORY_ID="'.$idCat.'"'); 
                     }
                     /*
                        edite la categorie dont l'id est $idCat
                     */
                     function sql_edit_cat_of_idCat($idCat,$content,$name){
                        mysql_query("update STUL_CATEGORY set CATEGORY_DESC='".($content)."', CATEGORY_NAME='".($name)."' where CATEGORY_ID='".($idCat)."'");
                     }
                     /* 
                        supprime la categorie dont l'id est $idCat
                     */
                     function sql_delete_cat($idCat)
                     {
                        mysql_query("delete from STUL_CATEGORY where CATEGORY_ID='".($idCat)."'");
                     }
                     /* 
                        fonction qui insert une nouvelle categorie dans la bdd 
                     */
                     function sql_add_cat($name, $desc){
                           mysql_query("insert into STUL_CATEGORY(CATEGORY_NAME, CATEGORY_DESC) values ('".($name)."','".($desc)."')");
                           echo '<script language="Javascript">document.location.replace("../../includes/admin/viewer/index.php?mode=editCats");</script>';
                     }

/* FONCTIONS RELATIVES AUX UPLOADS */
                     /*
                        retourne toutes les infos de la table STUL_UPLOAD de toutes les images
                     */
                     function all_image_upload()
                     {
                        return mysql_query("select * from STUL_UPLOAD where UPPER(upload_type)='IMG'");
                     }
                     /*
                        retourne l'id de l'image ayant pour nom de fichier $filename
                     */
                     function img_of_filename($filename)
                     {
                        $result = mysql_fetch_assoc(mysql_query("select UPLOAD_ID from STUL_UPLOAD up where up.upload_filename='".$filename."'"));
                        if($result)
                           return $result['UPLOAD_ID'];
                        else
                           return false;
                     }
                     /*
                        test si l'image ayant le chemin $path a déjà été uploadée et inscrite dans la bdd
                     */
                     function img_exist($path)
                     {
                        $code = md5(file_get_contents($path));
                        $result = all_image_upload();
                        while ($row_img = mysql_fetch_assoc($result)) {
                           $tab_url_img = explode(SITE,$row_img['upload_dir'].$row_img['upload_filename']);
                           if($code == md5(file_get_contents("../../".$tab_url_img[1])))
                           {
                              return $row_img;
                           }
                        }
                        return false;
                     }

/* FONCTIONS RELATIVES AUX MESSAGES */
                     /*
                        ajoute un message privé dans la bdd
                     */
                     function sql_add_message($id_receiver,$id_sender,$message)
                     {
                        mysql_query("insert into STUL_MESSAGE(SENDER_USER_ID,RECEIVER_USER_ID,message_text,message_date) values('".escape($id_sender)."','".escape($id_receiver)."','".escape($message)."',now())");
                     }
                     /*
                        retourne un tableau de l'id de l'envoyeur, de la date et du texte de tous les messages non lus échangés entre 2 utilisateurs
                     */ 
                     function sql_all_new_messages_of_user($id_user)
                     {
                        return mysql_query("select MESSAGE_ID,SENDER_USER_ID,RECEIVER_USER_ID,message_text,message_date from STUL_MESSAGE where (SENDER_USER_ID='".escape($id_user)."' AND message_read_sender=false) OR (RECEIVER_USER_ID='".escape($id_user)."' AND message_read_receiver=false) order by message_date ASC");
                     }
                     /*
                        retourne un tableau de l'id de l'envoyeur, de la date et du texte de tous les messages échangés entre 2 utilisateurs
                     */ 
                     function sql_all_messages_of_user($id_user1,$id_user2)
                     {
                        return mysql_query("select * from STUL_MESSAGE where (SENDER_USER_ID='".escape($id_user1)."' OR SENDER_USER_ID='".escape($id_user2)."') AND (RECEIVER_USER_ID='".escape($id_user1)."' OR RECEIVER_USER_ID='".escape($id_user2)."') order by message_date ASC");
                     }
                     /*
                        transforme un message non lu par l'envoyeur en message lu
                     */
                     function sql_message_lu_by_sender($id_message)
                     {
                        mysql_query("update STUL_MESSAGE set message_read_sender=true where MESSAGE_ID='".$id_message."'");
                     }
                     /*
                        transforme un message non lu par le destinataire en message lu
                     */
                     function sql_message_lu_by_receiver($id_message)
                     {
                        mysql_query("update STUL_MESSAGE set message_read_receiver=true where MESSAGE_ID='".$id_message."'");
                     }
                     /*
                        retourne toutes le infos de la table STUL_MESSAGE du message ayant l'id $id_message
                     */
                     function sql_message_of_id_message($id_message)
                     {
                        return mysql_fetch_assoc(mysql_query("select * from STUL_MESSAGE where MESSAGE_ID='".$id_message."'"));
                     }
/* FONCTIONS RELATIVES AUX DATES */
                     /*
                        fonction qui ajoute $minute a la date $date via le langage SQL
                     */
                     function sql_date_add_few_minute($date,$minute)
                     {
                        $row = mysql_fetch_assoc(mysql_query("select DATE_ADD('".$date."', INTERVAL ".$minute." MINUTE) as date"));
                        return $row['date'];
                     }
                     /*
                        fonction qui renvoie la date et l'heure actuel au format via le langage SQL
                     */
                     function sql_datetime_now()
                     {
                        $row = mysql_fetch_assoc(mysql_query("select now() as date"));
                        return $row['date'];
                     }