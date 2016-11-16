<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Login{
		
		static function OnlineUsers($oLimit = false){
		
			$Database = new Database();
			$Database->Query("UPDATE `".LOGIN."` SET ".LOGIN.".`last_online` = '".time()."' WHERE ".LOGIN.".`id` = '".$_SESSION['login']."'");
			
			$Users = $Database->Select("
				SELECT
					".LOGIN.".`id`,
					".LOGIN.".`name`
				FROM
					`".LOGIN."`
				WHERE
					".LOGIN.".`active` = '1'
				AND
					".LOGIN.".`last_online` + 300 > ".time()."
				AND
					".LOGIN.".`id` != '".$_SESSION['login']."' AND owner IN (".App::UserSee().")
				ORDER BY
					".LOGIN.".`last_online`", rows_object);
			return $Users;
		
		}
		
		static function searchUsers($Search, $Limit = 20){
			
			$Database = new Database();
			$Users = $Database->Select("SELECT * FROM `".LOGIN."` WHERE ".LOGIN.".`name` LIKE '%".$Search."%' AND ".LOGIN.".`active` = '1' ORDER BY ".LOGIN.".`name` LIMIT ".$Limit, rows_object);
			return $Users;
		}	

	}
?>