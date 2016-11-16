<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	class Database
	{
		private $dbhost 	= 'localhost';
		private $dbuser 	= 'tas_system';
		private $dbpass 	= '2zmi95dV';
		private $dbname 	= 'tas_system';
		private $dbprefix 	= 'system_';
		
		function __construct(){
		#	Database connection	
			$db = @mysql_connect($this->dbhost, $this->dbuser, $this->dbpass);
		  	@mysql_select_db($this->dbname,$db);
		}
		
		function Select($Query,$Mode = false){
		#	Replace Prefix
			$Query = str_replace('#__', $this->dbprefix, $Query);
				
		#	Make MYSQL connection
			//App::debug($Query);
			$oQuery = mysql_query($Query) or die (ErrorReporing::Message(mysql_error(),$Query));		
			
			switch($Mode){
				
				case single_array:
					return mysql_fetch_assoc($oQuery);
				break;
				case single_object:
					return mysql_fetch_object($oQuery);
				break;
				case rows_object:
					$aReturn = array();
					while($oResult = mysql_fetch_object($oQuery)){
						$aReturn[] = $oResult;
					}
					return $aReturn;
				break;
				case rows_array:
					$aReturn = array();
					while($oResult = mysql_fetch_assoc($oQuery)){
						$oReturn[] = $oResult;
					}
					return $oReturn;
				break;
				default:
					return $oQuery;
				break;
			}
		}
			
		function Update($query,$id,$value){
			
		#	Replace Prefix
			$query = str_replace('#__', $this->dbprefix, $query);				
			
		#	Get Database Coloms
			$oquery = "SHOW COLUMNS FROM `".$query."`";
			//App::debug($oquery);
			$oquery = mysql_query($oquery) or die (ErrorReporing::Message(mysql_error(),$oquery));
				
			for($i; $data[] = mysql_fetch_object($oquery); $i++);
			array_pop($data);
			$line = array();
			
		#	Combinate POST data with Database Coloms
			foreach($data as $dbdata){
				
				if($dbdata->Field != $id){

					if(is_array($_POST[$dbdata->Field])){
						if(@array_key_exists("date",$_POST[$dbdata->Field]))
							$line[] = "`".$dbdata->Field."` = '".date('Y-m-d',strtotime($_POST[$dbdata->Field]['date']))."'";
						elseif(@array_key_exists("pass",$_POST[$dbdata->Field]))
							if($_POST[$dbdata->Field]['pass']) if($_POST[$dbdata->Field]) $line[] = "`".$dbdata->Field."` = '".$_POST[$dbdata->Field]['pass']."'";
						elseif(@array_key_exists("md5",$_POST[$dbdata->Field]))
							if($_POST[$dbdata->Field]['md5']) $line[] = "`".$dbdata->Field."` = '".md5($_POST[$dbdata->Field]['md5'])."'";
					}
					else{
						if(isset($_POST[$dbdata->Field]))
							$line[] = "`".$dbdata->Field."` = '".addslashes(stripslashes($_POST[$dbdata->Field]))."'";
					}
				}

			}
			
		#	Create UPDATE Query
			$query = mysql_query($QueryLine = "UPDATE `".$query."` SET ".implode(', ',$line)." WHERE ".$id."='".$value."'") or die (ErrorReporing::Message(mysql_error(), $QueryLine));
			//echo "UPDATE `".$query."` SET ".implode(', ',$line)." WHERE `".$id."` = '".$value."'"; exit();
			return $query;
		}
		
		function Insert($query, $id, $output = false)
		{
			
		#	Replace Prefix
			$database = $query;
			$database = str_replace('#__', $this->dbprefix, $database);				
			
		#	Get Database Coloms
			$query = "SHOW COLUMNS FROM `".$database."`";
			$query = mysql_query($query) or die (ErrorReporing::Message(mysql_error()));

			for($i; $data[] = mysql_fetch_object($query); $i++);
			array_pop($data);
			$line = array();
				
		#	Combinate POST data with Database Coloms
			foreach($data as $dbdata):
				
				if($dbdata->Field != $id):
					
					if(@array_key_exists("date",$_POST[$dbdata->Field])){
						$line[] = "`".$dbdata->Field."` = '".date('Y-m-d',strtotime($_POST[$dbdata->Field]['date']))."'";
					}
					elseif(@array_key_exists("pass",$_POST[$dbdata->Field])){
						if($_POST[$dbdata->Field]['pass']) if($_POST[$dbdata->Field]) $line[] = "`".$dbdata->Field."` = '".$_POST[$dbdata->Field]['pass']."'";
					}
					elseif(@array_key_exists("md5",$_POST[$dbdata->Field])){
						if($_POST[$dbdata->Field]['md5']) $line[] = "`".$dbdata->Field."` = '".md5($_POST[$dbdata->Field]['md5'])."'";
					}
					elseif($_POST[$dbdata->Field]){
						$line[] = "`".$dbdata->Field."` = '".addslashes(stripslashes($_POST[$dbdata->Field]))."'";
					}
				endif;

			endforeach;
			
		#	Create INSERT Query
			
			if($output == true){
				return "INSERT INTO `".$database."` SET ".implode(', ',$line);
			}
			else{		
				$query = mysql_query("INSERT INTO `".$database."` SET ".implode(', ',$line)) or die (ErrorReporing::Message(mysql_error()));
				//echo "INSERT INTO `".$database."` SET ".implode(', ',$line); exit();
				return $query;
			}
		}
		
		function Delete($query,$id,&$value)
		{
		#	Replace Prefix

			$query = str_replace('#__', $this->dbprefix, $query);	
			
			if(is_array($value)):
				$totaldata = $value;
				$totalcounter = count($totaldata);
				$counter = 1;
				foreach($totaldata as $data):
					if($counter == $totalcounter):
						$line1.= $data;				
					else:
						$line1.= $data.",";				
					endif;
					$counter++;
				endforeach;
			else:
				$line1 = $value;
			endif;
			
		#	Create DELETE Query
			$oquery = mysql_query("DELETE FROM `".$query."` WHERE ".$id." IN(".$line1.")") or die (ErrorReporing::Message(mysql_error()));
			return $oquery;
		}

		function Query($Query)
		{
		#	Replace Prefix
			$Query = str_replace('#__', $this->dbprefix, $Query);
				//App::debug($Query);
		#	Make MYSQL connection
			$oQuery = mysql_query($Query) or die (ErrorReporing::Message(mysql_error(),$Query));		
			return $oQuery;
		}

		function Count($query)
		{
		#	Replace Prefix
			$query = str_replace('#__', $this->dbprefix, $query);
				
		#	Make MYSQL connection
			$query = mysql_query($query) or die (ErrorReporing::Message(mysql_error(),$query));		
			for($i; $data[] = mysql_fetch_object($query); $i++);
			array_pop($data);
			
			foreach($data[0] as $datas);
			return $datas;
		}
	}
?>