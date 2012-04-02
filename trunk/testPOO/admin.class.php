<?php
	include_once("membre.class.php");
	class Admin extends Membre
	{
		protected static $_compteur = 0;
		public function __construct(array $data, $ident)
		{
			parent::__construct($data, $ident);
			self::$_compteur++;
			$this->statut = "admin";
		}
		public function __destruct()
		{
			self::$_compteur--;
		}
	}