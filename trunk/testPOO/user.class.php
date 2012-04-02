<?php
/*
* Classe de base du visiteur, 
* Contient l'ensemble des actions exécutable par un visiteur
* et les utilisateurs héritiers.
*/
	class User
	{
		protected $statut;
		
		public function __construct()
		{
			$this->statut = "visiteur";
		}
		public function getStatut()
		{
			return $this->statut;
		}
	}