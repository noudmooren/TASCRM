<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Settings{
		
		private $Key;
		private $Type;
		private $Fields;
		private $Description;
		private $Value;
				
		static function getSetting($Key){
		
			$Database = new Database();
			$Setting = $Database->Select("SELECT ".SETTINGS.".* FROM `".SETTINGS."` WHERE ".SETTINGS.".`system_key` = '".$Key."'", single_object);
			
			if(!count($Setting)) return false;
			
			if($Setting->system_type == "string")
				return $Setting->system_value;
			else
				return @json_decode($Setting->system_value, ($Setting->system_type == "array" ? true : false));
		
		}
		
		static function getSettingByKey($Key){
		
			$Database = new Database();
			$Setting = $Database->Select("SELECT ".SETTINGS.".* FROM `".SETTINGS."` WHERE ".SETTINGS.".`system_key` = '".$Key."'", single_object);
				
			$aSetting = new Settings();
			
			$aSetting->__set("Key", 		$Setting->system_key);
			$aSetting->__set("Type", 		$Setting->system_type);
			$aSetting->__set("Fields", 		$Setting->system_fields);
			$aSetting->__set("Description", $Setting->system_description);
			
			if($Setting->system_type == "string")
				$aSetting->__set("Value", 		$Setting->system_value);
			else
				$aSetting->__set("Value", 		@json_decode($Setting->system_value, ($Setting->system_type == "array" ? true : false)));
			
			return $aSetting;
		
		}
		
		static function listSettings(){
		
			$Database = new Database();
			$Settings = $Database->Select("SELECT ".SETTINGS.".* FROM `".SETTINGS."`", rows_object);
			
			$oReturn = array();
			foreach($Settings as $Setting){
				
				$aSetting = new Settings();
				
				$aSetting->__set("Key", 		$Setting->system_key);
				$aSetting->__set("Type", 		$Setting->system_type);
				$aSetting->__set("Fields", 		$Setting->system_fields);
				$aSetting->__set("Description", $Setting->system_description);
				
				if($Setting->system_type == "string")
					$aSetting->__set("Value", 		$Setting->system_value);
				else
					$aSetting->__set("Value", 		@json_decode($Setting->system_value, ($Setting->system_type == "array" ? true : false)));

				$oReturn[] = $aSetting;
			}
			
			return $oReturn;
		
		}
		
		public function __set($Key, $Value){
			$this->{$Key} = $Value;
		}
		
		public function __get($Key){
			return $this->{$Key};
		}

	}
?>