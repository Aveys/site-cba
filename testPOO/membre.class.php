<?php
	include_once("user.class.php");
	class Membre extends User
	{
		protected $email;
		protected $pseudo;
		protected $id;
		protected static $_compteur = 0;
		public function __construct(array $data, $ident)
		{
			parent::__construct();
			$this->pseudo = $data['pseudo'];
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
	}