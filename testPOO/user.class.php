<?php
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