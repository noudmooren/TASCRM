<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Abbreviations{
		
		private $oId;
		private $oCode;
		private $oDescription;
		
		static function searchAbbreviation($Search = false, $oReseller = 1, $oCompany = false){
		
			$Database = new Database();
			if($oReseller == 4)
				$Abbreviation = $Database->Select("SELECT ".ABBREVIATIONS_BD.".* FROM `".ABBREVIATIONS_BD."` WHERE `description` LIKE '%".$Search."%' LIMIT 30", rows_object);
			else
				$Abbreviation = $Database->Select("SELECT ".ABBREVIATIONS.".* FROM `".ABBREVIATIONS."` WHERE `description` LIKE '%".$Search."%' ".($oCompany ? " AND (`companyid` IN ('0','') OR `companyid` LIKE '%".$oCompany."%') " : "")." LIMIT 30", rows_object);
			
			$oReturn = array();
			foreach($Abbreviation as $oAbbreviation){
				$oReturn[] = Abbreviations::getAbbreviationsById($oAbbreviation->id, $oReseller);
			}
			return $oReturn;
		
		}
		
		static function listAbbreviations($oLimit = false, $oReseller = 1, $oCompany = false){
		
			$Database = new Database();
			if($oReseller == 4)
				$Abbreviation = $Database->Select("SELECT ".ABBREVIATIONS_BD.".* FROM `".ABBREVIATIONS_BD."`".($oLimit ? " LIMIT ".$oLimit : ""), rows_object);
			else
				$Abbreviation = $Database->Select("SELECT ".ABBREVIATIONS.".* FROM `".ABBREVIATIONS."` ".($oCompany ? " WHERE (`companyid` IN ('0','') OR `companyid` LIKE '%".$oCompany."%') " : "")." ".($oLimit ? " LIMIT ".$oLimit : ""), rows_object);
			
			$oReturn = array();
			foreach($Abbreviation as $oAbbreviation){
				$oReturn[] = Abbreviations::getAbbreviationsById($oAbbreviation->id, $oReseller);
			}
			return $oReturn;
		
		}
		
		static function getAbbreviationsById($oId, $oReseller = 1){
		
			$Database = new Database();
			if($oReseller == 4)
				$Abbreviation = $Database->Select("SELECT ".ABBREVIATIONS_BD.".* FROM `".ABBREVIATIONS_BD."` WHERE ".ABBREVIATIONS_BD.".id = '".$oId."' LIMIT 1", rows_object);
			else
				$Abbreviation = $Database->Select("SELECT ".ABBREVIATIONS.".* FROM `".ABBREVIATIONS."` WHERE ".ABBREVIATIONS.".id = '".$oId."' LIMIT 1", rows_object);
			
			if(!count($Abbreviation)) return false;
			
			$oReturn = new Abbreviations();
			foreach($Abbreviation as $oAbbreviation){
				$oReturn->setId($oAbbreviation->id);
				$oReturn->setCode($oAbbreviation->code);
				$oReturn->setDescription($oAbbreviation->description);
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