<?
#	Index file
	define('LR_ACCESS', true);
/*	
	$_SERVER['DOCUMENT_ROOT'] = "/home/dobbel/domains/crm.tasvenray.nl/public_html";
	$_SERVER['HTTP_HOST'] = "crm.tasvenray.nl";
*/			
			echo "ll";
			
	require_once($_SERVER['DOCUMENT_ROOT']."/language/language.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/system/func.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/system/class.error.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/Zend/Mail/Storage/Pop3.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/Zend/Exception.php");
	
	$Login = array('host' => "localhost", 'user' => "mailer@crm.tasvenray.nl", 'password' => "Fy5jTnLM");
	$LoadMail = new Zend_Mail_Storage_Pop3($Login);
	$Database = new Database();
	
	if($LoadMail->countMessages()){

		foreach($LoadMail as $Num => $Message) {
			
			$message = $LoadMail->getMessage($Num);
			$expData = explode("@",$message->envelopeTo,2);
			$CustomerId = $expData[0];
			
			$Sql = array();
			$From = $message->from;
			preg_match_all("|<(.*)>|Uism", $From, $aResults);

			$Sql[name] = trim(strip_tags($message->from));
			$Sql[from] = trim(strip_tags($aResults[1][0]));
			$Sql[senddate] = $message->date;
			$Sql[customerid] = $CustomerId;
			$Sql[subject] = addslashes(htmlentities(quoted_printable_decode($message->subject)));
			
			foreach (new RecursiveIteratorIterator($message) as $part) {
				switch($part->contentTransferEncoding){
					case "quoted-printable":
						$Type = explode(";", $part->contentType);
						switch($Type[0]){
							case "text/plain":
								$Sql[content] = addslashes(htmlentities(quoted_printable_decode($part)));
							break;
							case "text/html":
								$Sql[htmlcontent] = addslashes((quoted_printable_decode($part)));
							break;
						}							
					break;
					case "base64":
						$Type = explode(";", $part->contentType);
						switch($Type[0]){
							case "text/plain":
								$Sql[content] = addslashes(htmlentities(quoted_printable_decode($part)));
							break;
							case "text/html":
								$Sql[htmlcontent] = addslashes((quoted_printable_decode($part)));
							break;
						}							
					break;
				}			
			}
			
			foreach (new RecursiveIteratorIterator($message) as $part) {				
				switch($part->contentTransferEncoding){
					case "base64":
						echo "<pre>";
							print_r($part);
						$Type = explode(";", $part->contentType);
						if($Type[0] != "text/plain" && $Type[0] != "text/html"){
							$Datas = explode(";",$part->contentType);
							foreach($Datas as $Data){
								$Result = explode("=", $Data);
								$Return[trim($Result[0])] = str_replace('"','',trim($Result[1]));
							}
							
							$Sql[attachment][] = array(
								"name" => $Return[filename],
								"mime" => $Type[0],
								"content" => $part
							);
						}
					break;
				}
			}
			
			if($Sql){
				
				$Database->Query("
					INSERT INTO
						`crm_mail`
					SET
						`company_id`		= '".$Sql[customerid]."',
						`mail_name`			= '".$Sql[name]."',
						`mail_mailaddress`	= '".strtolower($Sql[from])."',
						`mail_subject`		= '".$Sql[subject]."',
						`mail_content`		= '".$Sql[content]."',
						`mail_content_html`	= '".$Sql[htmlcontent]."',
						`mail_datetime`		= '".date("Y-m-d H:i:s", strtotime($Sql[senddate]))."'
				");
				
				$MailId = mysql_insert_id();
				
				if($Sql[attachment]){
					foreach($Sql[attachment] as $Attachment){						
						$Database->Query("
							INSERT INTO
								`".FILES."`
							SET
								".FILES.".`mail_id` 	= '".$MailId."',
								".FILES.".`file_name` 	= '".$Attachment[name]."',
								".FILES.".`file_mime` 	= '".$Attachment[mime]."'
						");
						$Filename = $MailId."_".mysql_insert_id();
						file_put_contents($_SERVER['DOCUMENT_ROOT']."/tmp/".$Filename, base64_decode($Attachment[content]));
					}					
				}
			}	
			$LoadMail->removeMessage($Num);
		}
	}
	$LoadMail->Close();