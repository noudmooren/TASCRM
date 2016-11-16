<?
#	Cron Class
#	TAS Venray - Created by Robert van Klooster
#	04-12-2012
	
#	XML Class
	class SMSAPI{
		
		private $aArray;
		
		function __construct($oMessage, $oNumber, $oAlias = "TAS Venray"){
			$this->aArray = array_merge(
				array("UID" => "tasvenray"),	//Username
				array("PWD" => "a2FrrHC1"),		//Password
				array("M" => $oMessage),		//Message
				array("O" => $oAlias),			//Alias
				array("N" => $oNumber),			//Number
				array("TEST" => "0"),			//Test Mode
				array("CONCAT" => "2")
			);
		}
		
		function SendSMS($host){
			$options = array('http' => array('method' => 'POST','content' => http_build_query($this->aArray)));
			$context = stream_context_create($options);
			$result  = file_get_contents($host, false, $context);
			return $result;
		}
	}

?>