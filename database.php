<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	define("PREFIX", $systemconfig->dbprefix);
	
#	Database connection
	$db	= @mysql_connect($systemconfig->dbhost, $systemconfig->dbuser, $systemconfig->dbpass);
		  @mysql_select_db($systemconfig->dbname,$db);
	
	function SYSTEMQUERY($query,$database,$type)
	{
		switch($type)
		{
			case SELECT:
			#	Replace Prefix
				$query = str_replace('#__', PREFIX, $query);
				$queryview = str_replace('#__', PREFIX, $query);
				
			#	Make MYSQL connection
			
				$query = @mysql_query($query) or die (error(mysql_error(),$queryview));		
				for($i; $data[] = mysql_fetch_object($query); $i++);
				array_pop($data);
				
				return $data;
			break;
			case COUNT:
			#	Replace Prefix
				$query = str_replace('#__', PREFIX, $query);
				$queryview = str_replace('#__', PREFIX, $query);
				
			#	Make MYSQL connection
				$query = @mysql_query($query) or die (error(mysql_error(),$queryview));		
				for($i; $data[] = mysql_fetch_object($query); $i++);
				array_pop($data);
				
				foreach($data[0] as $datas);
				return $datas;
			break;
			case ALL:
			#	Replace Prefix
				$query = str_replace('#__', PREFIX, $query);
				$queryview =  str_replace('#__', PREFIX, $query);
				
			#	Make MYSQL connection
				@mysql_query($query) or die (error(mysql_error(),$queryview));
				//echo $queryview.'<br>';
				return $queryview;
			break;
			case UPDATE:
			#	Replace Prefix
				$database = $query;
				$database = str_replace('#__', PREFIX, $database);				
			
			#	Get Database Coloms
				$query = "SHOW COLUMNS FROM `".$database."`";
				$queryview = "SHOW COLUMNS FROM `".$database."`";
				$query = @mysql_query($query) or die (error(mysql_error(),$queryview));
				
				for($i; $data[] = mysql_fetch_object($query); $i++);
				array_pop($data);
				$totalcounter = count($data);
				$counter = 1;
				
			#	Combinate POST data with Database Coloms
				foreach($data as $dbdata):
					
					if($dbdata->Field != 'id'):
						if($counter == $totalcounter):
							$line1.= "`".$dbdata->Field."` = '".addslashes(stripslashes($_POST[$dbdata->Field]))."'";					
						else:
							$line1.= "`".$dbdata->Field."` = '".addslashes(stripslashes($_POST[$dbdata->Field]))."',";					
						endif;
					endif;
					$counter++;
				endforeach;
				
			#	Create UPDATE Query
				$queryview = "UPDATE `".$database."` SET ".$line1." WHERE id='".Get::Data('item')."'";
				//echo $queryview.'<br>';
				@mysql_query("UPDATE `".$database."` SET ".$line1." WHERE id='".Get::Data('item')."'") or die (error(mysql_error(),$queryview));
				
				return $queryview;
			break;
			case COPY:
			#	Replace Prefix
				$database = $query;
				$database = str_replace('#__', PREFIX, $database);				
			
			#	Get Database Coloms
				$query = "SHOW COLUMNS FROM `".$database."`";
				$queryview = "SHOW COLUMNS FROM `".$database."`";
				$query = @mysql_query($query) or die (error(mysql_error(),$queryview));
				
				foreach(CMSQUERY('SELECT * FROM `'.$database.'` WHERE id="'.$_GET['currentitem'].'"',$db,SELECT) as $copydata);
				
				for($i; $data[] = mysql_fetch_object($query); $i++);
				array_pop($data);
				$totalcounter = count($data);
				$counter = 1;
				
			#	Combinate POST data with Database Coloms
				foreach($data as $dbdata):
					$exclusive = $dbdata->Field;
					if($exclusive != 'id'):
						if($counter == $totalcounter):
							$line1.= "`".$exclusive."`";
							$line2.= "'".$copydata->$exclusive."'";	
						else:
							$line1.= "`".$exclusive."`,";
							$line2.= "'".$copydata->$exclusive."',";					
						endif;
					endif;
					$counter++;
				endforeach;
				
			#	Create INSERT Query
				$queryview = "INSERT INTO `".$database."`(".$line1.") VALUES(".$line2.")";
				$query = @mysql_query("INSERT INTO `".$database."`(".$line1.") VALUES(".$line2.")") or die (error(mysql_error(),$queryview));
				
				return $query;
			break;
			case INSERT:
			#	Replace Prefix
				$database = $query;
				$database = str_replace('#__', PREFIX, $database);				
			
			#	Get Database Coloms
				$query = "SHOW COLUMNS FROM `".$database."`";
				$queryview = "SHOW COLUMNS FROM `".$database."`";
				$query = @mysql_query($query) or die (error(mysql_error(),$queryview));

				for($i; $data[] = mysql_fetch_object($query); $i++);
				array_pop($data);
				$totalcounter = count($data);
				$counter = 1;
				
			#	Combinate POST data with Database Coloms
				foreach($data as $dbdata):
					if($dbdata->Field != 'id'):
						if($counter == $totalcounter):
							$line1.= "`".$dbdata->Field."`";
							$line2.= "'".addslashes(stripslashes($_POST[$dbdata->Field]))."'";					
						else:
							$line1.= "`".$dbdata->Field."`,";
							$line2.= "'".addslashes(stripslashes($_POST[$dbdata->Field]))."',";					
						endif;
					endif;
					$counter++;
				endforeach;
				
			#	Create INSERT Query
				$queryview = "INSERT INTO `".$database."`(".$line1.") VALUES(".$line2.")";
				//echo $queryview.'<br>';
				@mysql_query("INSERT INTO `".$database."`(".$line1.") VALUES(".$line2.")") or die (error(mysql_error(),$queryview));
				
				return $queryview;
			break;
			case DELETE:
			#	Replace Prefix
				$database = $query;
				$database = str_replace('#__', PREFIX, $database);
				
				$totaldata = $_POST['selected_fld'];
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
				
			#	Create DELETE Query
				$queryview = "DELETE FROM `".$database."` WHERE id IN(".$line1.")";
				@mysql_query("DELETE FROM `".$database."` WHERE id IN(".$line1.")") or die (error(mysql_error(),$queryview));
				
				return $queryview;
			break;
		}
	}
?>