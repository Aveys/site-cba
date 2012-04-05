<?php
/* 
* Classe Administrateur
* Hérite de Membre
* Contient les attributs d'un admin et les actions
* qu'il peut effectuer
*/
	require_once("membre.class.php");
	class Admin extends Membre
	{
		protected static $_compteur = 0;
		public function __construct($data, $ident)
		{
			parent::__construct($data, $ident);
			self::$_compteur++;
			$this->statut = "admin";
		}
		public function __destruct()
		{
			self::$_compteur--;
		}
		public static function getNbAdmin()
		{
			return self::$_compteur;
		}
	}