<?
#	LR DESIGN - CMS SYSTEM
#	Built: 10-Feb-2010   /  Created by: Robert van Klooster

#	System functions
	defined('LR_ACCESS') or die('Geen directe toegang mogelijk!');
	
	require_once("class.error.php");
	
	class App{
				
		public function Cms(){
			
			if($_SERVER['HTTP_HOST'] == "login.tasvenray.nl"){
				require_once($_SERVER['DOCUMENT_ROOT']."/system/app.login.php");
				exit();	
			}
			
			// POST Requests
			if($_POST['frmAction']){
				switch($_POST['frmAction']){
					case "calls.add":
						
						if($_POST["see"] == 4){
							$oJob = 60;
						}
						else{
							$TimeStamp = (60*60*60)*date('H') + (60*60)*date('i');						
							if($TimeStamp >= '0' && $TimeStamp <= '1508400')
								$oJob = 3;
							elseif($TimeStamp >= '1512000' && $TimeStamp <= '4100400')
								$oJob = 1;
							elseif($TimeStamp >= '4104000' && $TimeStamp <= '4964400')
								$oJob = 2;
							elseif($TimeStamp >= '4968000' && $TimeStamp <= '5180400')
								$oJob = 3;
						}
						
						$_POST["job"] 		= $oJob;
						$_POST["userid"] 	= $_SESSION["login"];
						$_POST["lock_user"] = $_SESSION["login"];
						$_POST["datecall"] 	= date("Y-m-d");
						$_POST["starttime"] = date("H:i:s");
						$_POST["endtime"] 	= date("H:i:s");
						$_POST["calltime"] 	= "00:00:00";
						$_POST["locked"] 	= "true";
						$_POST["active"] 	= "false";
						
						$Database = new Database();
						$Database->Insert(CALLS, "id");
						
						echo mysql_insert_id();
						exit();
						
					break;
					case "save.call":
						
						if($_POST["id"] && $_POST["companyid"]){
							
							$Database = new Database();
							$Database->Query("
								UPDATE `".CALLS."` SET
									".CALLS.".`relationid` 		= '".$_POST["relationid"]."',
									".CALLS.".`orderid` 		= '".$_POST["orderid"]."',
									".CALLS.".`refid` 			= '".App::String($_POST["refid"])."',
									".CALLS.".`contactperson` 	= '".App::String($_POST["contactperson"])."',
									".CALLS.".`relationname` 	= '".App::String($_POST["relationname"])."',
									".CALLS.".`address` 		= '".App::String($_POST["address"])."',
									".CALLS.".`number` 			= '".App::String($_POST["number"])."',
									".CALLS.".`zipcode` 		= '".App::String($_POST["zipcode"])."',
									".CALLS.".`place` 			= '".App::String($_POST["place"])."',
									".CALLS.".`phonenumber` 	= '".App::String($_POST["phonenumber"])."',
									".CALLS.".`mobilenumber` 	= '".App::String($_POST["mobilenumber"])."',
									".CALLS.".`mailaddress` 	= '".App::String($_POST["mailaddress"])."',
									".CALLS.".`birthdate` 		= '".App::String($_POST["birthdate"])."',
									".CALLS.".`content` 		= '".App::String($_POST["content"])."',
									".CALLS.".`active` 			= 'true'
								WHERE
									".CALLS.".`id` = '".$_POST["id"]."' AND ".CALLS.".`companyid` = '".$_POST["companyid"]."'");
							
							Logs::Add('Callid `'.$_POST["id"].'` opgeslagen door F8 te drukken.', $_POST['id'], $_POST['companyid']);
							
							// Save Relation
							/*if(!empty($_POST["relationid"])){
								
								$Database->Query("
										UPDATE `".RELATIONS."` SET
											".RELATIONS.".`contactperson` 	= '".App::String($_POST["contactperson"])."',
											".RELATIONS.".`relationname` 	= '".App::String($_POST["relationname"])."',
											".RELATIONS.".`address` 		= '".App::String($_POST["address"])."',
											".RELATIONS.".`number` 			= '".App::String($_POST["number"])."',
											".RELATIONS.".`zipcode` 		= '".App::String($_POST["zipcode"])."',
											".RELATIONS.".`place` 			= '".App::String($_POST["place"])."',
											".RELATIONS.".`phonenumber` 	= '".App::String($_POST["phonenumber"])."',
											".RELATIONS.".`mobilenumber` 	= '".App::String($_POST["mobilenumber"])."',
											".RELATIONS.".`mailaddress` 	= '".App::String($_POST["mailaddress"])."',
											".RELATIONS.".`birthdate` 		= '".App::String($_POST["birthdate"])."',
											".RELATIONS.".`refid` 			= '".App::String($_POST["refid"])."'
										WHERE
											".RELATIONS.".`id` = '".$_POST["relationid"]."' AND ".RELATIONS.".`customerid` = '".$_POST["companyid"]."'
									");
							}
							else{
								
								$Database->Query("
									INSERT INTO `".RELATIONS."` SET
										".RELATIONS.".`customerid` 		= '".$_POST["companyid"]."',
										".RELATIONS.".`contactperson` 	= '".App::String($_POST["contactperson"])."',
										".RELATIONS.".`relationname` 	= '".App::String($_POST["relationname"])."',
										".RELATIONS.".`address` 		= '".App::String($_POST["address"])."',
										".RELATIONS.".`number` 			= '".App::String($_POST["number"])."',
										".RELATIONS.".`zipcode` 		= '".App::String($_POST["zipcode"])."',
										".RELATIONS.".`place` 			= '".App::String($_POST["place"])."',
										".RELATIONS.".`phonenumber` 	= '".App::String($_POST["phonenumber"])."',
										".RELATIONS.".`mobilenumber` 	= '".App::String($_POST["mobilenumber"])."',
										".RELATIONS.".`mailaddress` 	= '".App::String($_POST["mailaddress"])."',
										".RELATIONS.".`birthdate` 		= '".App::String($_POST["birthdate"])."',
										".RELATIONS.".`refid` 			= '".App::String($_POST["refid"])."',
										".RELATIONS.".`create_date`		= NOW()
								");
								$_POST["relationid"] = mysql_insert_id();
								
							}*/
							
							echo "1";
						}
						exit();
					break;
					case "call.edit":
						
						$Database = new Database();
						$Vars = new Vars();
						$Reseller = (object) $Vars->Reseller[$_POST["see"]];
						
						$Customer = Customers::getCustomerById($_POST["companyid"]);
						
						if(isset($_POST["cancelcall"])){
							Logs::Add('Callid `'.$_POST["call_id"].'` geannuleerd.', $_POST['call_id'], $_POST['companyid']);
							
							$Database->Query("
								UPDATE `".CALLS."` SET ".CALLS.".`locked` = 'false' WHERE ".CALLS.".`id` = '".$_POST["call_id"]."' AND ".CALLS.".`companyid` = '".$_POST["companyid"]."'
							");
							
							App::Redirect($_SERVER['REQUEST_URI']);
							exit();	
						}
										
						if(isset($_POST["deletecall"])){
							Logs::Add('Callid `'.$_POST["call_id"].'` verwijderd.', $_POST['call_id'], $_POST['companyid']);
							//Delete Call
							$Database->Query("
								DELETE FROM `".CALLS."` WHERE ".CALLS.".`id` = '".$_POST["call_id"]."' AND ".CALLS.".`companyid` = '".$_POST["companyid"]."'
							");
							
							//Delete Actions
							$Database->Query("
								DELETE FROM `".ACTIONS."` WHERE ".ACTIONS.".`callid` = '".$_POST["call_id"]."' AND ".ACTIONS.".`companyid` = '".$_POST["companyid"]."'
							");
							
							App::Redirect($_SERVER['REQUEST_URI']);
							exit();	
						}
						
						if(isset($_POST["resendcall"])){
							
							$oCall = Calls::getCallObjectById($_POST["call_id"]);
							
							switch($oCall->customer_maildelivery){
								
								case "1":
							
									$AllTo = @explode(",",$oCall->call_sendto);
									$AllTo = @array_unique($AllTo);
															
									foreach($AllTo as $Mailaddress){
										
										if($Mailaddress){
										
											$Template = new Template();
											
											$Template->Assign("oCall", $oCall);
											$Template->Assign("Mailaddress", $Mailaddress);
											
											if($oCall->customer_see == 4){
												$Message = $Template->Content("mail.call.short.bd.php");
											}
											else{								
												if($Customer->maillayout == "short")
													$Message = $Template->Content("mail.call.short.php");	
												else
													$Message = $Template->Content("mail.call.php");
											}
											
											$oSettings = (object) $Reseller->Mailer;
											
											$oMail = new PHPMailer();
											$oMail->IsSendMail();
											if($oSettings->SMTP){
												$oMail->IsSMTP();
												$oMail->SMTPAuth = false;
												$oMail->Host = $oSettings->Host;
												$oMail->Port = $oSettings->Port;
											}
											$oMail->SetFrom($oSettings->From, $oSettings->Name);
											if($oCall->customer_subject){
																			
												$oSubject = $oCall->customer_subject;
												
												$oSubject = str_replace("{datum}", date("d-m-Y"), $oSubject);
												$oSubject = str_replace("{tijd}", date("H:i"), $oSubject);
												$oSubject = str_replace("{bedrijfsnaam}", $oCall->call_relationname, $oSubject);
												$oSubject = str_replace("{contactpersoon}", $oCall->call_contactperson, $oSubject);
												$oSubject = str_replace("{adres}", $oCall->call_address, $oSubject);
												$oSubject = str_replace("{huisnummer}", $oCall->call_number, $oSubject);
												$oSubject = str_replace("{postcode}", $oCall->call_zipcode, $oSubject);
												$oSubject = str_replace("{plaats}", $oCall->call_place, $oSubject);
												$oSubject = str_replace("{telefoon}", $oCall->call_phonenumber, $oSubject);
												$oSubject = str_replace("{mobiel}", $oCall->call_mobilenumber, $oSubject);
												$oSubject = str_replace("{email}", $oCall->call_mailaddress, $oSubject);
												$oSubject = str_replace("{klantnr}", $oCall->call_refid, $oSubject);
												$oSubject = str_replace("{bericht}", $oCall->call_content, $oSubject);
												$oSubject = str_replace("{orderid}", $oCall->call_orderid, $oSubject);
												$oSubject = str_replace("{oproep_type}", $oCall->call_job_name, $oSubject);
												$oSubject = str_replace("{geboortedatum}", $oCall->call_birthdate, $oSubject);
												
												foreach(Customers::getExtraFieldsByCustomerId($oCall->customer_id) as $Fieldname => $Field){
													$oSubject = str_replace("{".$Field->fieldname."}", $oCall->{$Fieldname}, $oSubject);
												}
												
												$oMail->Subject = $oSubject;
											}
											else{
												
												$oSubject = $oSettings->Subject;
												
												$oSubject = str_replace("{datum}", date("d-m-Y"), $oSubject);
												$oSubject = str_replace("{tijd}", date("H:i"), $oSubject);
												$oSubject = str_replace("{bedrijfsnaam}", $oCall->call_relationname, $oSubject);
												$oSubject = str_replace("{contactpersoon}", $oCall->call_contactperson, $oSubject);
												$oSubject = str_replace("{adres}", $oCall->call_address, $oSubject);
												$oSubject = str_replace("{huisnummer}", $oCall->call_number, $oSubject);
												$oSubject = str_replace("{postcode}", $oCall->call_zipcode, $oSubject);
												$oSubject = str_replace("{plaats}", $oCall->call_place, $oSubject);
												$oSubject = str_replace("{telefoon}", $oCall->call_phonenumber, $oSubject);
												$oSubject = str_replace("{mobiel}", $oCall->call_mobilenumber, $oSubject);
												$oSubject = str_replace("{email}", $oCall->call_mailaddress, $oSubject);
												$oSubject = str_replace("{klantnr}", $oCall->call_refid, $oSubject);
												$oSubject = str_replace("{bericht}", $oCall->call_content, $oSubject);
												$oSubject = str_replace("{orderid}", $oCall->call_orderid, $oSubject);
												$oSubject = str_replace("{oproep_type}", $oCall->call_job_name, $oSubject);
												$oSubject = str_replace("{geboortedatum}", $oCall->call_birthdate, $oSubject);
												
												foreach(Customers::getExtraFieldsByCustomerId($oCall->customer_id) as $Fieldname => $Field){
													$oSubject = str_replace("{".$Field->fieldname."}", $oCall->{$Fieldname}, $oSubject);
												}
												
												$oMail->Subject = ($oCall->call_orderid ? $oCall->call_orderid." | " : "") . $oSubject;
											}
											$oMail->MsgHTML($Message);
											$oMail->AddAddress($Mailaddress, $Mailaddress);
											
											if($oSettings->BCC)
												$oMail->AddBCC($oSettings->BCCto, $oSettings->BCCto);
											
											$oMail->Send();
										}										
									}
								break;
								case "2":
																			
									$Template = new Template();
									$Template->Assign("oCall", $oCall);
									
									if($oCall->customer_see == 4){
										$Message = $Template->Content("mail.call.short.bd.php");
									}
									else{								
										if($Customer->maillayout == "short")
											$Message = $Template->Content("mail.call.short.php");	
										else
											$Message = $Template->Content("mail.call.php");
									}
									
									$oSettings = (object) $Reseller->Mailer;
									
									$oMail = new PHPMailer();
									if($oSettings->SMTP){
										$oMail->IsSMTP();
										$oMail->SMTPAuth = false;
										$oMail->Host = $oSettings->Host;
										$oMail->Port = $oSettings->Port;
									}
									$oMail->SetFrom($oSettings->From, $oSettings->Name);
									$oMail->Subject = "Overzicht ".date("d-m-Y H:i");
									$oMail->MsgHTML($Message);
									$oMail->AddAddress(str_replace('-','',$oCall->customer_faxnumber)."-sqPUevjG@tasvenray.faxservice.nl");
									
									if($oSettings->BCC)
										$oMail->AddBCC($oSettings->BCCto, $oSettings->BCCto);
									
									$oMail->Send();					
								
								break;
							}	
								
							App::Redirect($_SERVER['REQUEST_URI']);
							exit();	
						}
												
						// Save Relation
						if(isset($_POST["over"]) && !empty($_POST["relationid"])){
							switch($_POST["over"]){
								case "2": //make new
									$Database->Query("
										INSERT INTO `".RELATIONS."` SET
											".RELATIONS.".`customerid` 		= '".$_POST["companyid"]."',
											".RELATIONS.".`contactperson` 	= '".App::String($_POST["contactperson"])."',
											".RELATIONS.".`relationname` 	= '".App::String($_POST["relationname"])."',
											".RELATIONS.".`address` 		= '".App::String($_POST["address"])."',
											".RELATIONS.".`number` 			= '".App::String($_POST["number"])."',
											".RELATIONS.".`zipcode` 		= '".App::String($_POST["zipcode"])."',
											".RELATIONS.".`place` 			= '".App::String($_POST["place"])."',
											".RELATIONS.".`phonenumber` 	= '".App::String($_POST["phonenumber"])."',
											".RELATIONS.".`mobilenumber` 	= '".App::String($_POST["mobilenumber"])."',
											".RELATIONS.".`mailaddress` 	= '".App::String($_POST["mailaddress"])."',
											".RELATIONS.".`birthdate` 		= '".App::String($_POST["birthdate"])."',
											".RELATIONS.".`refid` 			= '".App::String($_POST["refid"])."',
											".RELATIONS.".`create_date`		= NOW(),
											".RELATIONS.".`comment`			= '".App::String($_POST["comment"])."'
											
											".(isset($_POST["custom1"]) ? ", ".RELATIONS.".`custom1` = '".App::String($_POST["custom1"])."'" : "")."
											".(isset($_POST["custom2"]) ? ", ".RELATIONS.".`custom2` = '".App::String($_POST["custom2"])."'" : "")."
											".(isset($_POST["custom3"]) ? ", ".RELATIONS.".`custom3` = '".App::String($_POST["custom3"])."'" : "")."
											".(isset($_POST["custom4"]) ? ", ".RELATIONS.".`custom4` = '".App::String($_POST["custom4"])."'" : "")."
											".(isset($_POST["custom5"]) ? ", ".RELATIONS.".`custom5` = '".App::String($_POST["custom5"])."'" : "")."
											".(isset($_POST["custom6"]) ? ", ".RELATIONS.".`custom6` = '".App::String($_POST["custom6"])."'" : "")."
											".(isset($_POST["custom7"]) ? ", ".RELATIONS.".`custom7` = '".App::String($_POST["custom7"])."'" : "")."
											".(isset($_POST["custom8"]) ? ", ".RELATIONS.".`custom8` = '".App::String($_POST["custom8"])."'" : "")."
											".(isset($_POST["custom9"]) ? ", ".RELATIONS.".`custom9` = '".App::String($_POST["custom9"])."'" : "")."
											".(isset($_POST["custom10"]) ? ", ".RELATIONS.".`custom10` = '".App::String($_POST["custom10"])."'" : "")."
									");
									$_POST["relationid"] = mysql_insert_id();
								break;
								case "1": //overwrite
									$Database->Query("
										UPDATE `".RELATIONS."` SET
											".RELATIONS.".`contactperson` 	= '".App::String($_POST["contactperson"])."',
											".RELATIONS.".`relationname` 	= '".App::String($_POST["relationname"])."',
											".RELATIONS.".`address` 		= '".App::String($_POST["address"])."',
											".RELATIONS.".`number` 			= '".App::String($_POST["number"])."',
											".RELATIONS.".`zipcode` 		= '".App::String($_POST["zipcode"])."',
											".RELATIONS.".`place` 			= '".App::String($_POST["place"])."',
											".RELATIONS.".`phonenumber` 	= '".App::String($_POST["phonenumber"])."',
											".RELATIONS.".`mobilenumber` 	= '".App::String($_POST["mobilenumber"])."',
											".RELATIONS.".`mailaddress` 	= '".App::String($_POST["mailaddress"])."',
											".RELATIONS.".`birthdate` 		= '".App::String($_POST["birthdate"])."',
											".RELATIONS.".`refid` 			= '".App::String($_POST["refid"])."',
											".RELATIONS.".`create_date`		= NOW(),
											".RELATIONS.".`comment`			= '".App::String($_POST["comment"])."'
											
											".(isset($_POST["custom1"]) ? ", ".RELATIONS.".`custom1` = '".App::String($_POST["custom1"])."'" : "")."
											".(isset($_POST["custom2"]) ? ", ".RELATIONS.".`custom2` = '".App::String($_POST["custom2"])."'" : "")."
											".(isset($_POST["custom3"]) ? ", ".RELATIONS.".`custom3` = '".App::String($_POST["custom3"])."'" : "")."
											".(isset($_POST["custom4"]) ? ", ".RELATIONS.".`custom4` = '".App::String($_POST["custom4"])."'" : "")."
											".(isset($_POST["custom5"]) ? ", ".RELATIONS.".`custom5` = '".App::String($_POST["custom5"])."'" : "")."
											".(isset($_POST["custom6"]) ? ", ".RELATIONS.".`custom6` = '".App::String($_POST["custom6"])."'" : "")."
											".(isset($_POST["custom7"]) ? ", ".RELATIONS.".`custom7` = '".App::String($_POST["custom7"])."'" : "")."
											".(isset($_POST["custom8"]) ? ", ".RELATIONS.".`custom8` = '".App::String($_POST["custom8"])."'" : "")."
											".(isset($_POST["custom9"]) ? ", ".RELATIONS.".`custom9` = '".App::String($_POST["custom9"])."'" : "")."
											".(isset($_POST["custom10"]) ? ", ".RELATIONS.".`custom10` = '".App::String($_POST["custom10"])."'" : "")."
										WHERE
											".RELATIONS.".`id` = '".$_POST["relationid"]."' AND ".RELATIONS.".`customerid` = '".$_POST["companyid"]."'
									");
								break;
								case "0": //do nothing
									$Database->Query("
										UPDATE `".RELATIONS."` SET
											".RELATIONS.".`comment`			= '".App::String($_POST["comment"])."'
										WHERE
											".RELATIONS.".`id` = '".$_POST["relationid"]."' AND ".RELATIONS.".`customerid` = '".$_POST["companyid"]."'
									");
								break;	
								
							}
						}
						else{
							$Database->Query("
								INSERT INTO `".RELATIONS."` SET
									".RELATIONS.".`customerid` 		= '".$_POST["companyid"]."',
									".RELATIONS.".`contactperson` 	= '".App::String($_POST["contactperson"])."',
									".RELATIONS.".`relationname` 	= '".App::String($_POST["relationname"])."',
									".RELATIONS.".`address` 		= '".App::String($_POST["address"])."',
									".RELATIONS.".`number` 			= '".App::String($_POST["number"])."',
									".RELATIONS.".`zipcode` 		= '".App::String($_POST["zipcode"])."',
									".RELATIONS.".`place` 			= '".App::String($_POST["place"])."',
									".RELATIONS.".`phonenumber` 	= '".App::String($_POST["phonenumber"])."',
									".RELATIONS.".`mobilenumber` 	= '".App::String($_POST["mobilenumber"])."',
									".RELATIONS.".`mailaddress` 	= '".App::String($_POST["mailaddress"])."',
									".RELATIONS.".`birthdate` 		= '".App::String($_POST["birthdate"])."',
									".RELATIONS.".`refid` 			= '".App::String($_POST["refid"])."',
									".RELATIONS.".`create_date`		= NOW(),
									".RELATIONS.".`comment`			= '".App::String($_POST["comment"])."'
									
									".(isset($_POST["custom1"]) ? ", ".RELATIONS.".`custom1` = '".App::String($_POST["custom1"])."'" : "")."
									".(isset($_POST["custom2"]) ? ", ".RELATIONS.".`custom2` = '".App::String($_POST["custom2"])."'" : "")."
									".(isset($_POST["custom3"]) ? ", ".RELATIONS.".`custom3` = '".App::String($_POST["custom3"])."'" : "")."
									".(isset($_POST["custom4"]) ? ", ".RELATIONS.".`custom4` = '".App::String($_POST["custom4"])."'" : "")."
									".(isset($_POST["custom5"]) ? ", ".RELATIONS.".`custom5` = '".App::String($_POST["custom5"])."'" : "")."
									".(isset($_POST["custom6"]) ? ", ".RELATIONS.".`custom6` = '".App::String($_POST["custom6"])."'" : "")."
									".(isset($_POST["custom7"]) ? ", ".RELATIONS.".`custom7` = '".App::String($_POST["custom7"])."'" : "")."
									".(isset($_POST["custom8"]) ? ", ".RELATIONS.".`custom8` = '".App::String($_POST["custom8"])."'" : "")."
									".(isset($_POST["custom9"]) ? ", ".RELATIONS.".`custom9` = '".App::String($_POST["custom9"])."'" : "")."
									".(isset($_POST["custom10"]) ? ", ".RELATIONS.".`custom10` = '".App::String($_POST["custom10"])."'" : "")."
							");
							$_POST["relationid"] = mysql_insert_id();
						}
						
						if($_POST["ready"] != "1"){
							$_POST["send"] = "0";
							$_POST["archief"] = "0";
						}

						// Save Call
						$Database->Query("
							UPDATE `".CALLS."` SET
								".CALLS.".`relationid` 		= '".$_POST["relationid"]."',
								".CALLS.".`orderid` 		= '".$_POST["orderid"]."',
								".CALLS.".`refid` 			= '".App::String($_POST["refid"])."',
								".CALLS.".`contactperson` 	= '".App::String($_POST["contactperson"])."',
								".CALLS.".`relationname` 	= '".App::String($_POST["relationname"])."',
								".CALLS.".`address` 		= '".App::String($_POST["address"])."',
								".CALLS.".`number` 			= '".App::String($_POST["number"])."',
								".CALLS.".`zipcode` 		= '".App::String($_POST["zipcode"])."',
								".CALLS.".`place` 			= '".App::String($_POST["place"])."',
								".CALLS.".`phonenumber` 	= '".App::String($_POST["phonenumber"])."',
								".CALLS.".`mobilenumber` 	= '".App::String($_POST["mobilenumber"])."',
								".CALLS.".`mailaddress` 	= '".App::String($_POST["mailaddress"])."',
								".CALLS.".`birthdate` 		= '".App::String($_POST["birthdate"])."',
								".CALLS.".`datecall` 		= '".date("Y-m-d",strtotime($_POST["datecall"]))."',
								".CALLS.".`starttime` 		= '".$_POST["starttime"]."',
								".CALLS.".`endtime` 		= '".$_POST["endtime"]."',
								".CALLS.".`calltime` 		= '".$_POST["calltime"]."',
								".CALLS.".`job` 			= '".$_POST["job"]."',
								".CALLS.".`send` 			= '".$_POST["send"]."',
								".CALLS.".`archief` 		= '".$_POST["archief"]."',
								".CALLS.".`over` 			= '".$_POST["over"]."',
								".CALLS.".`ready` 			= '".$_POST["ready"]."',
								".CALLS.".`urgentie` 		= '".$_POST["urgentie"]."',
								".CALLS.".`sendto` 			= '".App::String($_POST["sendto"])."',
								".CALLS.".`content` 		= '".App::String($_POST["content"])."',
								".CALLS.".`orderid` 		= '".App::String($_POST["orderid"])."',
								".CALLS.".`special` 		= '".$_POST["special"]."',
								".CALLS.".`locked` 			= 'false',
								".CALLS.".`active` 			= 'true'
							WHERE
								".CALLS.".`id` = '".$_POST["call_id"]."' AND ".CALLS.".`companyid` = '".$_POST["companyid"]."'
						");
						
						//Delete Actions
						$Database->Query("
							DELETE FROM `".ACTIONS."` WHERE ".ACTIONS.".`callid` = '".$_POST["call_id"]."' AND ".ACTIONS.".`companyid` = '".$_POST["companyid"]."'
						");
						
						// Save Actions
						if($_POST["data"]){
							foreach($_POST["data"]["mechanicid"] as $Key => $Value){
								$Database->Query("
									INSERT INTO `".ACTIONS."` SET
										".ACTIONS.".`companyid` 		= '".$_POST["companyid"]."',
										".ACTIONS.".`callid` 			= '".$_POST["call_id"]."',
										".ACTIONS.".`rightjob` 			= '".App::String($_POST["data"]["rightjob"][$Key])."',
										".ACTIONS.".`rightdate` 		= '".date("Y-m-d",strtotime($_POST["data"]["rightdate"][$Key]))."',
										".ACTIONS.".`righttime` 		= '".$_POST["data"]["righttime"][$Key]."',
										".ACTIONS.".`mechanicid` 		= '".$_POST["data"]["mechanicid"][$Key]."',
										".ACTIONS.".`mechanic_name` 	= '".App::String($_POST["data"]["mechanicname"][$Key])."',
										".ACTIONS.".`mechanic_mail` 	= '".App::String($_POST["data"]["mechanicmail"][$Key])."',
										".ACTIONS.".`mechanic_phone1` 	= '".App::String($_POST["data"]["rightphone"][$Key])."',
										".ACTIONS.".`mechanic_phone2` 	= '".App::String($_POST["data"]["rightmobile"][$Key])."',
										".ACTIONS.".`mechanic_phone3` 	= '".App::String($_POST["data"]["rightmobile2"][$Key])."'
								");
							}
						}
						
						Logs::Add('Callid `'.$_POST["call_id"].'` toegevoegd.', $_POST['call_id'], $_POST['companyid']);
						
						// Send SMS
						if($_POST["sms"] == 1 && $_POST['smsto']){
							
							$Template = new Template();
							$Template->Assign("oCall", $_POST);

							$oSms = new Sms($Template->Content("sms.call.php"), $_POST['smsto'], $Reseller->SmsName);
							$oSms->SendSMS('http://sms.informaxion.nl/gateway/sendsms');
							
						}
						
						// Send Mail
						if($_POST["send"] == 1){
							
							$oCall = Calls::getCallObjectById($_POST["call_id"]);
							
							switch($oCall->customer_maildelivery){
								
								case "1":
							
									$AllTo = @explode(",",$oCall->call_sendto);
									$AllTo = @array_unique($AllTo);
															
									foreach($AllTo as $Mailaddress){
										
										if($Mailaddress){
										
											$Template = new Template();
											
											$Template->Assign("oCall", $oCall);
											$Template->Assign("Mailaddress", $Mailaddress);
											
											if($oCall->customer_see == 4){
												$Message = $Template->Content("mail.call.short.bd.php");
											}
											else{								
												if($Customer->maillayout == "short")
													$Message = $Template->Content("mail.call.short.php");	
												else
													$Message = $Template->Content("mail.call.php");
											}
											
											$oSettings = (object) $Reseller->Mailer;
											
											$oMail = new PHPMailer();
											if($oSettings->SMTP){
												$oMail->IsSMTP();
												$oMail->SMTPAuth = false;
												$oMail->Host = $oSettings->Host;
												$oMail->Port = $oSettings->Port;
											}
											$oMail->SetFrom($oSettings->From, $oSettings->Name);
											if($oCall->customer_subject){
																			
												$oSubject = $oCall->customer_subject;
												
												$oSubject = str_replace("{datum}", date("d-m-Y"), $oSubject);
												$oSubject = str_replace("{tijd}", date("H:i"), $oSubject);
												$oSubject = str_replace("{bedrijfsnaam}", $oCall->call_relationname, $oSubject);
												$oSubject = str_replace("{contactpersoon}", $oCall->call_contactperson, $oSubject);
												$oSubject = str_replace("{adres}", $oCall->call_address, $oSubject);
												$oSubject = str_replace("{huisnummer}", $oCall->call_number, $oSubject);
												$oSubject = str_replace("{postcode}", $oCall->call_zipcode, $oSubject);
												$oSubject = str_replace("{plaats}", $oCall->call_place, $oSubject);
												$oSubject = str_replace("{telefoon}", $oCall->call_phonenumber, $oSubject);
												$oSubject = str_replace("{mobiel}", $oCall->call_mobilenumber, $oSubject);
												$oSubject = str_replace("{email}", $oCall->call_mailaddress, $oSubject);
												$oSubject = str_replace("{klantnr}", $oCall->call_refid, $oSubject);
												$oSubject = str_replace("{bericht}", $oCall->call_content, $oSubject);
												$oSubject = str_replace("{orderid}", $oCall->call_orderid, $oSubject);
												$oSubject = str_replace("{oproep_type}", $oCall->call_job_name, $oSubject);
												$oSubject = str_replace("{geboortedatum}", $oCall->call_birthdate, $oSubject);
												
												foreach(Customers::getExtraFieldsByCustomerId($oCall->customer_id) as $Fieldname => $Field){
													$oSubject = str_replace("{".$Field->fieldname."}", $oCall->{$Fieldname}, $oSubject);
												}
												
												$oMail->Subject = $oSubject;
											}
											else{
												
												$oSubject = $oSettings->Subject;
												
												$oSubject = str_replace("{datum}", date("d-m-Y"), $oSubject);
												$oSubject = str_replace("{tijd}", date("H:i"), $oSubject);
												$oSubject = str_replace("{bedrijfsnaam}", $oCall->call_relationname, $oSubject);
												$oSubject = str_replace("{contactpersoon}", $oCall->call_contactperson, $oSubject);
												$oSubject = str_replace("{adres}", $oCall->call_address, $oSubject);
												$oSubject = str_replace("{huisnummer}", $oCall->call_number, $oSubject);
												$oSubject = str_replace("{postcode}", $oCall->call_zipcode, $oSubject);
												$oSubject = str_replace("{plaats}", $oCall->call_place, $oSubject);
												$oSubject = str_replace("{telefoon}", $oCall->call_phonenumber, $oSubject);
												$oSubject = str_replace("{mobiel}", $oCall->call_mobilenumber, $oSubject);
												$oSubject = str_replace("{email}", $oCall->call_mailaddress, $oSubject);
												$oSubject = str_replace("{klantnr}", $oCall->call_refid, $oSubject);
												$oSubject = str_replace("{bericht}", $oCall->call_content, $oSubject);
												$oSubject = str_replace("{orderid}", $oCall->call_orderid, $oSubject);
												$oSubject = str_replace("{oproep_type}", $oCall->call_job_name, $oSubject);
												$oSubject = str_replace("{geboortedatum}", $oCall->call_birthdate, $oSubject);
												
												foreach(Customers::getExtraFieldsByCustomerId($oCall->customer_id) as $Fieldname => $Field){
													$oSubject = str_replace("{".$Field->fieldname."}", $oCall->{$Fieldname}, $oSubject);
												}
												
												$oMail->Subject = ($oCall->call_orderid ? $oCall->call_orderid." | " : "") . $oSubject;
											}
											$oMail->MsgHTML($Message);
											$oMail->AddAddress($Mailaddress, $Mailaddress);
											
											if($oSettings->BCC)
												$oMail->AddBCC($oSettings->BCCto, $oSettings->BCCto);
											
											$oMail->Send();
										}										
									}
								break;
								case "2":
																			
									$Template = new Template();
									$Template->Assign("oCall", $oCall);
									
									if($oCall->customer_see == 4){
										$Message = $Template->Content("mail.call.short.bd.php");
									}
									else{								
										if($Customer->maillayout == "short")
											$Message = $Template->Content("mail.call.short.php");	
										else
											$Message = $Template->Content("mail.call.php");
									}
									
									$oSettings = (object) $Reseller->Mailer;
									
									$oMail = new PHPMailer();
									if($oSettings->SMTP){
										$oMail->IsSMTP();
										$oMail->SMTPAuth = false;
										$oMail->Host = $oSettings->Host;
										$oMail->Port = $oSettings->Port;
									}
									$oMail->SetFrom($oSettings->From, $oSettings->Name);
									$oMail->Subject = "Overzicht ".date("d-m-Y H:i");
									$oMail->MsgHTML($Message);
									$oMail->AddAddress(str_replace('-','',$oCall->customer_faxnumber)."-sqPUevjG@tasvenray.faxservice.nl");
									
									if($oSettings->BCC)
										$oMail->AddBCC($oSettings->BCCto, $oSettings->BCCto);
									
									$oMail->Send();							
								
								break;
							}
							
							$Database->Query("
								UPDATE `".CALLS."` SET ".CALLS.".`sended` = '1' WHERE ".CALLS.".`id` = '".$_POST["call_id"]."' AND ".CALLS.".`companyid` = '".$_POST["companyid"]."'
							");
						}
						
						// Archive
						if($_POST["archief"] == 1){
							$Database->Query("
								UPDATE `".CALLS."` SET ".CALLS.".`sended` = '1' WHERE ".CALLS.".`id` = '".$_POST["call_id"]."' AND ".CALLS.".`companyid` = '".$_POST["companyid"]."'
							");
						}
						
						App::Redirect($_SERVER['REQUEST_URI']);
						exit();
					break;
					case "getMechanics":
						echo Customers::listMechanicsByCustomer($_POST["customerid"], true);
						exit();
					break;
					case "getAbbreviations":
						$Abbreviations = Abbreviations::listAbbreviations(false, 1, $_POST["companyid"]);
						$Return = array();
						foreach($Abbreviations as $Abbreviation){
							if($Abbreviation->getCode())
								$Return[utf8_encode($Abbreviation->getCode())] = utf8_encode($Abbreviation->getDescription());
						}
						echo @json_encode($Return);
						exit();
					break;
					case "getAbbreviationsBd":
						$Abbreviations = Abbreviations::listAbbreviations(false, 4);
						$Return = array();
						foreach($Abbreviations as $Abbreviation){
							$Return[utf8_encode($Abbreviation->getCode())] = utf8_encode($Abbreviation->getDescription());
						}
						echo @json_encode($Return);
						exit();
					break;
				}
			}
			
			// Main Application
			$wRequest = App::wRequest();
			
			if($_SESSION['login']){
				
				switch($wRequest[1]){
					case "requests":
						switch($wRequest[2]){
							case "list":
								
								$Database = new Database();

								switch($wRequest[3]){
									case "customers":
										
										$Query = Customers::searchCustomers($_GET['q']);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(($oData->customername), $oData->id, $oData->see);
										}
										echo json_encode($Array);
										exit();	
									break;
									case "abbreviations":
										
										$Query = Abbreviations::searchAbbreviation($_GET['q'], 1, $wRequest[4]);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(($oData->getDescription()));
										}
										echo json_encode($Array);
										exit();	
									break;
									case "abbreviationsbd":
										
										$Query = Abbreviations::searchAbbreviation($_GET['q'], 4);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(($oData->getDescription()));
										}
										echo json_encode($Array);
										exit();	
									break;
									case "relation":
										
										$Query = Customers::searchRelations($wRequest[5],$wRequest[4],$_GET['q']);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(
												($oData->{$wRequest[4]}),
												
												$oData->id,
												($oData->refid),
												($oData->relationname),
												($oData->contactperson),
												($oData->address),
												($oData->number),
												($oData->zipcode),
												($oData->place),
												($oData->phonenumber),
												($oData->mobilenumber),
												($oData->mailaddress),
												($oData->comment),
												($oData->birthdate),
												
												($oData->custom1),
												($oData->custom2),
												($oData->custom3),
												($oData->custom4),
												($oData->custom5),
												($oData->custom6),
												($oData->custom7),
												($oData->custom8),
												($oData->custom9),
												($oData->custom10)
											);
										}
										echo json_encode($Array);
										exit();	
									break;
									case "relationzipcode":
										
										$Query = Customers::searchRelationsZipcode($wRequest[5],$wRequest[4],$_GET['q']);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(
												($oData->{$wRequest[4]}),
												
												$oData->id,
												($oData->refid),
												($oData->relationname),
												($oData->contactperson),
												($oData->address),
												($oData->number),
												($oData->zipcode),
												($oData->place),
												($oData->phonenumber),
												($oData->mobilenumber),
												($oData->mailaddress),
												($oData->comment),
												($oData->birthdate),
												
												($oData->custom1),
												($oData->custom2),
												($oData->custom3),
												($oData->custom4),
												($oData->custom5),
												($oData->custom6),
												($oData->custom7),
												($oData->custom8),
												($oData->custom9),
												($oData->custom10)
											);
										}
										echo json_encode($Array);
										exit();	
									break;
									case "relationaddress":
										
										$Query = Customers::searchRelationsAddress($wRequest[4],$_GET['q']);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(
												($oData->address),
												
												$oData->id,
												($oData->refid),
												($oData->relationname),
												($oData->contactperson),
												($oData->address),
												($oData->number),
												($oData->zipcode),
												($oData->place),
												($oData->phonenumber),
												($oData->mobilenumber),
												($oData->mailaddress),
												($oData->comment),
												($oData->birthdate),
												
												($oData->custom1),
												($oData->custom2),
												($oData->custom3),
												($oData->custom4),
												($oData->custom5),
												($oData->custom6),
												($oData->custom7),
												($oData->custom8),
												($oData->custom9),
												($oData->custom10)
											);
										}
										echo json_encode($Array);
										exit();	
									break;
									case "relationnumber":
										
										$Query = Customers::searchRelationsNumber($wRequest[4],urldecode($wRequest[5]),$_GET['q']);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(
												($oData->number),
												
												$oData->id,
												($oData->refid),
												($oData->relationname),
												($oData->contactperson),
												($oData->address),
												($oData->number),
												($oData->zipcode),
												($oData->place),
												($oData->phonenumber),
												($oData->mobilenumber),
												($oData->mailaddress),
												($oData->comment),
												($oData->birthdate),
												
												($oData->custom1),
												($oData->custom2),
												($oData->custom3),
												($oData->custom4),
												($oData->custom5),
												($oData->custom6),
												($oData->custom7),
												($oData->custom8),
												($oData->custom9),
												($oData->custom10)
											);
										}
										echo json_encode($Array);
										exit();	
									break;
									case "mechanics":
										
										$Query = Customers::searchMechanics($wRequest[4],$_GET['q']);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(
												($oData->mechanicname),
												
												$oData->id,
												($oData->mechanicname),
												($oData->phonenumber),
												($oData->mobilenumber),
												($oData->sms),
												($oData->mailaddress),
												($oData->info ? true : false),
												($oData->auto_sms),
												(Customers::listSpecialitiesByMechanicToday($oData->id) ? true : false),
												($oData->urgentie == "true" ? true : (Customers::listSpecialitiesByMechanicTodayUrg($oData->id) ? true : false))
											);
										}
										echo json_encode($Array);
										exit();	
									break;
									case "users":
										
										$Query = Login::searchUsers($_GET['q']);
										
										$Array = array();
										foreach($Query as $oData){
											$Array[] = array(utf8_encode($oData->name), $oData->id);
										}
										echo json_encode($Array);
										exit();	
									break;
								}
							}
							echo json_encode($Array);
							exit();							
						break;
					break;
				}
				
				$Template = new Template();
				
				if(!in_array("ajax",$wRequest) && !in_array("loader",$wRequest)){
					$Template->Assign("oMail", Mail::NewMail());
					$Template->Assign("oOnline", Login::OnlineUsers());
					$Template->Assign("OpenCalls", Calls::getOpenCalls());
					$Template->Assign("UnfinishedCalls", Calls::getUnfinishedCalls());
				}
				
				switch($wRequest[1]){
					case "ajax":
						switch($wRequest[2]){
							case "mechanic.view":
								
								$oMechanic = new Customers();
								$Template->Assign("oMechanic", $oMechanic->getMechanicsById($wRequest[3]));
								$Template->Assign("oSpecialities", Customers::listSpecialitiesByMechanicToday($wRequest[3]));
								$Template->Display("modules/ajax/mechanic.view.php");	
								exit();
							break;
							case "relation.view":
								
								$oRelation = new Customers();
								$Template->Assign("Relation", $oRelation->getRelationsById($wRequest[3]));
								$Template->Display("modules/ajax/relation.view.php");	
								exit();
							break;
							case "calls.today":
								
								$Template->Assign("oId", $wRequest[3]);
								$Template->Display("modules/ajax/calls.today.php");	
								exit();
							break;
							case "specials.all":
							
								$Template->Assign("Specialities", Customers::listSpecialitiesByCustomerToday($wRequest[3]));
								$Template->Display("modules/ajax/specials.all.php");
								exit();
							break;
							case "specials.fast":
							
								$Template->Assign("Specialities", Customers::listSpecialitiesByCustomerToday($wRequest[3]));
								$Template->Display("modules/ajax/specials.fast.php");
								exit();
							break;
							case "search.zipcode":
							
								if($wRequest[3] == "frame")
									$Template->Display("modules/ajax/search.zipcode.frame.php");
								else
									$Template->Display("modules/ajax/search.zipcode.php");
								exit();
							break;
							case "send.mailto":
								
								$Template->Assign("oId", $wRequest[3]);
								$Template->Display("modules/ajax/send.mailto.php");
								exit();
							break;
							case "send.smsto":
							
								$Template->Assign("oId", $wRequest[3]);
								$Template->Display("modules/ajax/send.smsto.php");
								exit();
							break;
							case "log.view":
								
								$oLog = new Logs();
								$Template->Assign("Log", $oLog->getLogById($wRequest[3]));
								$Template->Display("modules/ajax/log.view.php");	
								exit();
							break;	
							case "setting.edit":
								
								$Template->Assign("oSetting", Settings::getSettingByKey($wRequest[3]));
								$Template->Display("modules/ajax/setting.edit.php");	
								exit();
							break;					
						}
						exit();
					break;
					case "specialexports":
						
						if(file_exists($_SERVER['DOCUMENT_ROOT']."/specialexports/".md5($wRequest[2]).".xlsx")){
						
							header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
							header('Content-Disposition: attachment;filename="Meldingsgroep: '.urldecode($_GET["name"]).'.xlsx"');
							header('Cache-Control: max-age=0');
							
							echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/specialexports/".md5($wRequest[2]).".xlsx");
							exit();
						}
						else echo "Onbekend bestand!";
						
						exit();
					break;
					case "dothisnow":
						
						/*$Database = new Database();
						
						$All = $Database->Select("SELECT * FROM `system_employees`", rows_object);
						
						$Mech = $Database->Select("SELECT `mechanicname` FROM `system_mechanics`", rows_object);
						
						$Mecha = array();
						foreach($Mech as $Mechs){
							$Mecha[] = $Mechs->mechanicname;
						}

						echo "Start";

						foreach($All as $Alles){
							if(!in_array($Alles->employeename,$Mecha)){
								
								$Database->Query("INSERT INTO `system_mechanics` SET
									customerid 		= '".$Alles->customerid."',
									mechanicname 	= '".addslashes($Alles->employeename)."',
									phonenumber 	= '".$Alles->phonenumber."',
									mailaddress 	= '".addslashes($Alles->mailaddress)."',
									create_date 	= NOW()
								");
								
							}						
						}
						
						echo "Klaar!";*/
						
						exit();
					break;
					case "checkip":
						
						
					
						exit();
					break;
					case "printmail":
					
						$Template->Assign("oId", $wRequest[2]);
						$Template->Display("modules/mail/print.php");	
						
						exit();
					break;
					case "calls":
						switch($wRequest[2]){
							case "createcall":
							
								$Database = new Database();
								$Company = $Database->Select("SELECT id FROM `".CUSTOMERS."` WHERE `tapi_id` = '".$_GET["ID"]."'", single_object);
								
								if($_GET["UserId"] === "1"){
									
									print_r($_GET);
									
									exit();	
								}
								
								if($Company->id){

									if($_POST["see"] == 4){
										$oJob = 60;
									}
									else{
										$TimeStamp = (60*60*60)*date('H') + (60*60)*date('i');						
										if($TimeStamp >= '0' && $TimeStamp <= '1508400')
											$oJob = 3;
										elseif($TimeStamp >= '1512000' && $TimeStamp <= '4100400')
											$oJob = 1;
										elseif($TimeStamp >= '4104000' && $TimeStamp <= '4964400')
											$oJob = 2;
										elseif($TimeStamp >= '4968000' && $TimeStamp <= '5180400')
											$oJob = 3;
									}
									
									$_POST["companyid"] = $Company->id;
									$_POST["job"] 		= $oJob;
									$_POST["userid"] 	= $_SESSION["login"];
									$_POST["lock_user"] = $_SESSION["login"];
									$_POST["datecall"] 	= date("Y-m-d");
									$_POST["starttime"] = date("H:i:s");
									$_POST["endtime"] 	= date("H:i:s");
									$_POST["locked"] 	= "true";
									$_POST["active"] 	= "false";
									
									$Database = new Database();
									$Database->Insert(CALLS, "id");
									
									App::Redirect("/calls/bewerken/".mysql_insert_id()."/loader2");
								}
								else
									App::Redirect("/calls/nieuw");
								exit();
							break;
							case "nieuw":
							
								$Template->Assign("oTitle", "Registreer nieuwe Call");
								$Template->Display("modules/calls/call.view.new.php");	
								
							break;
							case "bewerken":
								
								$Call = new Calls();
								$Call = $Call->getCallById($wRequest[3]);
								if($Call === false)
									die("Call bestaat niet");
								
								$_SESSION['archief1']['selectcompany'] = $Call->customer_name;
								$_SESSION['archief1']['selectid'] = $Call->customer_id;
								$_SESSION['archief1']['selectcode'] = $Call->customer_code;
								$_SESSION['archief1']['startdate'] = date('Y-m-d');
								$_SESSION['archief1']['enddate'] = date('Y-m-d');
								
								$Database = new Database();
								$Database->Query("
									UPDATE `".CALLS."` SET ".CALLS.".`locked` = 'true', ".CALLS.".`lock_user` = '".$_SESSION["login"]."' WHERE ".CALLS.".`id` = '".$Call->call_id."' AND ".CALLS.".`companyid` = '".$Call->customer_id."'
								");
								
								$Template->Assign("Call", $Call);
								$Template->Assign("Departments", Departments::listDepartmentsByCustomer($Call->customer_id, $Call->customer_see));
								$Template->Assign("Specialities", Customers::listSpecialitiesByCustomerToday($Call->customer_id));
								$Template->Assign("Storing", Customers::listStoringenByCustomerToday($Call->customer_id));
								$Template->Assign("Special", Special::listSpecialByCustomer($Call->customer_id));
								$Template->Assign("Actions", Calls::getActionsByCallId($Call->call_id));
								$Template->Assign("Mechanics", Customers::listMechanicsByCustomer($Call->customer_id));
								
								switch($wRequest[4]){
									case "loader":
										$Template->Assign("oTitle", "Registreer nieuwe Call");
										$Template->Assign("loader", true);
										$Template->Assign("oView", "new");
										$Template->Assign("oReturnPath", "/");
									break;
									case "loader2":
										$Template->Assign("oTitle", "Registreer nieuwe Call");
										$Template->Assign("loader", false);
										$Template->Assign("loader2", true);
										$Template->Assign("oView", "new");
										$Template->Assign("oReturnPath", "/");
									break;
									default:
										$Template->Assign("oTitle", "Call wijzigen");
										$Template->Assign("oView", "edit");
										$Template->Assign("oReturnPath", "/?systemmodule=register-edit-call&view=manager");
									break;
								}
								
								$Template->Display("modules/calls/call.view.edit.php");	
								
							break;
							case "archief":
								
								$Call = new Calls();
								$Call = $Call->getCallById($wRequest[3]);
								if($Call === false)
									die("Call bestaat niet");
								
								$_SESSION['archief1']['selectcompany'] = $Call->customer_name;
								$_SESSION['archief1']['selectid'] = $Call->customer_id;
								$_SESSION['archief1']['selectcode'] = $Call->customer_code;
								$_SESSION['archief1']['startdate'] = date('Y-m-d');
								$_SESSION['archief1']['enddate'] = date('Y-m-d');
								
								$Database = new Database();
								$Database->Query("
									UPDATE `".CALLS."` SET ".CALLS.".`locked` = 'true', ".CALLS.".`lock_user` = '".$_SESSION["login"]."' WHERE ".CALLS.".`id` = '".$Call->call_id."' AND ".CALLS.".`companyid` = '".$Call->customer_id."'
								");
								
								$Template->Assign("Call", $Call);
								$Template->Assign("Departments", Departments::listDepartmentsByCustomer($Call->customer_id, $Call->customer_see));
								$Template->Assign("Specialities", Customers::listSpecialitiesByCustomerToday($Call->customer_id));
								$Template->Assign("Storing", Customers::listStoringenByCustomerToday($Call->customer_id));
								$Template->Assign("Special", Special::listSpecialByCustomer($Call->customer_id));
								$Template->Assign("Actions", Calls::getActionsByCallId($Call->call_id));
								$Template->Assign("Mechanics", Customers::listMechanicsByCustomer($Call->customer_id));
								
								$Template->Assign("oTitle", "Zoeken in archief");
								$Template->Assign("oView", "archive");
								$Template->Assign("oReturnPath", "/?systemmodule=register-archive-call&view=manager");
								
								$Template->Display("modules/calls/call.view.edit.php");	
								
							break;
						}
						exit();
					break;
					case "facturatie":
						
						if($_POST){
							
							$Database = new Database();
							if($_POST["pdf"]){
								
								$oSettings = $Database->Select("SELECT * FROM `system_invoices_settings` ORDER BY system_invoices_settings.`setting_id`", rows_object);
								if(in_array($_POST['see'], array(1,5,7,8,9,10)))
									$oCustomer = $Database->Select("SELECT * FROM `#__customers` WHERE #__customers.`see` IN(1,5,7,8,9,10) AND #__customers.`active` = '1' ORDER BY #__customers.`customername`", rows_object);
								else
									$oCustomer = $Database->Select("SELECT * FROM `#__customers` WHERE #__customers.`see` = '".$_POST['see']."' AND #__customers.`active` = '1' ORDER BY #__customers.`customername`", rows_object);
								
								if($_POST['InvoiceInvoiceId'] != 0){
									$InvoiceInvoiceId = $_POST['InvoiceInvoiceId'];				
								}
								else{
									switch($_POST['see']){
										case 1:
										case 5:
										case 7:
										case 8:
										case 9:
										case 10:
											$InvoiceInvoiceId = $oSettings[1]->setting_value;
										break;
										case 2:
											$InvoiceInvoiceId = $oSettings[8]->setting_value;
										break;
										case 6:
											$InvoiceInvoiceId = $oSettings[12]->setting_value;
										break;
									}
								}
				
								foreach($oCustomer as $Customer){
									
									$Postdata = $_POST["pdf"][$Customer->id];
										
									if($Postdata["makeinvoice"]){
									
										$CalcTotal = 0;					
										$Database->Query("INSERT INTO `system_invoices` SET
											system_invoices.`customer_id` 				= '".$Customer->id."',
											system_invoices.`invoice_invoiceid` 		= '".date("y").$InvoiceInvoiceId."',
											system_invoices.`invoice_date` 				= '".date("Y-m-d", strtotime($_POST["date"]))."',
											system_invoices.`invoice_see` 				= '".(in_array($_POST['see'],array(1,5,7,8,9,10)) ? 1 : $_POST['see'])."',
											system_invoices.`invoice_company` 			= '".addslashes($Customer->invoice_company)."',
											system_invoices.`invoice_name` 				= '".addslashes($Customer->invoice_contact)."',
											system_invoices.`invoice_address` 			= '".addslashes($Customer->invoice_address)."',
											system_invoices.`invoice_zipcode` 			= '".$Customer->invoice_zipcode."',
											system_invoices.`invoice_place` 			= '".addslashes($Customer->invoice_place)."',
											system_invoices.`invoice_contractnumber` 	= '".addslashes($Customer->contractnr)."',
											system_invoices.`invoice_feature` 			= '".addslashes($Customer->uwkenmerk)."',
											system_invoices.`invoice_contractid` 		= '".addslashes($Customer->machteging_kenmerk)."',
											system_invoices.`invoice_type` 				= '".$Customer->pay_type."',
											system_invoices.`invoice_send_type` 		= '".$Customer->invoice_type."',
											system_invoices.`invoice_iban` 				= '".$Customer->iban."',
											system_invoices.`invoice_discount_name` 	= '".addslashes($Customer->invoicediscountname)."',
											system_invoices.`invoice_discount_value` 	= '".$Customer->invoicediscountperc."',
											system_invoices.`invoice_complete` 			= ''
										");
										
										$InvoiceId = mysql_insert_id();					
					
										if($Postdata["abboname"] && $Postdata["abboprice"]){
												
											$Database->Query("INSERT INTO `system_invoices_items` SET
												system_invoices_items.`invoice_id` 		= '".$InvoiceId."',
												system_invoices_items.`item_name` 		= '".addslashes($Postdata["abboname"])."',
												system_invoices_items.`item_amount` 	= '".($Postdata["abboamount"])."',
												system_invoices_items.`item_price` 		= '".str_replace(",",".",$Postdata["abboprice"])."',
												system_invoices_items.`item_group` 		= '0'
											");
					
											$CalcTotal += str_replace(",",".",$Postdata["abboprice"]) * $Postdata["abboamount"];
										
										}
										
										if($Postdata["abboname2"] && $Postdata["abboprice2"]){
												
											$Database->Query("INSERT INTO `system_invoices_items` SET
												system_invoices_items.`invoice_id` 		= '".$InvoiceId."',
												system_invoices_items.`item_name` 		= '".addslashes($Postdata["abboname2"])."',
												system_invoices_items.`item_amount` 	= '".($Postdata["abboamount2"])."',
												system_invoices_items.`item_price` 		= '".str_replace(",",".",$Postdata["abboprice2"])."',
												system_invoices_items.`item_group` 		= '0'
											");
					
											$CalcTotal += str_replace(",",".",$Postdata["abboprice2"]) * $Postdata["abboamount2"];
										
										}
										
										if($Postdata["mailabboname"] && $Postdata["mailabboprice"]){
										
											$Database->Query("INSERT INTO `system_invoices_items` SET
												system_invoices_items.`invoice_id` 		= '".$InvoiceId."',
												system_invoices_items.`item_name` 		= '".addslashes($Postdata["mailabboname"])."',
												system_invoices_items.`item_amount` 	= '".($Postdata["mailabboamount"])."',
												system_invoices_items.`item_price` 		= '".str_replace(",",".",$Postdata["mailabboprice"])."',
												system_invoices_items.`item_group` 		= '0'
											");
					
											$CalcTotal += str_replace(",",".",$Postdata["mailabboprice"]) * $Postdata["mailabboamount"];
										
										}
															
										if($Postdata["job"]){
											foreach($Postdata["job"] as $DepartmentId => $Department){
												
												foreach($Department as $Jobs){
													foreach($Jobs as $Job){
														if($Job["description"]){
															$Database->Query("INSERT INTO `system_invoices_items` SET
																system_invoices_items.`invoice_id` 		= '".$InvoiceId."',
																system_invoices_items.`item_name` 		= '".addslashes($Job["description"])."',
																system_invoices_items.`item_amount` 	= '".$Job["amount"]."',
																system_invoices_items.`item_price` 		= '".str_replace(",",".",$Job["price"])."',
																system_invoices_items.`item_group` 		= '".$DepartmentId."'
															");
															
															$CalcTotal += str_replace(",",".",$Job["price"]) * $Job["amount"];
														}
													}
												}
											}						
										}
										
										if($Customer->invoicediscountperc)
											$CalcTotal = $CalcTotal - ( $CalcTotal / 100 * $Customer->invoicediscountperc );
										
										$CalcVat = ( $CalcTotal / 100 * 21 );
										
										$Database->Query("UPDATE `system_invoices` SET
												system_invoices.`invoice_vat` 				= '".$CalcVat."',
												system_invoices.`invoice_price` 			= '".$CalcTotal."',
												system_invoices.`invoice_pdf` 				= '".App::Title($Customer->invoice_company)." - ".$oSettings[4]->setting_value." - ".date("y").$InvoiceInvoiceId.".pdf'
											WHERE
												system_invoices.`invoice_id` 				= '".$InvoiceId."'
										");
				
										$Invoice = $Database->Select("SELECT system_invoices.* FROM `system_invoices` WHERE system_invoices.`invoice_id` = '".$InvoiceId."' LIMIT 1", single_object);
										
										$pdf = new Invoice('P','mm','A4');
										$pdf->setInvoice($Invoice);
										$pdf->setSee($_POST['see']);
										$pdf->AliasNbPages();
										$pdf->AddPage();
										$pdf->SetFont('Arial','',10);
										$pdf->CreateInvoice($InvoiceId);
										$pdf->Output($_SERVER['DOCUMENT_ROOT']."/invoices/".App::Title($Customer->invoice_company)." - ".$oSettings[4]->setting_value." - ".date("y").$InvoiceInvoiceId.".pdf");
																
										$InvoiceInvoiceId++;
									}
									
								}
								
								if($_POST["Next"] >= $_POST["Total"]){
									App::Message("Alle facturen zijn aangemaakt.", succes);
									App::Redirect("/?systemmodule=invoice-overview&view=manager");
									exit();	
								}
								
								$_POST["InvoiceInvoiceId"] = $InvoiceInvoiceId;
								
							}

							if($_POST['selectid']){
								$Query = $Database->Select("SELECT #__customers.`id`,
											#__customers.`invoice_company`,
											#__customers.`invoice_contact`,
											#__customers.`invoice_mail`,
											#__customers.`invoice_address`,
											#__customers.`invoice_zipcode`,
											#__customers.`invoice_place`,
											#__customers.`see`,
											#__customers.`abboname`,
											#__customers.`abboprice`,
											#__customers.`abboname2`,
											#__customers.`abboprice2`,
											#__customers.`mailabboname`,
											#__customers.`mailabboprice`,
											#__customers.`invoicediscountperc`,
											#__customers.`invoicediscountname` FROM `#__customers` WHERE `active` = 1 AND `id` = ".(int) $_POST['selectid']." LIMIT 1", rows_object);
							}
							else{
								if(in_array($_POST['see'], array(1,5,7,8,9,10))){
									$Query = $Database->Select("
										SELECT
											#__customers.`id`,
											#__customers.`invoice_company`,
											#__customers.`invoice_contact`,
											#__customers.`invoice_mail`,
											#__customers.`invoice_address`,
											#__customers.`invoice_zipcode`,
											#__customers.`invoice_place`,
											#__customers.`see`,
											#__customers.`abboname`,
											#__customers.`abboprice`,
											#__customers.`abboname2`,
											#__customers.`abboprice2`,
											#__customers.`mailabboname`,
											#__customers.`mailabboprice`,
											#__customers.`invoicediscountperc`,
											#__customers.`invoicediscountname`
										FROM
											`#__customers`
										WHERE
											#__customers.`see` IN(1,5,7,8,9,10) AND
											#__customers.`active` = 1 AND
											(
												SELECT
													COUNT(#__customers_connect.`id`)
												FROM
													`#__customers_connect`
												WHERE
													#__customers_connect.`customer_connect_id` = #__customers.`id`
											) < 1 
										ORDER BY
											#__customers.`customername`
										", rows_object);
								}
								else{
									$Query = $Database->Select("
										SELECT
											#__customers.`id`,
											#__customers.`invoice_company`,
											#__customers.`invoice_contact`,
											#__customers.`invoice_mail`,
											#__customers.`invoice_address`,
											#__customers.`invoice_zipcode`,
											#__customers.`invoice_place`,
											#__customers.`see`,
											#__customers.`abboname`,
											#__customers.`abboprice`,
											#__customers.`abboname2`,
											#__customers.`abboprice2`,
											#__customers.`mailabboname`,
											#__customers.`mailabboprice`,
											#__customers.`invoicediscountperc`,
											#__customers.`invoicediscountname`
										FROM
											`#__customers`
										WHERE
											#__customers.`see` = ".(int) $_POST['see']." AND
											#__customers.`active` = 1 AND
											(
												SELECT
													COUNT(#__customers_connect.`id`)
												FROM
													`#__customers_connect`
												WHERE
													#__customers_connect.`customer_connect_id` = #__customers.`id`
											) < 1 
										ORDER BY
											#__customers.`customername`
										", rows_object);
								}
							}
							
							$Total = count($Query);
							$oCalc = 1;
							
							$Template->Assign("Current", ($_POST["Next"] ? (int) $_POST["Next"] : 1));
							$Template->Assign("Total", $Total);
							$Template->Assign("Query", $Query);
							
							$Template->Display("modules/invoices/create.php");
							
						}
					
						exit();
					break;
					case "logboek":
						
						if($_POST["delete"])
							App::Redirect($_SERVER['REQUEST_URI']);
						
						if($_POST)
							$Template->Assign("oLog", Logs::searchLogs($_POST["customer_id"],$_POST["user_id"],$_POST["startdate"],$_POST["enddate"],1500));
						else
							$Template->Assign("oLog", Logs::listLogs(1500));
							
						$Template->Display("modules/log/view.php");
						
						exit();
					break;
					case "instellingen":
						
						$Template->Assign("oSettings", Settings::listSettings());
						$Template->Display("modules/settings/view.php");
						exit();
					
					break;
					case "statistieken":
						
						switch($wRequest[2]){
							case "dag":
							
							
							break;
							case "maand":
							
							
							break;
							case true:
								switch($wRequest[2]){
									case true:
										switch($wRequest[3]){
											case true:
												$Template->Assign("oStats", Calls::getCallStatsByDay($wRequest[2], $wRequest[3]));
												$Template->Display("modules/stats/view.month.php");
											break;
											case false:
												$Template->Assign("oYear",$wRequest[2]);
												$Template->Assign("oStats", Calls::getCallStatsByMonth($wRequest[2]));
												$Template->Display("modules/stats/view.year.php");
											break;
										}
									break;
								}
							break;
							case false:
								$Template->Assign("oStats", Calls::getCallStatsByYear());
								$Template->Display("modules/stats/view.php");
							break;
						}
						exit();
					break;
					case "graph":
						switch($wRequest[2]){
							case "bar":
								
								$DataSet = new pData;
								$DataSet->AddPoint(explode(",", $_GET["set1"]),"Serie1");
								$DataSet->AddPoint(explode(",", $_GET["set2"]),"Serie3");
								$DataSet->AddAllSeries();
								$DataSet->RemoveSerie("Serie3");
								$DataSet->SetAbsciseLabelSerie("Serie3");
								$DataSet->SetSerieName("Aantal","Serie1");
								$DataSet->SetYAxisName("Aantal");
								
								$Chart = new pChart(710,230);  
								$Chart->setFontProperties("/system/fonts/tahoma.ttf",8);  
								$Chart->setGraphArea(75,15,680,200);  
								$Chart->drawGraphArea(255,255,255,TRUE);  
								$Chart->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);     
								$Chart->drawGrid(4,TRUE,230,230,230,50);  
								$Chart->setFontProperties("/system/fonts/tahoma.ttf",6);  
								$Chart->drawTreshold(0,143,55,72,TRUE,TRUE);  
								$Chart->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);  
								$Chart->Render();
								
								exit();
								
							break;
						}
					break;
				}
			}
		}
		
		static function Message($aMessage = false, $aType = false){
			if($aMessage && $aType)
				$_SESSION['message'][$aType] = $aMessage;	
			else{
				if($_SESSION['message']){
					foreach($_SESSION['message'] as $aType => $aMessage);
					switch($aType){
						case "succes":
							$oMessage = "<div class=\"".$aType."\"><div>Succesvol</div><p>".$aMessage."</p></div>";
						break;
						case "error":
							$oMessage = "<div class=\"".$aType."\"><div>Foutmelding</div><p>".$aMessage."</p></div>";
						break;
						case "warning":
							$oMessage = "<div class=\"".$aType."\"><div>Waarschuwing</div><p>".$aMessage."</p></div>";
						break;
						case "info":
							$oMessage = "<div class=\"".$aType."\"><div>Informatie</div><p>".$aMessage."</p></div>";
						break;
					}
					$_SESSION['message'] = false;
					return $oMessage;					
				}
			}
		}
		
		static function UserSee(){
			
			$Database = new Database();
			$User = $Database->Select("SELECT ".LOGIN.".`see` FROM `".LOGIN."` WHERE ".LOGIN.".`id`='".$_SESSION['login']."'",single_object);
			return $User->see;
			
		}
		
		static function portalUser(){
			
			if($_SESSION['portal_user']){
				
				$Database = new Database();
				$User = $Database->Select("SELECT ".CUSTOMERS.".* FROM `".CUSTOMERS."` WHERE ".CUSTOMERS.".`id`='".$_SESSION['portal_user']."' LIMIT 1",single_object);
				
				$oReturn = (object) array();
				
				$oReturn->id = $User->id;
				$oReturn->customername = $User->customername;
				$oReturn->contactperson = $User->contactperson;
				$oReturn->address = $User->address;
				$oReturn->number = $User->number;
				$oReturn->zipcode = $User->zipcode;
				$oReturn->place = $User->place;
				$oReturn->phonenumber = $User->phonenumber;
				$oReturn->faxnumber = $User->faxnumber;
				$oReturn->mobilenumber = $User->mobilenumber;
				$oReturn->mailaddress = $User->mailaddress;
				$oReturn->invoice_company = $User->invoice_company;
				$oReturn->invoice_contact = $User->invoice_contact;
				$oReturn->invoice_address = $User->invoice_address;
				$oReturn->invoice_zipcode = $User->invoice_zipcode;
				$oReturn->invoice_place = $User->invoice_place;
				$oReturn->invoice_mail = $User->invoice_mail;
				$oReturn->invoice_tel = $User->invoice_tel;
				$oReturn->portal_active = $User->portal_active;
				$oReturn->portal_permissions = @json_decode($User->portal_permissions);
				$oReturn->portal_relationview = @json_decode($User->portal_relationview);
				$oReturn->portal_username = $User->portal_username;
				
				$oReturn->finishingprocess = $User->finishingprocess;
				$oReturn->currentinformation = $User->currentinformation;
				
				$oReturn->see = $User->see;
				$oReturn->maillayout = $User->maillayout;
				$oReturn->subject = $User->subject;
				
				return $oReturn;
			
			}
			else return false;
			
		}
		
		static function MimeType($filename){
			preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);
			switch(strtolower($fileSuffix[1])){
				case "js":
					return "application/x-javascript";
				case "json":
					return "application/json";
	 
				case "jpg":
				case "jpeg":
				case "jpe":
					return "image/jpg";
	 
				case "png":
				case "gif":
				case "bmp":
				case "tiff":
					return "image/".strtolower($fileSuffix[1]);
	 
				case "css":
					return "text/css";
	 
				case "xml":
					return "application/xml";
	 
				case "doc":
				case "docx":
					return "application/msword";
	 
				case "xls":
				case "xlt":
				case "xlm":
				case "xld":
				case "xla":
				case "xlc":
				case "xlw":
				case "xll":
					return "application/vnd.ms-excel";
	 
				case "ppt":
				case "pps":
					return "application/vnd.ms-powerpoint";
	 
				case "rtf":
					return "application/rtf";
	 
				case "pdf":
					return "application/pdf";
	 
				case "html":
				case "htm":
				case "php":
					return "text/html";
	 
				case "txt":
					return "text/plain";
	 
				case "mpeg":
				case "mpg":
				case "mpe":
					return "video/mpeg";
	 
				case "mp3":
					return "audio/mpeg3";
	 
				case "wav":
					return "audio/wav";
	 
				case "aiff":
				case "aif":
					return "audio/aiff";
	 
				case "avi":
					return "video/msvideo";
	 
				case "wmv":
					return "video/x-ms-wmv";
	 
				case "mov":
					return "video/quicktime";
	 
				case "zip":
					return "application/zip";
	 
				case "tar":
					return "application/x-tar";
	 
				case "swf":
					return "application/x-shockwave-flash";
	 
				default:
				 	if(function_exists("mime_content_type")){
					 	$fileSuffix = mime_content_type($filename);
				 	}
					return "unknown/" . trim($fileSuffix[0], ".");
			}
		}
		
		static function FolderDocs($WebsiteAlias){

			$imagebasedir = $_SERVER['DOCUMENT_ROOT']."/websites/".$WebsiteAlias."/files";
			$browsedirs = true;
			$supportedextentions = array('pdf','doc','docx','xls','xlsx','ppt','pptx');
			
			if((substr($imagebaseurl, -1, 1)!='/') && $imagebaseurl!='') $imagebaseurl = $imagebaseurl.'/';
			if((substr($imagebasedir, -1, 1)!='/') && $imagebasedir!='') $imagebasedir = $imagebasedir.'/';
				
			$leadon = $imagebasedir;
			if($leadon == '.') $leadon = '';
			if((substr($leadon, -1, 1) != '/') && $leadon != '') $leadon = $leadon.'/';
			$startdir = $leadon;
			
			if($_GET['dir']){
				$dirok = true;
				$dirnames = explode('/', $_GET['dir']);
				for($di = 0; $di < sizeof($dirnames); $di++){
					if($di<(sizeof($dirnames)-2)) $dotdotdir = $dotdotdir.$dirnames[$di].'/';
				}
				$leadon = $imagebasedir.$_GET['dir'];
			}

			$opendir = $leadon;
			if(!$leadon) $opendir = '.';
			if(!file_exists($opendir)){
				$opendir = '.';
				$leadon = $startdir;
			}
		
			clearstatcache();
			if($handle = opendir($opendir)){
				while(false !== ($file = readdir($handle))){
					if($file == "." || $file == ".." || $file[0] == ".") continue;
					if(@filetype($leadon.$file) == "dir"){
						if(!$browsedirs) continue;
						$n++;
						$dirs[$n] = $file."/";
					}
					else{
						$n++;
						$files[$n] = $file;
					}
				}
				closedir($handle); 
			}
			
			@natcasesort($dirs); 
			@natcasesort($files);
			$dirs = @array_values($dirs);
			$files = @array_values($files);
			if($dirok)
				$Folder->back = ($dotdotdir) ? $dotdotdir : false;

			$arsize = sizeof($dirs);
			for($i = 0; $i < $arsize; $i++){
				$dir = substr($dirs[$i], 0, strlen($dirs[$i]) - 1);
				$Folder->dirs[] = (object) array(
					"dir" => str_replace($imagebasedir, "", $leadon).$dirs[$i],
					"name" => $dir
				);
			}
							
			$arsize = sizeof($files);
			for($i = 0; $i < $arsize; $i++){
				$ext = strtolower(substr($files[$i], strrpos($files[$i], '.')+1));		
				if(in_array($ext, $supportedextentions)){					
					$Folder->files[] = (object) array(
						"dir" => str_replace($imagebasedir, "", $leadon).$files[$i],
						"name" => $files[$i],
						"ext" => $ext);	
				}
			}	
			
			return $Folder;		
		}
		
		static function MailCheck($mail){
			list($email_account, $email_domain) = split('@',$mail);
			if($email_domain) $result = checkdnsrr($email_domain,'MX');
			return $result;
		}
		
		static function Redirect($Str_Location, $Bln_Replace = 1, $Int_HRC = NULL){
			if(!headers_sent()){
				header('location: ' . urldecode($Str_Location), $Bln_Replace, $Int_HRC);
				exit;
			}
			exit('<script> window.location = "'.urldecode($Str_Location).'"; </script>');
			return;
		}
				
		static function PageRequests($wRequest){
			$qRequest = explode(':',$wRequest);
			$Calc = 1;
			foreach($qRequest as $Request){
				if($Calc == 1){
					$oRequest->page = $Request;
				}
				else{
					$Item = explode('=',$Request);
					$oRequest->$Item[0] = $Item[1];
				}
				$Calc++;
			}
			return $oRequest;
		}
		
		static function wRequest(){
			
			$oResults = explode("/",$_SERVER['REQUEST_URI']);
			$oReturn = array();
			foreach($oResults as $oKey => $oResult){
				$Result = explode("?",$oResult);
				$oReturn[$oKey] = $Result[0];
			}
			
			return $oReturn;
		}
		
		static function User($item){
			$Database = new Database(); 
			$UserData = $Database->Select("SELECT * FROM `".LOGIN."` WHERE ".LOGIN.".`id`='".$_SESSION['login']."'", single_object);
			return $UserData->$item;
		}
		
		static function Date($oDate, $oFormat = "d-m-Y", $oShort = false){
			
			if($oShort){
				$aMonths = array(1 => "jan", 2 => "feb", 3 => "mrt", 4 => "apr", 5 => "mei", 6 => "jun", 7 => "jul", 8 => "aug", 9 => "sep", 10 => "okt", 11 => "nov", 12 => "dec");
				$aDays	= array(1 => "ma", 2 => "di", 3 => "woe", 4 => "do", 5 => "vrij", 6 => "za", 7 => "zo");
			}
			else{
				$aMonths = array(1 => "januari", 2 => "februari", 3 => "maart", 4 => "april", 5 => "mei", 6 => "juni", 7 => "juli", 8 => "augustus", 9 => "september", 10 => "oktober", 11 => "november", 12 => "december");
				$aDays	= array(1 => "maandag", 2 => "dinsdag", 3 => "woensdag", 4 => "donderdag", 5 => "vrijdag", 6 => "zaterdag", 7 => "zondag");
			}
			
			$dayn	= $aDays[date('N', strtotime($oDate))];
			$day	= date('j', strtotime($oDate));
			$month	= $aMonths[date('n', strtotime($oDate))];
			$year	= date('Y', strtotime($oDate));
					
			switch($oFormat){
				case "N j n Y":	
					$oDate	= $dayn.' '.$day.' '.$month.' '.$year;
				break;
				case "j n Y":	
					$oDate	= $day.' '.$month.' '.$year;
				break;
				case "n Y":					
					$oDate	= $month.' '.$year;
				break;
				case "Y":					
					$oDate	= $year;
				break;
				default:					
					$oDate	= date($oFormat,strtotime($oDate));
				break;
			}
			
			return $oDate;
		}
		
		static function Time($item,$extra = false){
			if($item == "00:00:00")
				return false;
			else{
				if($extra)
					return date('H:i', strtotime($item.$extra));
				else
					return date('H:i', strtotime($item));
			}
		}
		
		static function DateTime($item,$extra = false){
			if($item == "0000-00-00 00:00:00" || $item == "1970-01-01 00:00:00")
				return false;
			else{
				if($extra)
					return date('d-m-Y H:i', strtotime($item.$extra));
				else
					return date('d-m-Y H:i', strtotime($item));
			}
		}
		
		static function makeInt($time){
			$oTime = explode(':',$time);
			$Time1 = (int) $oTime[0];
			$Time2 = (int) number_format($oTime[1]*100/60,0);
			return number_format($Time1.'.'.$Time2,2);
		}
		
		static function makeTime($int){
			$int = number_format($int,2);
			$oTime = explode('.',$int);
			$Time1 = ($oTime[0] < 10 ? '0'.$oTime[0] : $oTime[0]);
			$Time2 = (number_format($oTime[1]*60/100,0) < 10 ? '0'.number_format($oTime[1]*60/100,0) : number_format($oTime[1]*60/100,0));
			return $Time1.':'.$Time2;
		}
		
		static function MakeFolder($Folder, $Permission = 755, $User = 633, $Group = 635){			
			if(!file_exists($Folder)){
				mkdir($Folder, $Permission);
				chgrp($Folder, $Group);
				chown($Folder, $User);
				return true;
			}
			else
				return false;
		}
		
		static function RandomPassword(){
			$chars = "abcdefghijkmnopqrstuvwxyz023456789";
			srand((double)microtime()*1000000);
			$i = 0;
			$pass = '';
			while($i <= 7){
				$num = rand()%33;
				$tmp = substr($chars,$num,1);
				$pass = $pass.$tmp;
				$i++;
			}
			return $pass;
		}
		
		static function Title($item, $strtolower = true){
			
			$item = stripslashes($item);
			$string = str_replace(' ','-',$item);
			
			# ë ï ü ö ä
			$string = str_replace('&euml;','e',$string);	
			$string = str_replace('&Euml;','E',$string);
			$string = str_replace('&iuml;','i',$string);
			$string = str_replace('&Iuml;','I',$string);
			$string = str_replace('&uuml;','u',$string);	
			$string = str_replace('&Uuml;','U',$string);
			$string = str_replace('&ouml;','o',$string);
			$string = str_replace('&Ouml;','O',$string);
			$string = str_replace('&auml;','a',$string);
			$string = str_replace('&Auml;','A',$string);
			
			# é í ú ó á
			$string = str_replace('&eacute;','e',$string);	
			$string = str_replace('&Eacute;','E',$string);
			$string = str_replace('&iacute;','i',$string);
			$string = str_replace('&Iacute;','I',$string);
			$string = str_replace('&uacute;','u',$string);	
			$string = str_replace('&Uacute;','U',$string);
			$string = str_replace('&oacute;','o',$string);
			$string = str_replace('&Oacute;','O',$string);
			$string = str_replace('&aacute;','a',$string);
			$string = str_replace('&Aacute;','A',$string);
			
			# è ì ù ò à
			$string = str_replace('&egrave;','e',$string);	
			$string = str_replace('&Egrave;','E',$string);
			$string = str_replace('&igrave;','i',$string);
			$string = str_replace('&Igrave;','I',$string);
			$string = str_replace('&ugrave;','u',$string);	
			$string = str_replace('&Ugrave;','U',$string);
			$string = str_replace('&ograve;','o',$string);
			$string = str_replace('&Ograve;','O',$string);
			$string = str_replace('&agrave;','a',$string);
			$string = str_replace('&Agrave;','A',$string);
			
			# ê î û ô â
			$string = str_replace('&ecirc;','e',$string);	
			$string = str_replace('&Ecirc;','E',$string);
			$string = str_replace('&icirc;','i',$string);
			$string = str_replace('&Icirc;','I',$string);
			$string = str_replace('&ucirc;','u',$string);	
			$string = str_replace('&Ucirc;','U',$string);
			$string = str_replace('&ocirc;','o',$string);
			$string = str_replace('&Ocirc;','O',$string);
			$string = str_replace('&acirc;','a',$string);
			$string = str_replace('&Acirc;','A',$string);
			
			# õ ã
			$string = str_replace('&otilde;','o',$string);
			$string = str_replace('&Otilde;','O',$string);
			$string = str_replace('&atilde;','a',$string);
			$string = str_replace('&Atilde;','A',$string);			
			
			$string = str_replace('~','',$string);
			$string = str_replace('`','',$string);
			$string = str_replace('!','',$string);
			$string = str_replace('@','',$string);
			$string = str_replace('#','',$string);
			$string = str_replace('$','',$string);
			$string = str_replace('%','',$string);
			$string = str_replace('^','',$string);
			$string = str_replace('*','',$string);
			$string = str_replace('(','',$string);
			$string = str_replace(')','',$string);
			$string = str_replace('=','',$string);
			$string = str_replace('{','',$string);
			$string = str_replace('[','',$string);
			$string = str_replace(']','',$string);
			$string = str_replace('}','',$string);
			$string = str_replace(':','',$string);
			$string = str_replace('"','',$string);
			$string = str_replace('\'','',$string);
			$string = str_replace('|','',$string);
			$string = str_replace('?','',$string);
			$string = str_replace('/','-',$string);
			$string = str_replace('<','',$string);
			$string = str_replace('>','',$string);
			$string = str_replace(',','',$string);
			$string = str_replace('.','',$string);	
			
			$string = utf8_decode($string);
			$string = strtr($string, get_html_translation_table(HTML_ENTITIES));
			
			# ë ï ü ö ä
			$string = str_replace('&euml;','e',$string);	
			$string = str_replace('&Euml;','E',$string);
			$string = str_replace('&iuml;','i',$string);
			$string = str_replace('&Iuml;','I',$string);
			$string = str_replace('&uuml;','u',$string);	
			$string = str_replace('&Uuml;','U',$string);
			$string = str_replace('&ouml;','o',$string);
			$string = str_replace('&Ouml;','O',$string);
			$string = str_replace('&auml;','a',$string);
			$string = str_replace('&Auml;','A',$string);
			
			# é í ú ó á
			$string = str_replace('&eacute;','e',$string);	
			$string = str_replace('&Eacute;','E',$string);
			$string = str_replace('&iacute;','i',$string);
			$string = str_replace('&Iacute;','I',$string);
			$string = str_replace('&uacute;','u',$string);	
			$string = str_replace('&Uacute;','U',$string);
			$string = str_replace('&oacute;','o',$string);
			$string = str_replace('&Oacute;','O',$string);
			$string = str_replace('&aacute;','a',$string);
			$string = str_replace('&Aacute;','A',$string);
			
			# è ì ù ò à
			$string = str_replace('&egrave;','e',$string);	
			$string = str_replace('&Egrave;','E',$string);
			$string = str_replace('&igrave;','i',$string);
			$string = str_replace('&Igrave;','I',$string);
			$string = str_replace('&ugrave;','u',$string);	
			$string = str_replace('&Ugrave;','U',$string);
			$string = str_replace('&ograve;','o',$string);
			$string = str_replace('&Ograve;','O',$string);
			$string = str_replace('&agrave;','a',$string);
			$string = str_replace('&Agrave;','A',$string);
			
			# ê î û ô â
			$string = str_replace('&ecirc;','e',$string);	
			$string = str_replace('&Ecirc;','E',$string);
			$string = str_replace('&icirc;','i',$string);
			$string = str_replace('&Icirc;','I',$string);
			$string = str_replace('&ucirc;','u',$string);	
			$string = str_replace('&Ucirc;','U',$string);
			$string = str_replace('&ocirc;','o',$string);
			$string = str_replace('&Ocirc;','O',$string);
			$string = str_replace('&acirc;','a',$string);
			$string = str_replace('&Acirc;','A',$string);
			
			# õ ã
			$string = str_replace('&otilde;','o',$string);
			$string = str_replace('&Otilde;','O',$string);
			$string = str_replace('&atilde;','a',$string);
			$string = str_replace('&Atilde;','A',$string);
			
			$string = str_replace(';','',$string);
			$string = str_replace('&','',$string);
			
			$string = str_replace('---','-',$string);
			$string = str_replace('--','-',$string);
			
			return ($strtolower) ? strtolower($string) : $string;
		}
		
		static function AliasToString($item){
			$string = str_replace('-',' ',$item);
			
			return ucfirst($string);
		}
	
		public function getValid(){
			return $this->isValid;
		}
		
		public function setValid($isValid){
			$this->isValid = $isValid;
		}
		
	#	Get Make Array from database data
		static function MakeArray($item)
		{
			$items = explode('&&&&',$item);
			foreach($items as $data):
				$datas = explode('%%%%',$data);
				$array[$datas[0]] = $datas[1];
			endforeach;
			
			array_pop($array);
			
			return $array;				
		}
		
	#	Get Make Array from database data
		static function MakeArray1($item)
		{
			$items = explode('&&&&',$item);
			foreach($items as $data):
				$datas1 = explode('%%%%',$data);
				$datas2 = explode('@@@@',$datas1[1]);
				$datas3 = explode('$$$$',$datas2[0]);
				$array[$datas1[0]][check] = $datas3[1];
				$array[$datas1[0]][code] = $datas3[0];
				$array[$datas1[0]][price] = $datas2[1];
				
			endforeach;
			
			array_pop($array);
			
			return $array;				
		}
	
	#	Get Make Array from database data
		static function MakeArray2($item)
		{
			$items = explode('&&&&',$item);
			foreach($items as $data):
				$datas1 = explode('%%%%',$data);
				$datas2 = explode('@@@@',$datas1[1]);
				$datas3 = explode('$$$$',$datas2[0]);
				if($datas3[1] == 1):
					$array[$datas1[0]] = $datas3[0];
				endif;
			endforeach;
			
			return $array;				
		}
		
		public static function Word_wrap($Content, $WordCount) {
			
			$Words = explode(" ",strip_tags($Content));
			$Counter = count($Words);
			for($i = 0; $i < $WordCount; $i++){
				$Word[] = $Words[$i];
			}
			$Return = implode(" ",$Word);
			if($Counter > $WordCount) $Return.= "...";
			
			return $Return;			
		}
		
		static function ItsMe($ipaddress = "46.44.170.165"){
			
			if($_SERVER['REMOTE_ADDR'] == $ipaddress)
				return true;	
			else
				return false;
			
		}
		
		static function Debug($var, $exit = false, $Console = false, $ip = true, $ipaddress = array("46.44.170.165")){
			if($ip == true){
				if(in_array($_SERVER['REMOTE_ADDR'],$ipaddress)){
					if($Console == true)
						self::debug_to_console($var);
					else{
						echo "<pre style=\"padding:20px; border:1px solid #ccc; color:#666; background:#e1e1e1; margin-bottom:10px;\">";
						print_r($var);
						echo "</pre>";
						if($exit) exit();
					}
				}
			}
			else{
				echo "<pre style=\"padding:20px; border:1px solid #ccc; color:#666; background:#e1e1e1; margin-bottom:10px;\">";
				print_r($var);
				echo "</pre>";
				if($exit) exit();
			}
		}
		
		static function debug_to_console($data){
			if(is_array($data) || is_object($data))
				echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
			else
				echo("<script>console.log('PHP: ".$data."');</script>");
		}
		
		static function charTrans($oText){
			$oText = utf8_decode($oText);
			$oText = strtr($oText, get_html_translation_table(HTML_ENTITIES,ENT_QUOTES));
			return $oText;
		}
		
		static function charTransBack($oText){
			$oText = utf8_encode($oText);
			$oText = html_entity_decode($oText);
			return $oText;
		}
		
		static function String($String){
			$String = stripslashes($String);
			$String = addslashes($String);
			return $String;
		}
		
		static function __department__(){
			return array("1" => "Gesprekken", "2" => "Overige kosten", "5" => "Overige gesprekken", "3" => "Fax/E-mail berichten", "4" => "Agenda beheer", "6" => "Overige agenda");
		}
		
		static function createKey($Prefix, $Key){
			
			$oKey = str_replace($Prefix, false, $Key);
			$oKey = explode("_",$oKey);
		
			if($oKey){
				$nKey = "";
				foreach($oKey as $aKey){
					$nKey.= ucfirst(trim($aKey));
				}
				return $nKey;
			}
			
		}
		
	}
	
?>