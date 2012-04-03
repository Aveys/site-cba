<?php
/* 
* Classe du membre de base
* hérite de la classe User, 
* COntient les informations de base du membres
* et les actions que lui et utilisateurs héritiers peuvent
* effectuer
*/

	require_once("user.class.php");
	class Membre extends User
	{
		protected $email;
		protected $pseudo;
		protected $id;
		protected static $_compteur = 0;
		public function __construct($data, $ident)
		{
			parent::__construct();
			$this->pseudo = $data;
			$this->id = $ident;
			$this->statut = "membre";
			self::$_compteur++;
		}
		public function __destruct()
		{
			self::$_compteur--;
		}
		public function getPseudo()
		{
			return $this->pseudo;
		}
		public function setPseudo($new)
		{
			$this->pseudo = $new;
		}
		public function getEmail()
		{
			return $this->email;
		}
		public function setEmail($new)
		{
			$this->email = $new;
		}
		public static function getNbMembre()
		{
			return (self::$_compteur - Admin::getNbAdmin());
		}
	}