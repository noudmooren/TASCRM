<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Departments{
		
		private $oId;
		private $oCode;
		private $oDescription;
		private $oCost;
		private $oOption;
		private $oGroup;
		
		static function listDepartments($oLimit = false){
		
			$Database = new Database();
			
			$Query = "SELECT ".DEPARTMENTS.".* FROM `".DEPARTMENTS."`";
			if($oLimit) $Query.= " LIMIT ".$oLimit;
			$Department = $Database->Select($Query, rows_object);
			
			foreach($Department as $oDepartment){
				$oReturn[] = Departments::getDepartmentsById($oDepartment->id);
			}
			return $oReturn;
		
		}
		
		static function listDepartmentsByCustomer($CustomerId, $See){
		
			$Database = new Database();
			if($See == 4){
				$Query = "SELECT ".DEPARTMENTS."_bd.* FROM `".DEPARTMENTS."_bd`  WHERE ".DEPARTMENTS."_bd.`option1` = '1' ORDER BY ".DEPARTMENTS."_bd.`departmentcode`";
				if($oLimit) $Query.= " LIMIT ".$oLimit;
			}
			else{
				$Query = "SELECT ".DEPARTMENTS.".* FROM `".DEPARTMENTS."`  WHERE ".DEPARTMENTS.".`option1` = '1' ORDER BY ".DEPARTMENTS.".`departmentcode`";
				if($oLimit) $Query.= " LIMIT ".$oLimit;
			}
			$Department = $Database->Select($Query, rows_object);
			
			$Customer = $Database->Select("SELECT * FROM `#__prices` WHERE `customerid`='".$CustomerId."' LIMIT 1", single_object);
			$Prices = App::MakeArray2($Customer->prices);

			foreach($Department as $oDepartment){
				if(array_key_exists($oDepartment->id,$Prices))
					$oReturn[] = Departments::getDepartmentsById($oDepartment->id, $See);
			}

			return $oReturn;
		
		}
		
		static function getDepartmentsById($oId, $See = false){
		
			$Database = new Database();
			if($See == 4){
				$Department = $Database->Select(
					"SELECT
						".DEPARTMENTS."_bd.*
					FROM
						`".DEPARTMENTS."_bd`
					WHERE
						".DEPARTMENTS."_bd.id = '".$oId."'
					LIMIT 1", rows_object);
			}
			else{
				$Department = $Database->Select(
					"SELECT
						".DEPARTMENTS.".*
					FROM
						`".DEPARTMENTS."`
					WHERE
						".DEPARTMENTS.".id = '".$oId."'
					LIMIT 1", rows_object);
			}
			
			if(!count($Department)) return false;
			
			$oReturn = new Departments();
			foreach($Department as $oDepartment){
				$oReturn->setId($oDepartment->id);
				$oReturn->setCode($oDepartment->departmentcode);
				$oReturn->setDescription($oDepartment->description);
				$oReturn->setCost($oDepartment->cost);
				$oReturn->setOption($oDepartment->option1);
				$oReturn->setGroup($oDepartment->group);
			}
			
			return $oReturn;
		
		}
		
		static function getDepartmentsNameById($oId, $See = false){
		
			$Database = new Database();
			$Department = $Database->Select(
				"SELECT
					".DEPARTMENTS.".*
				FROM
					`".DEPARTMENTS."`
				WHERE
					".DEPARTMENTS.".id = '".$oId."'
				LIMIT 1", single_object);
			
			return $Department->description;
		
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
		
		function setCost($oCost){
			$this->oCost = $oCost;
		}
		
		function getCost(){
			return $this->oCost;
		}
		
		function setOption($oOption){
			$this->oOption = $oOption;
		}
		
		function getOption(){
			return $this->oOption;
		}
		
		function setGroup($oGroup){
			$this->oGroup = $oGroup;
		}
		
		function getGroup(){
			return $this->oGroup;
		}

	}
?>