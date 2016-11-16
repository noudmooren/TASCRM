<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Customers{
		
		private $Data 			= array();
		private	$PrefixCompany 	= "company_";
		
		static function listRelationsByCustomer($CustomerId){
			
			$Database = new Database();
			$Relations = $Database->Select("SELECT * FROM `".RELATIONS."` WHERE ".RELATIONS.".`customerid` = '".$CustomerId."'", rows_object);
			return $Relations;
		}
		
		static function getExtraFieldsByCustomerId($CustomerId){
			$Database = new Database();
			$Relations = $Database->Select("SELECT * FROM `".EXTRA_RELATIONS."` WHERE ".EXTRA_RELATIONS.".`customerid` = '".$CustomerId."' ORDER BY `id`", rows_object);
			$Return = array();
			foreach($Relations as $Key => $Relation){
				if($Relation->showincall == "true"){
					$Return["custom".($Key+1)] = $Relation;
				}
			}
			return $Return;
		}
		
		static function listRelationsPortal($CustomerId, $Limit = false, $Page = false, $Filter = false){
			
			$Database = new Database();
			
			if($Filter){
				
				$oSql = array();				
				$aSql = array();
				if($Filter["search"]["all"]){
					$aSql[] = RELATIONS.".`relationname` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`contactperson` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`address` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`zipcode` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`place` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`phonenumber` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`mobilenumber` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`mailaddress` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`birthdate` LIKE '%".$Filter["search"]["all"]."%'";
					
					$oSql[] = "(".implode(" OR ", $aSql).")";
				}
				
				$zSql = array();
				if($Filter["search"]["zipcode"]){
					$zSql[] = RELATIONS.".`zipcode` LIKE '%".$Filter["search"]["zipcode"]."%'";
					
					$oSql[] = "(".implode(" OR ", $zSql).")";
				}
				
				$pSql = array();
				if($Filter["search"]["phone"]){
					$pSql[] = RELATIONS.".`phonenumber` LIKE '%".$Filter["search"]["phone"]."%'";
					$pSql[] = RELATIONS.".`mobilenumber` LIKE '%".$Filter["search"]["phone"]."%'";
					
					$oSql[] = "(".implode(" OR ", $pSql).")";
				}
								
				$oResult = $Database->Select($Query = "
					SELECT
						*
					FROM
						`".RELATIONS."`
					WHERE
						".RELATIONS.".`customerid` = '".$CustomerId."'
						".($oSql ? " AND ".implode(" AND ",$oSql) : "")."
					ORDER BY
						".RELATIONS.".".($Filter["sort"] ? $Filter["sort"]." ".$Filter["dir"] : "relationname")."".
					($Filter["search"]["limit"] && $Page ? " LIMIT ".(($Page * $Filter["search"]["limit"]) - $Filter["search"]["limit"]).",".$Filter["search"]["limit"] : ""), rows_object);
			}
			else{
				$oResult = $Database->Select("SELECT * FROM `".RELATIONS."` WHERE ".RELATIONS.".`customerid` = '".$CustomerId."' ORDER BY ".RELATIONS.".`relationname`".($Limit && $Page ? " LIMIT ".(($Page * $Limit) - $Limit).",".$Limit : ""), rows_object);
			}
			
			$oReturn = array();
			foreach($oResult as $Result){
				$aCompany = new self();
				foreach($Result as $Key => $Company){
					$aCompany->__set(App::createKey($aCompany->PrefixCompany, $Key), $Company);	
				}
				$oReturn[] = $aCompany;
			}
			
			return $oReturn;
		}
		
		static function countRelationsPortal($CustomerId, $Filter = false){
			
			$Database = new Database();
			
			if($Filter){
				
				$oSql = array();				
				$aSql = array();
				if($Filter["search"]["all"]){
					$aSql[] = RELATIONS.".`relationname` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`contactperson` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`address` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`zipcode` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`place` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`phonenumber` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`mobilenumber` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`mailaddress` LIKE '%".$Filter["search"]["all"]."%'";
					$aSql[] = RELATIONS.".`birthdate` LIKE '%".$Filter["search"]["all"]."%'";
					
					$oSql[] = "(".implode(" OR ", $aSql).")";
				}
				
				$zSql = array();
				if($Filter["search"]["zipcode"]){
					$zSql[] = RELATIONS.".`zipcode` LIKE '%".$Filter["search"]["zipcode"]."%'";
					
					$oSql[] = "(".implode(" OR ", $zSql).")";
				}
				
				$pSql = array();
				if($Filter["search"]["phone"]){
					$pSql[] = RELATIONS.".`phonenumber` LIKE '%".$Filter["search"]["phone"]."%'";
					$pSql[] = RELATIONS.".`mobilenumber` LIKE '%".$Filter["search"]["phone"]."%'";
					
					$oSql[] = "(".implode(" OR ", $pSql).")";
				}
				
				$oResult = $Database->Select("
					SELECT
						COUNT(`id`) 'Count'
					FROM
						`".RELATIONS."`
					WHERE
						".RELATIONS.".`customerid` = '".$CustomerId."'
						".($oSql ? " AND ".implode(" AND ",$oSql) : ""), single_object);
			}
			else{
				$oResult = $Database->Select("SELECT COUNT(`id`) 'Count' FROM `".RELATIONS."` WHERE ".RELATIONS.".`customerid` = '".$CustomerId."'", single_object);
			}
					
			return $oResult->Count;
		}
		
		static function listSpecialitiesByCustomer($CustomerId){
			
			$Database = new Database();
			$Specialities = $Database->Select("SELECT ".SPECIALITIES.".*, ".MECHANICS.".`mechanicname` FROM `".SPECIALITIES."` LEFT JOIN `".MECHANICS."` ON ".MECHANICS.".`id` = ".SPECIALITIES.".`mechanic`  WHERE ".SPECIALITIES.".`customerid` = '".$CustomerId."' ORDER BY ".SPECIALITIES.".`datefrom`", rows_object);
			return $Specialities;
		}
		
		static function listSpecialitiesByCustomerToday($CustomerId){
			
			$Database = new Database();
			$Specialities = $Database->Select("SELECT * FROM `".SPECIALITIES."` WHERE ".SPECIALITIES.".`customerid` = '".$CustomerId."' AND ".SPECIALITIES.".`datefrom` <= '".date('Y-m-d')."' AND ".SPECIALITIES.".`dateto` >= '".date('Y-m-d')."' ORDER BY ".SPECIALITIES.".`dateto`", rows_object);
			
			$Specialities3 = array();
			
			$Specialities2 = $Database->Select($Q = "
			
				SELECT
					*
				FROM
					`".SPECIALITIES."`
				INNER JOIN
					`system_storing_connect`
				ON
					system_storing_connect.`customer_id` = ".SPECIALITIES.".`customerid`
				AND
					(
						system_storing_connect.`customer_id` = '".$CustomerId."'
							OR
						system_storing_connect.`customer_storing_id` = '".$CustomerId."'
					)
				WHERE
					".SPECIALITIES.".`datefrom` <= '".date('Y-m-d')."' AND
					".SPECIALITIES.".`dateto` >= '".date('Y-m-d')."' AND
					system_storing_connect.customer_specialities = 'true'
				GROUP BY
					".SPECIALITIES.".`id`
				ORDER BY
					".SPECIALITIES.".`dateto`
					
			", rows_object);
						
			if($Specialities2){
					
				foreach($Specialities2 as $oSpecialities){
					
					$Ids = explode(",",$oSpecialities->connect_ids);
					if(in_array($CustomerId, $Ids))
						$Specialities3[] = $oSpecialities;
				}			
			
				$Specialities = array_merge($Specialities,$Specialities3);
			
			}
			
			return $Specialities;
		}
		
		static function listSpecialitiesByMechanicToday($MechanicId){
			
			$Database = new Database();
			$Specialities = $Database->Select("SELECT * FROM `".SPECIALITIES."` WHERE ".SPECIALITIES.".`mechanic` = '".$MechanicId."' AND ".SPECIALITIES.".`datefrom` <= '".date('Y-m-d')."' AND ".SPECIALITIES.".`dateto` >= '".date('Y-m-d')."' ORDER BY ".SPECIALITIES.".`dateto`", rows_object);
			return $Specialities;
		}
		
		static function listSpecialitiesByMechanicTodayUrg($MechanicId){
			
			$Database = new Database();
			$Specialities = $Database->Select("SELECT COUNT(`id`) 'Counter' FROM `".SPECIALITIES."` WHERE ".SPECIALITIES.".`mechanic` = '".$MechanicId."' AND ".SPECIALITIES.".`datefrom` <= '".date('Y-m-d')."' AND ".SPECIALITIES.".`dateto` >= '".date('Y-m-d')."' AND ".SPECIALITIES.".`urgentie` = 'true'", single_object);
			return $Specialities->Counter > 0 ? true : false;
		}
		
		static function listStoringenByCustomer($CustomerId){
			
			$Database = new Database();
			$Storing = $Database->Select("SELECT ".STORING.".*, ".MECHANICS.".`mechanicname`, ".MECHANICS.".`phonenumber`, ".MECHANICS.".`mobilenumber`, ".MECHANICS.".`sms`, ".MECHANICS.".`mailaddress` FROM `".STORING."` LEFT JOIN `".MECHANICS."` ON ".MECHANICS.".`id` = ".STORING.".`name` WHERE ".STORING.".`customerid` = '".$CustomerId."' AND ".STORING.".`datefrom` <= '".date('Y-m-d')."' ORDER BY ".STORING.".`dateto`", rows_object);
			return $Storing;
		}
		
		static function listStoringenByCustomerToday($CustomerId){
			
			$Database = new Database();
			$Storing = $Database->Select("SELECT * FROM `".STORING."` LEFT JOIN `".MECHANICS."` ON ".MECHANICS.".`id` = ".STORING.".`name` WHERE ".STORING.".`customerid` = '".$CustomerId."' AND ".STORING.".`datefrom` <= '".date('Y-m-d')."' AND ".STORING.".`dateto` >= '".date('Y-m-d')."' ORDER BY ".STORING.".`dateto`", rows_object);
			
			$Storing3 = array();
			
			$Storing2 = $Database->Select("SELECT ".MECHANICS.".*, ".STORING.".* FROM `".STORING."` INNER JOIN `system_storing_connect` ON system_storing_connect.`customer_id` = ".STORING.".`customerid` AND (system_storing_connect.`customer_id` = '".$CustomerId."' OR system_storing_connect.`customer_storing_id` = '".$CustomerId."') LEFT JOIN `".MECHANICS."` ON ".MECHANICS.".`id` = ".STORING.".`name` WHERE ".STORING.".`datefrom` <= '".date('Y-m-d')."' AND system_storing_connect.`customer_storing` = 'true' AND ".STORING.".`dateto` >= '".date('Y-m-d')."' GROUP BY ".STORING.".`id` ORDER BY ".STORING.".`dateto`", rows_object);			
			
			if($Storing2){
					
				foreach($Storing2 as $oStoring){
					
					$Ids = explode(",",$oStoring->connect_ids);
					if(in_array($CustomerId, $Ids))
						$Storing3[] = $oStoring;
				}			
			
				$Storing = array_merge($Storing,$Storing3);
			
			}

			return $Storing;
		}
		
		static function listSpecialsByCustomer($CustomerId){
			
			$Database = new Database();
			$Specials = $Database->Select("
				SELECT
					*
				FROM
					`".SPECIAL_REQUESTS."`
				WHERE
					".SPECIAL_REQUESTS.".`customerid` = '".$CustomerId."'
				ORDER BY
					".SPECIAL_REQUESTS.".`createdate` DESC
				", rows_object);
				
			return $Specials;
		}
		
		static function listMechanicsByCustomer($CustomerId, $Json = false){
			
			$Database = new Database();
			$Mechanic = $Database->Select("SELECT * FROM `".MECHANICS."` WHERE ".MECHANICS.".`customerid` = '".$CustomerId."' ORDER BY ".MECHANICS.".`mechanicname`", rows_object);
			
			return $Json === false ? $Mechanic : @json_encode($Mechanic);
		}
		
		static function searchCustomers($Search, $Limit = 20){
			
			$Database = new Database();
			$Customers = $Database->Select("SELECT * FROM `".CUSTOMERS."` WHERE ".CUSTOMERS.".`customername` LIKE '%".addslashes(stripslashes(utf8_decode($Search)))."%' AND ".CUSTOMERS.".`active` = '1' AND ".CUSTOMERS.".`see` IN (".App::UserSee().") ORDER BY ".CUSTOMERS.".`customername` LIMIT ".$Limit, rows_object);
			return $Customers;
		}
		
		static function searchRelations($Id, $Finder, $Search, $Limit = 75){
			
			$Database = new Database();
			$Relation = $Database->Select("
				SELECT
					*
				FROM
					`".RELATIONS."`
				WHERE
					".RELATIONS.".`".$Finder."` LIKE '%".addslashes(stripslashes(utf8_decode($Search)))."%' AND
					".RELATIONS.".`customerid` = '".$Id."'
				ORDER BY
					".RELATIONS.".`".$Finder."`
				LIMIT ".$Limit, rows_object);
				
			return $Relation;
		}
		
		static function searchRelationsAddress($Id, $Search, $Limit = 50){
			
			$Database = new Database();
			$Relation = $Database->Select("
				SELECT
					*
				FROM
					`".RELATIONS."`
				WHERE
					".RELATIONS.".`address` LIKE '%".addslashes(stripslashes(utf8_decode($Search)))."%' AND
					".RELATIONS.".`address` != '' AND
					".RELATIONS.".`customerid` = '".$Id."'
				GROUP BY
					".RELATIONS.".`address`, ".RELATIONS.".`zipcode`, ".RELATIONS.".`place`
				ORDER BY
					".RELATIONS.".`address`
				LIMIT ".$Limit, rows_object);
				
			return $Relation;
		}
		
		static function searchRelationsZipcode($Id, $Finder, $Search, $Limit = 75){
			
			$Database = new Database();
			$Relation = $Database->Select("
				SELECT
					*
				FROM
					`".RELATIONS."`
				WHERE
					(
						".RELATIONS.".`zipcode` LIKE '%".addslashes(stripslashes(utf8_decode($Search)))."%' OR
						".RELATIONS.".`zipcode` LIKE '%".addslashes(stripslashes(utf8_decode(str_replace(" ","",urldecode($Search)))))."%'
					) AND ".RELATIONS.".`customerid` = '".$Id."'
				ORDER BY
					".RELATIONS.".`zipcode`, ".RELATIONS.".`address`, ".RELATIONS.".`number`
				LIMIT ".$Limit, rows_object);
				
			return $Relation;
		}
		
		static function searchRelationsNumber($Id, $Address, $Search){
			
			$Database = new Database();
			$Relation = $Database->Select($Query = "
				SELECT
					*
				FROM
					`".RELATIONS."`
				WHERE
					".RELATIONS.".`number` LIKE '".addslashes(stripslashes($Search))."%' AND
					".RELATIONS.".`address` LIKE '%".addslashes(stripslashes(utf8_decode($Address)))."%' AND
					".RELATIONS.".`customerid` = '".$Id."'
				ORDER BY
					".RELATIONS.".`number`
				", rows_object);
			
			return $Relation;
		}
		
		static function searchMechanics($Id, $Search, $Limit = 20){
			
			$Database = new Database();
			$Mechanic = $Database->Select("
				SELECT
					*
				FROM
					`".MECHANICS."`
				WHERE
					(
						".MECHANICS.".`mechanicname` LIKE '%".addslashes(stripslashes($Search))."%' OR
						".MECHANICS.".`phonenumber` LIKE '%".addslashes(stripslashes($Search))."%' OR
						".MECHANICS.".`mobilenumber` LIKE '%".addslashes(stripslashes($Search))."%' OR
						".MECHANICS.".`sms` LIKE '%".addslashes(stripslashes($Search))."%'
					) AND ".MECHANICS.".`customerid` = '".$Id."'
				ORDER BY
					".MECHANICS.".`mechanicname`
				LIMIT ".$Limit, rows_object);
			
			$Mechanic3 = array();
			
			$Mechanic2 = $Database->Select("SELECT * FROM `".MECHANICS."` INNER JOIN `system_storing_connect` ON system_storing_connect.`customer_id` = ".MECHANICS.".`customerid` AND (system_storing_connect.`customer_id` = '".$Id."' OR system_storing_connect.`customer_storing_id` = '".$Id."') WHERE  system_storing_connect.`customer_mechanics` = 'true' AND (
						".MECHANICS.".`mechanicname` LIKE '%".addslashes(stripslashes($Search))."%' OR
						".MECHANICS.".`phonenumber` LIKE '%".addslashes(stripslashes($Search))."%' OR
						".MECHANICS.".`mobilenumber` LIKE '%".addslashes(stripslashes($Search))."%' OR
						".MECHANICS.".`sms` LIKE '%".addslashes(stripslashes($Search))."%'
					) GROUP BY ".MECHANICS.".`id` ORDER BY ".MECHANICS.".`mechanicname`", rows_object);
			
			if($Mechanic2){
					
				foreach($Mechanic2 as $oMechanic){
					
					$Ids = explode(",",$oMechanic->connect_ids);
					if(in_array($Id, $Ids))
						$Mechanic3[] = $oMechanic;
				}			
			
				$Mechanic = array_merge($Mechanic,$Mechanic3);
			
			}
			
			return $Mechanic;
		}
		
		public function getMechanicsById($oId){
			
			$Database = new Database();
			$Mechanic = $Database->Select("SELECT * FROM `".MECHANICS."` WHERE ".MECHANICS.".`id` = '".$oId."' LIMIT 1", single_object);
			return $Mechanic;
		}
		
		public function getRelationsById($oId){
			
			$Database = new Database();
			$Relation = $Database->Select("SELECT * FROM `".RELATIONS."` WHERE ".RELATIONS.".`id` = '".$oId."' LIMIT 1", single_object);
			return $Relation;
		}
		
		public function getSpecialityById($oId){
			
			$Database = new Database();
			$Speciality = $Database->Select("SELECT * FROM `".SPECIALITIES."` WHERE ".SPECIALITIES.".`id` = '".$oId."' LIMIT 1", single_object);
			return $Speciality;
		}
		
		public function getStoringById($oId){
			
			$Database = new Database();
			$Storing = $Database->Select("SELECT * FROM `".STORING."` WHERE ".STORING.".`id` = '".$oId."' LIMIT 1", single_object);
			return $Storing;
		}
		
		static function getCustomerById($oId){
			
			$Database = new Database();
			$Customer = $Database->Select("SELECT * FROM `".CUSTOMERS."` WHERE ".CUSTOMERS.".`id` = '".$oId."' LIMIT 1", single_object);
			return $Customer;
		}
		
		public function __set($Key, $Var){
			$this->Data[$Key] = $Var;	
		}
		
		public function __get($Var){
			return $this->Data[$Var];	
		}

	}
?>