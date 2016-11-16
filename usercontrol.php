<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');

#	Function User
	class User
	{
		static function data($item)
		{
			foreach(SYSTEMQUERY("SELECT * FROM `#__login` WHERE id='".$_SESSION['login']."'",$db,SELECT) as $userpanel);
			if($_SESSION['login']):
				switch($item)
				{
					case name:
						return $userpanel->name;
					break;
					case username:
						return $userpanel->username;
					break;
					case group:
						return $userpanel->group;
					break;
					case 'mail':
						return $userpanel->mail;
					break;
					case id:
						return $userpanel->id;
					break;	
					case owner:
						return $userpanel->owner;
					break;			
				}
			endif;
		}
	}
?>
