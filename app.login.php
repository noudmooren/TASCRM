<?
#	LR DESIGN - CMS SYSTEM
#	Built: 10-Feb-2010   /  Created by: Robert van Klooster

#	System functions
	defined('LR_ACCESS') or die('Geen directe toegang mogelijk!');
	
	if($_POST["frmAction"]){
		if($_SESSION['portal_user']){
			switch($_POST["frmAction"]){
				case "active.filter":
					
					unset($_POST['frmAction']);
					$_SESSION["companies.active.filter"]["search"] = $_POST["search"];
					$_SESSION["companies.active.filter"]["page"] = 1;
					App::Redirect($_SERVER['REQUEST_URI']);
				
				break;
				case "send.mail.selection":
					
					if(!empty($_POST["select"]) && !empty($_POST["sendmail"])){
						
						$Calls = array();
						foreach($_POST["select"] as $CallId){
							$Calls[] = Calls::getCallObjectById($CallId);
						}
							
						$AllTo = @explode(",",$_POST["sendmail"]);
						$AllTo = @array_unique($AllTo);

						$User = App::portalUser();
						
						$Vars = new Vars();
						$Reseller = (object) $Vars->Reseller[$User->see];
									
						foreach($AllTo as $Mailaddress){
							
							if($Mailaddress){
							
								$Template = new Template();
								
								$Template->Assign("Calls", $Calls);
								$Template->Assign("Mailaddress", $Mailaddress);
								$Template->Assign("User", $User);
								
								if($User->see == 4){
									$Message = $Template->Content("portal/mail.call.short.bd.php");
								}
								else{								
									if($User->maillayout == "short")
										$Message = $Template->Content("portal/mail.call.short.php");	
									else
										$Message = $Template->Content("portal/mail.call.php");
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
								$oMail->Subject = "Calloverzicht ".date("d-m-Y H:i");
								$oMail->MsgHTML($Message);
								$oMail->AddAddress($Mailaddress, $Mailaddress);
								
								if($oSettings->BCC)
									$oMail->AddBCC($oSettings->BCCto, $oSettings->BCCto);
								
								$oMail->Send();
							}										
						}
						
						App::Message("De calls zijn succesvol verstuurd naar ".$_POST["sendmail"].".", succes);
						App::Redirect($_SERVER['REQUEST_URI']);
						
					}
					else{
						if(empty($_POST["sendmail"]))
							App::Message("Er is geen e-mailadres ingevuld.", warning);
						else
							App::Message("Er zijn geen calls geselecteerd.", warning);
						App::Redirect($_SERVER['REQUEST_URI']);
						
					}					
				
				break;
				case "company.edit":

					$Database = new Database();
					$Database->Update(CUSTOMERS, "id", $_SESSION['portal_user']);
					
					App::Message("De gegevens zijn succesvol aangepast.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);

				break;
				
				// Bijzonderheden
				case "speciality.add":
					
					$Database = new Database();
					
					$_POST["customerid"] = $_SESSION['portal_user'];
					$_POST["create_date"] = date("Y-m-d");
					
					$_POST["datefrom"] = date("Y-m-d", strtotime($_POST["datefrom"]));
					$_POST["dateto"] = date("Y-m-d", strtotime($_POST["dateto"]));
					
					$Database->Insert(SPECIALITIES, "id");
					
					App::Message("De bijzonderheid is toegevoegd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "speciality.edit":
					
					$Database = new Database();
										
					$_POST["datefrom"] = date("Y-m-d", strtotime($_POST["datefrom"]));
					$_POST["dateto"] = date("Y-m-d", strtotime($_POST["dateto"]));
					
					$Database->Update(SPECIALITIES, "id", $_POST["id"]);
					
					App::Message("De bijzonderheid is gewijzigd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "speciality.delete":
					
					$Database = new Database();
					$Database->Delete(SPECIALITIES, "id", $_POST["id"]);
					
					App::Message("De bijzonderheid is verwijderd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				
				// Storing
				case "storing.add":
					
					$Database = new Database();
					
					$_POST["customerid"] = $_SESSION['portal_user'];
					$_POST["create_date"] = date("Y-m-d");
					
					$_POST["datefrom"] = date("Y-m-d", strtotime($_POST["datefrom"]));
					$_POST["dateto"] = date("Y-m-d", strtotime($_POST["dateto"]));
					
					$Database->Insert(STORING, "id");
					
					App::Message("De storingsdienst is toegevoegd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "storing.edit":
					
					$Database = new Database();
										
					$_POST["datefrom"] = date("Y-m-d", strtotime($_POST["datefrom"]));
					$_POST["dateto"] = date("Y-m-d", strtotime($_POST["dateto"]));
					
					$Database->Update(STORING, "id", $_POST["id"]);
					
					App::Message("De storingsdienst is gewijzigd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "storing.delete":
					
					$Database = new Database();
					$Database->Delete(STORING, "id", $_POST["id"]);
					
					App::Message("De storingsdienst is verwijderd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				
				// Monteurs/medewerkers
				case "mechanic.add":
					
					$Database = new Database();
					
					$_POST["customerid"] = $_SESSION['portal_user'];
					$_POST["create_date"] = date("Y-m-d");
					
					$Database->Insert(MECHANICS, "id");
					
					App::Message("De monteur/medewerker is toegevoegd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "mechanic.edit":
					
					$Database = new Database();
					
					$Database->Update(MECHANICS, "id", $_POST["id"]);
					
					App::Message("De monteur/medewerker is gewijzigd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "mechanic.delete":
					
					$Database = new Database();
					$Database->Delete(MECHANICS, "id", $_POST["id"]);
					
					App::Message("De monteur/medewerker is verwijderd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				
				// Relaties
				case "relation.add":
					
					$Database = new Database();
					
					$_POST["customerid"] = $_SESSION['portal_user'];
					$_POST["create_date"] = date("Y-m-d");
					
					$Database->Insert(RELATIONS, "id");
					
					App::Message("De relatie is toegevoegd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "relation.edit":
					
					$Database = new Database();
					
					$Database->Update(RELATIONS, "id", $_POST["id"]);
					
					App::Message("De relatie is gewijzigd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				case "relation.delete":
					
					$Database = new Database();
					$Database->Delete(RELATIONS, "id", $_POST["id"]);
					
					App::Message("De relatie is verwijderd.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
				
				//Meldingsgroepen
				case "special.add":
					
					$Database = new Database();
					
					$_POST["customerid"] = $_SESSION['portal_user'];
					$_POST["createdate"] = date("Y-m-d H:i:s");
					$_POST["datefrom"] = date("Y-m-d", strtotime($_POST["datefrom"]));
					$_POST["datetill"] = date("Y-m-d", strtotime($_POST["datetill"]));
					
					$Database->Insert(SPECIAL_REQUESTS, "id");
					
					App::Message("Uw aanvraag is ingediend. U kunt over max. een half uur het overzicht hieronder downloaden.", succes);
					App::Redirect($_SERVER['REQUEST_URI']);
					
				break;
			}
		}
		else{
			switch($_POST["frmAction"]){
				case "portal.login":
					
					$Database = new Database();
					$isLogin = $Database->Select("
						SELECT
							".CUSTOMERS.".`id`
						FROM
							`".CUSTOMERS."`
						WHERE
							".CUSTOMERS.".`portal_active` 		= 'true' AND
							".CUSTOMERS.".`portal_username` 	= '".$_POST['username']."' AND
							".CUSTOMERS.".`portal_password` 	= '".$_POST['password']."' AND
							".CUSTOMERS.".`portal_username` 	!= '' AND
							".CUSTOMERS.".`portal_password` 	!= '' AND
							".CUSTOMERS.".`portal_permissions` 	!= 'null' AND
							".CUSTOMERS.".`portal_permissions` 	!= ''
						LIMIT 1", single_object
					);
					
					if($isLogin){
						$_SESSION['portal_user'] = $isLogin->id;
						App::Redirect($_SERVER['REQUEST_URI']);
						exit();
					}
					else{
						App::Message("Uw aanmeldgegevens zijn incorrect.", error);
						App::Redirect("/");
					}
					
				break;
			}
		}
		exit();
	}
	
	$wRequest = App::wRequest();
	$Template = new Template();
	$User = App::portalUser();
	$Template->Assign("User", $User);
	$Template->Assign("wRequest", $wRequest);
	
	if($_SESSION['portal_user']){
		switch($wRequest[1]){
			case "uitloggen":
				$_SESSION['portal_user'] = false;
				unset($_SESSION['portal_user']);
				App::Redirect("/");
			break;
			case "bedrijfsgegevens":
				$Template->Display("portal/company.php");
			break;
			case "protocol":
				$Template->Display("portal/protocol.php");
			break;
			case "relatieoverzicht":
				switch($wRequest[2]){
					case "toevoegen":
						$Template->Display("portal/relations.add.php");
					break;
					case true:
						
						$Relation = new Customers();
						$Relation = $Relation->getRelationsById($wRequest[2]);
						if($Relation->customerid != $_SESSION['portal_user'])
							die(ErrorReporing::Message("U heeft geen rechten tot deze functie!"));
						
						$Template->Assign("Relation", $Relation);
						
						switch($wRequest[3]){
							case "bewerken";
								$Template->Display("portal/relations.edit.php");
							break;
							case "verwijderen":
								$Template->Assign("action", "delete");
								$Template->Display("portal/relations.edit.php");
							break;
						}
					break;
					case false:
					
						if($_GET["sort"] && $_GET["dir"]){
							$_SESSION["companies.active.filter"]["sort"] = $_GET["sort"];
							$_SESSION["companies.active.filter"]["dir"] = $_GET["dir"];
							$_SESSION["companies.active.filter"]["page"] = 1;
							App::Redirect("/relatieoverzicht");
							exit();
						}
						
						if($_GET["page"]){
							$_SESSION["companies.active.filter"]["page"] = $_GET["page"];
							App::Redirect("/relatieoverzicht");
							exit();
						}
						
						$Template->Assign('Relations',Customers::listRelationsPortal($_SESSION['portal_user'], 250, ($_SESSION["companies.active.filter"]["page"] ? $_SESSION["companies.active.filter"]["page"] : 1), $_SESSION["companies.active.filter"]));
						
						$Count = Customers::countRelationsPortal($_SESSION['portal_user'],$_SESSION["companies.active.filter"]);
						$Template->Assign('Count',$Count);
						$Template->Assign('oPages', ceil($Count / ($_SESSION["companies.active.filter"]["search"]["limit"] ? $_SESSION["companies.active.filter"]["search"]["limit"] : 250)));
						$Template->Assign('thisPage', ($_SESSION["companies.active.filter"]["page"] ? $_SESSION["companies.active.filter"]["page"] : 1));
						$Template->Assign("Filter", $_SESSION["companies.active.filter"]);
						
						$Template->Display("portal/relations.php");
					break;
				}
				
			break;
			case "bijzonderheden":
				$Template->Assign("Mechanics", Customers::listMechanicsByCustomer($_SESSION['portal_user']));
				switch($wRequest[2]){
					case "toevoegen":
						$Template->Display("portal/specialities.add.php");
					break;
					case true:
						
						$Speciality = new Customers();
						$Speciality = $Speciality->getSpecialityById($wRequest[2]);
						if($Speciality->customerid != $_SESSION['portal_user'])
							die(ErrorReporing::Message("U heeft geen rechten tot deze functie!"));
						
						$Template->Assign("Speciality", $Speciality);
						
						switch($wRequest[3]){
							case "bewerken";
								$Template->Display("portal/specialities.edit.php");
							break;
							case "verwijderen":
								$Template->Assign("action", "delete");
								$Template->Display("portal/specialities.edit.php");
							break;
						}
					break;
					case false:					
						$Template->Assign("Specialities", Customers::listSpecialitiesByCustomer($_SESSION['portal_user']));
						$Template->Display("portal/specialities.php");
					break;
				}
			break;
			case "monteurs-medewerkers":
				switch($wRequest[2]){
					case "toevoegen":
						$Template->Display("portal/mechanics.add.php");
					break;
					case true:
						
						$Mechanic = new Customers();
						$Mechanic = $Mechanic->getMechanicsById($wRequest[2]);
						if($Mechanic->customerid != $_SESSION['portal_user'])
							die(ErrorReporing::Message("U heeft geen rechten tot deze functie!"));
						
						$Template->Assign("Mechanic", $Mechanic);
						
						switch($wRequest[3]){
							case "bewerken";
								$Template->Display("portal/mechanics.edit.php");
							break;
							case "verwijderen":
								$Template->Assign("action", "delete");
								$Template->Display("portal/mechanics.edit.php");
							break;
						}
					break;
					case false:					
						$Template->Assign("Mechanics", Customers::listMechanicsByCustomer($_SESSION['portal_user']));
						$Template->Display("portal/mechanics.php");
					break;
				}
				
			break;
			case "storingsdiensten":
				$Template->Assign("Mechanics", Customers::listMechanicsByCustomer($_SESSION['portal_user']));
				switch($wRequest[2]){
					case "toevoegen":
						$Template->Display("portal/storing.add.php");
					break;
					case true:
						
						$Storing = new Customers();
						$Storing = $Storing->getStoringById($wRequest[2]);						
						if($Storing->customerid != $_SESSION['portal_user'])
							die(ErrorReporing::Message("U heeft geen rechten tot deze functie!"));
						
						$Template->Assign("Storing", $Storing);
						
						switch($wRequest[3]){
							case "bewerken";
								$Template->Display("portal/storing.edit.php");
							break;
							case "verwijderen":
								$Template->Assign("action", "delete");
								$Template->Display("portal/storing.edit.php");
							break;
						}
					break;
					case false:					
						$Template->Assign("Storingen", Customers::listStoringenByCustomer($_SESSION['portal_user']));
						$Template->Display("portal/storing.php");
					break;
				}
			break;
			case "meldingsgroepen":
				$Template->Assign("Specials", Customers::listSpecialsByCustomer($_SESSION['portal_user']));
				$Template->Display("portal/specials.php");
			break;
			case "specialexports":
				
				if(file_exists($_SERVER['DOCUMENT_ROOT']."/specialexports/".$wRequest[2].".xlsx")){
				
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					header('Content-Disposition: attachment;filename="Meldingsgroep: '.$User->customername.'.xlsx"');
					header('Cache-Control: max-age=0');
					
					echo file_get_contents($_SERVER['DOCUMENT_ROOT']."/specialexports/".$wRequest[2].".xlsx");
					exit();
				}
				else echo "Onbekend bestand!";
				
				exit();
			break;
			case "calloverzicht":
				switch($wRequest[2]){
					case true:
					
						$oCall = Calls::getCallObjectById($wRequest[2]);
						
						if($oCall->customer_id != $_SESSION['portal_user'])
							die(ErrorReporing::Message("U heeft geen rechten tot deze functie!"));
						
						$Template->Assign("oCall", $oCall);
						
						if($User->see == 4)
							$Template->Display("mail.call.short.bd.php");
						else{								
							if($User->maillayout == "short")
								$Template->Display("mail.call.short.php");	
							else
								$Template->Display("mail.call.php");
						}
						exit();

					break;
					case false:
						$Template->Display("portal/calls.php");
					break;
				}
			break;
			case "statistieken":
				$Template->Display("portal/statistics.php");
			break;
			case false:
				$Template->Display("portal/home.php");
			break;
		}
	}
	else{
		$Template->Display("portal/login.view.php");
	}
	
?>