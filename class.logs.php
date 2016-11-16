<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Logs{
		
		private $Id;
		private $CreateDate;
		private $CallId;
		private $CustomerId;
		private $Action;
		private $UserId;
		private $Comment;
		private $Data;
		
		public function getLogById($LogId){
			
			$Database = new Database();
			
			$Query = "
				SELECT
					".LOGS.".*,
					".LOGIN.".`name`,
					".CUSTOMERS.".`customername` 'customer_name'
				FROM
					`".LOGS."`
				JOIN
					`".LOGIN."`
				ON
					".LOGIN.".`id` = ".LOGS.".`userid`
				LEFT JOIN
					`".CUSTOMERS."`
				ON
					".CUSTOMERS.".`id` = ".LOGS.".`customer_id`
				WHERE
					".LOGS.".`log_id` = '".$LogId."'
				";
			$Log = $Database->Select($Query, single_object);

			return $Log;
			
		}
		
		static function Add($text, $callid = false, $customerid = false){
			
			$Database = new Database();
			
			$Database->Query("
				INSERT INTO
					`log_log`
				SET
					`call_id` 		= '".$callid."',
					`customer_id` 	= '".$customerid."',
					`userid` 		= '".$_SESSION['login']."',
					`comment`		= '".$text."',
					`data` 			= '".@urlencode(@json_encode($_POST))."'");
		}
		
		static function listLogs($oLimit = false, $oDate = false){
		
			$Database = new Database();
			
			$Query = "
				SELECT
					".LOGS.".*,
					".LOGIN.".`name`,
					".CUSTOMERS.".`customername` 'customer_name',
					".CUSTOMERS.".`see` 'customer_see'
				FROM
					`".LOGS."`
				JOIN
					`".LOGIN."`
				ON
					".LOGIN.".`id` = ".LOGS.".`userid`
				LEFT JOIN
					`".CUSTOMERS."`
				ON
					".CUSTOMERS.".`id` = ".LOGS.".`customer_id`
					" . ($oDate ? " WHERE ".LOGS.".`create_date` LIKE '".$oDate."%'" : "") . "
				ORDER BY
					".LOGS.".`create_date` DESC";
			if($oLimit) $Query.= " LIMIT ".$oLimit;
			$Logs = $Database->Select($Query, rows_object);

			return $Logs;
		
		}
		
		static function searchLogs($CustomerId, $UserId, $StartDate, $EndDate, $Limit = false){
		
			$Database = new Database();
			
			$oSql = array();
			
			if($StartDate && $EndDate) $oSql[] = LOGS.".`create_date` BETWEEN '".date("Y-m-d H:i:s",strtotime($StartDate))."' AND '".date("Y-m-d H:i:s",strtotime($EndDate." 23:59:59"))."'";
			if($CustomerId) $oSql[] = LOGS.".`customer_id` = '".$CustomerId."'";
			if($UserId) $oSql[] = LOGS.".`userid` = '".$UserId."'";
			
			$Query = "
				SELECT
					".LOGS.".*,
					".LOGIN.".`name`,
					".CUSTOMERS.".`customername` 'customer_name',
					".CUSTOMERS.".`see` 'customer_see'
				FROM
					`".LOGS."`
				JOIN
					`".LOGIN."`
				ON
					".LOGIN.".`id` = ".LOGS.".`userid`
				LEFT JOIN
					`".CUSTOMERS."`
				ON
					".CUSTOMERS.".`id` = ".LOGS.".`customer_id`
				".($oSql ? " WHERE ".implode(" AND ",$oSql)." " : "")."
				ORDER BY
					".LOGS.".`create_date` DESC";
			if($oLimit && !$StartDate && !$EndDate) $Query.= " LIMIT ".$oLimit;
			$Logs = $Database->Select($Query, rows_object);

			return $Logs;
		
		}

	}
?>