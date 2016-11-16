<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Special{
		
		private $oId;
		private $oCode;
		private $oDescription;
				
		static function listSpecialByCustomer($CustomerId){
		
			$Database = new Database();
			$Special = $Database->Select("SELECT ".SPECIAL.".* FROM `".SPECIAL."` WHERE ".SPECIAL.".`customerid` = '".$CustomerId."' ORDER BY ".SPECIAL.".`description`", rows_object);
			
			foreach($Special as $oSpecial){
				$oReturn[] = Special::getSpecialById($oSpecial->id);
			}
			return $oReturn;
		
		}
		
		static function getSpecialById($oId){
		
			$Database = new Database();
			$Special = $Database->Select(
				"SELECT
					".SPECIAL.".*
				FROM
					`".SPECIAL."`
				WHERE
					".SPECIAL.".id = '".$oId."'
				LIMIT 1", rows_object);
			
			if(!count($Special)) return false;
			
			$oReturn = new Special();
			foreach($Special as $oSpecial){
				$oReturn->setId($oSpecial->id);
				$oReturn->setCode($oSpecial->code);
				$oReturn->setDescription($oSpecial->description);
			}
			
			return $oReturn;
		
		}
		
		function setId($oId){
			$this->oId = $oId;
		}
		
		function getId(){
			return $this->oId;
		}
		
		function setCode($oCode){
			$this->oCode = $oCode;
		}
		
		function getCode(){
			return $this->oCode;
		}
		
		function setDescription($oDescription){
			$this->oDescription = $oDescription;
		}
		
		function getDescription(){
			return $this->oDescription;
		}

	}
?>