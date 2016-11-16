<?
#	LR DESIGN - CMS SYSTEM
#	Built: 10-Feb-2010   /  Created by: Robert van Klooster

#	System functions
	defined('LR_ACCESS') or die('Geen directe toegang mogelijk!');
	
	class Autoloader{	
	
		public static function autoload($sClass){
			
			if (preg_match('/PHPExcel_/', $sClass)){
				$sClass = str_replace('PHPExcel_', '', $sClass);
				$sClass = str_replace('_', '/', $sClass);
				require_once($_SERVER['DOCUMENT_ROOT']."/system/PHPExcel/" . ucfirst($sClass) . ".php");
				return true;
			}
			
			$sClass = strtolower($sClass);
			switch($sClass){
				
				# Optional classes
				case 'fpdi':
					require_once($_SERVER['DOCUMENT_ROOT'].'/system/fpdf/fpdi.php');
				break;
				case 'fpdf':
					require_once($_SERVER['DOCUMENT_ROOT'].'/system/fpdf/fpdf.php');
				break;
				case 'phpmailer':
					require_once($_SERVER['DOCUMENT_ROOT']."/system/phpmailer/class.phpmailer.php");
				break;
				case 'smtp':
					require_once($_SERVER['DOCUMENT_ROOT']."/system/phpmailer/class.smtp.php");
				break;
				case 'pop3':
					require_once($_SERVER['DOCUMENT_ROOT']."/system/phpmailer/class.pop3.php");
				break;
				
				# System Classes
				default:
					if(file_exists($_SERVER['DOCUMENT_ROOT'].'/system/class.' . $sClass . '.php')){
						require_once($_SERVER['DOCUMENT_ROOT'].'/system/class.' . $sClass . '.php');
					}
				break;
			}
		}
		
		public static function register ($Class = "autoload"){
			return spl_autoload_register(array(__CLASS__, $Class));
		}
		
		public static function unregister ($Class = "autoload"){
			return spl_autoload_unregister(array(__CLASS__, $Class));
		}
	}
	
	Autoloader::register();
?>