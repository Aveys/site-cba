<?php
	class Membre
	{
		protected $pseudo;
		protected $email;
		
		public static function login(array $data)
		{
			$connexion = false;
			$req = mysql_query("SELECT pseudo FROM users");
			foreach(mysql_fetch_assoc($req) as $r)
			{
				if($data['pseudo'] == $r['pseudo'])
				{
					$connexion = true;
					$_SESSION['membre'] = new Membre($data, $r['ID']);
					break;
				}
			}
			return $connexion;	
		}
		public function __construct(array $data, $id)
		{
			$_SESSION['pseudo'] = $data['pseudo'];
			$pseudo =  $data['pseudo'];
			$_SESSION['ID'] = $id;
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