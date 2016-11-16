<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	Configuration file
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	// Databases
	define(ABBREVIATIONS,	"system_abbreviations");
	define(ABBREVIATIONS_BD,"system_abbreviations_bd");
	define(DEPARTMENTS,		"system_department");
	define(DEPARTMENTS_BD,	"system_department_bd");
	define(SPECIAL,			"system_special");
	define(SPECIAL_REQUESTS,"system_special_requests");
	define(SPECIALITIES,	"system_specialities");
	define(STORING,			"system_storing");
	define(MECHANICS,		"system_mechanics");
	define(LOGIN,			"system_login");
	define(MAIL,			"system_mail");
	define(CALLS,			"system_calls");
	define(ACTIONS,			"system_actions");
	define(CUSTOMERS,		"system_customers");
	define(RELATIONS,		"system_relations");
	define(SETTINGS,		"system_settings");
	define(EXTRA_RELATIONS,	"system_extrarelations");
	define(LOGS,			"log_log");
	
	// Folders & Files
	define(SYSTEM,			"/system/");
	define(IMAGES,			"/templates/images/");
	define(HEADER,			$_SERVER['DOCUMENT_ROOT']."/templates/header.inc.php");
	define(FOOTER,			$_SERVER['DOCUMENT_ROOT']."/templates/footer.inc.php");
	
	define(PORTAL_HEADER,	$_SERVER['DOCUMENT_ROOT']."/templates/portal/header.inc.php");
	define(PORTAL_FOOTER,	$_SERVER['DOCUMENT_ROOT']."/templates/portal/footer.inc.php");
	
	// Vars
	class Vars{
		
		var $Resellers = array(
			1 => "TAS Venray",
			2 => "TAS Westland",
			//3 => "SK Solutions",
			4 => "BD Admin",
			5 => "TAS Nijmegen",
			6 => "HFR Secretarieel Management",
			7 => "TAS Breda",
			8 => "TAS Tilburg",
			9 => "TAS Maastricht",
			10 => "TAS den Bosch",
			11 => "TEST TRS"
		);
		
		var $Reseller = array(
			
			1 => array(
				"Name" 		=> "TAS Venray",
				"SmsName" 	=> "TAS Venray",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@tasvenray.nl",
					"Name" 		=> "TAS Venray",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> true,
					"BCCto"		=> "info@tasvenray.nl"
				)
			),
			2 => array(
				"Name" 		=> "TAS Westland",
				"SmsName" 	=> "TASWestland",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@taswestland.nl",
					"Name" 		=> "TAS Westland",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			/*3 => array(
				"Name" 		=> "SK Solutions",
				"SmsName" 	=> "SK Solutions",
				
				"Mailer" => array(
					"SMTP" 		=> false,
					"Host" 		=> "",
					"Port" 		=> 25,
					"From" 		=> "info@sk-solutions.nl",
					"Name" 		=> "SK Solutions",
					"Subject" 	=> "Overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),*/
			4 => array(
				"Name" 		=> "BD Admin",
				"SmsName" 	=> "BD Admin",
				
				"Mailer" => array(
					"SMTP" 		=> false,
					"Host" 		=> "",
					"Port" 		=> 25,
					"From" 		=> "afwezig@bd-admin.nl",
					"Name" 		=> "BD Admin",
					"Subject" 	=> "Telefoonnotitie {contactpersoon}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			5 => array(
				"Name" 		=> "TAS Nijmegen",
				"SmsName" 	=> "TASNijmegen",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@tasnijmegen.nl",
					"Name" 		=> "TAS Nijmegen",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			6 => array(
				"Name" 		=> "HFR Secretarieel Management",
				"SmsName" 	=> "HFR",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@hfr-secretarieel.nl",
					"Name" 		=> "HFR Secretarieel Management",
					"Subject" 	=> "Overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			7 => array(
				"Name" 		=> "TAS Breda",
				"SmsName" 	=> "TAS Breda",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@tasvenray.nl",
					"Name" 		=> "TAS Breda",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			8 => array(
				"Name" 		=> "TAS Tilburg",
				"SmsName" 	=> "TAS Tilburg",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@tasvenray.nl",
					"Name" 		=> "TAS Tilburg",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			9 => array(
				"Name" 		=> "TAS Maastricht",
				"SmsName" 	=> "TAS Maastricht",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@tasvenray.nl",
					"Name" 		=> "TAS Maastricht",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			10 => array(
				"Name" 		=> "TAS den Bosch",
				"SmsName" 	=> "TAS den Bosch",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@tasvenray.nl",
					"Name" 		=> "TAS den Bosch",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			11 => array(
				"Name" 		=> "TEST TRS",
				"SmsName" 	=> "TEST TRS",
				
				"Mailer" => array(
					"SMTP" 		=> true,
					"Host" 		=> "mail.qwezz.nl",
					"Port" 		=> 25,
					"From" 		=> "info@tasvenray.nl",
					"Name" 		=> "TEST TRS",
					"Subject" 	=> "T.A.S. overzicht van {datum} {tijd}",
					"BCC" 		=> false,
					"BCCto"		=> ""
				)
			),
			
		);
		
		public function Get($Var){
			if($this->{$Var})
				return $this->{$Var};
			else
				return false;
		}
		
		public function Set($Var, $Value){
			$this->{$Var} = $Value;
		}
	}
	
	class lang
	{
		static function defaults($item)
		{
			switch($item)
			{
				case 'yes':						return 'Ja'; break;
				case 'no':						return 'Nee'; break;
				case 'time': 					return 'Uitstellen'; break;
				case 'startdate':				return 'Start datum/tijd'; break;
				case 'enddate':					return 'Eind datum/tijd'; break;
				case 'default':					return 'Standaard:'; break;
				case 'selectall':				return 'Selecteer alles'; break;
				case 'selectnone':				return 'Deselecteer alles'; break;
				case 'previewtitle':			return 'Voorbeeld pagina'; break;
				case 'previewcontent':			return 'Druk op toepassen om deze template te selecteren.'; break;
				case 'days': 					return array('zondag','maandag','dinsdag','woensdag','donderdag','vrijdag','zaterdag'); break;
				case 'daysaf': 					return array('zo','ma','di','wo','do','vr','za'); break;
				case 'months':					return array('januari','februari','maart','april','mei','juni','juli','augustus',
															 'september','oktober','november','december'); break;
				case 'monthsaf':				return array('jan','feb','mrt','apr','mei','jun','jul','aug','sep','okt','nov','dec'); break;
			}
		}
		
		static function template($item)
		{
			switch($item)
			{
				case 'logout': 					return 'Uitloggen'; break;
				case 'welcome': 				return 'Welkom'; break;
				case 'logininfo':				return 'Welkom, login om verder te gaan'; break;
				case 'productinfo':				return 'Product of <a href="http://www.lrdesign.info" target="_blank">LR Design</a>'; break;
			}
		}
	
		static function menu($item)
		{
			switch($item)
			{
				case 'systemhome': 				return 'Welkom in het telefoon registratie systeem'; break;
				case 'register-new-call': 		return 'Registreer nieuwe Call'; break;
				case 'register-edit-call': 		return 'Calls wijzigen'; break;
				case 'register-send-call': 		return 'Calls versturen'; break;
				case 'register-archive-call': 	return 'Zoeken in archief'; break;
				case 'invoice-overview': 		return 'Factuurspecificaties'; break;
				case 'invoice-overview-bd':		return 'Factuurspecificaties (BD-Admin)'; break;
				case 'service-customer-info':	return 'Onderhoud debiteuren info'; break;
				case 'service-departments':		return 'Onderhoud diensten'; break;
				case 'service-departments-bd':	return 'Onderhoud oproep types'; break;
				case 'service-abbreviations':	return 'Onderhoud afkortingen'; break;
				case 'service-abbreviations-bd':return 'Onderhoud afkortingen (BD-Admin)'; break;
				case 'users-mail': 				return 'Inbox'; break;
				case 'users-log': 				return 'Logboek'; break;
				case 'users-control': 			return 'Systeem gebruikers beheren'; break;
				case 'systemstats':				return 'Statistieken'; break;
				case 'systemhelp': 				return 'Help'; break;
				case 'systemusers':		 		return 'Systeem gebruikers'; break;
				case 'systempermissions': 		return 'Systeem groepen'; break;
				case 'invoice-settings': 		return 'Facturatie instellingen'; break;	
				case 'invoice-viewer-v': 		return 'Factuur overzicht (Venray)'; break;	
				case 'invoice-viewer-w': 		return 'Factuur overzicht (Westland)'; break;
				case 'invoice-viewer-h': 		return 'Factuur overzicht (HFR)'; break;	
				case 'overview-special': 		return 'Meldinggroepen'; break;	
			}
		}
	
		static function itemmenu($item)
		{
			switch($item)
			{	
				case 'new':						return 'Nieuw'; break;
				case 'edit':					return 'Bewerken'; break;
				case 'answer': 					return 'Beantwoorden'; break;
				case 'more':	 				return 'Meer'; break;
				case 'copy':	 				return 'Kopi&euml;ren'; break;
				case 'delete': 					return 'Verwijderen'; break;
				case 'help':	 				return 'Help'; break;
				case 'preview':					return 'Voorbeeld'; break;
				case 'apply':					return 'Toepassen'; break;
				case 'save':	 				return 'Opslaan'; break;
				case 'nextitem': 				return 'Doorgaan'; break;
				case 'cancel': 					return 'Annuleren'; break;
				case 'back':	 				return 'Terug'; break;
				case 'print': 					return 'Afdrukken'; break;
				case 'newfile': 				return 'Toevoegen'; break;
				case 'newfolder':	 			return 'Nieuwe map'; break;
				case 'move': 					return 'Verplaatsen'; break;
			}
		}
	
		static function systemlogin($item)
		{
			switch($item)
			{
				case 'intro': 					return 'Voer uw gebruikersnaam en wachtwoord in:'; break;
				case 'username': 				return 'Gebruikersnaam:'; break;
				case 'password': 				return 'Wachtwoord:'; break;
				case 'saveuser':				return 'Login gegevens bewaren op deze computer?'; break;
				case 'autologin': 				return 'Kies uw gebruikersnaam om automatisch in te loggen:'; break;
				case 'delete': 					return 'Verwijderen'; break;
				case 'changeaccount':			return 'Met een andere account inloggen'; break;
			}
		}
		
		#	CMS homepage
		static function cms_cmshomepage($item)
		{
			switch($item)
			{

			}
		}
		
	#	CMS support
		static function cms_support($item)
		{
			switch($item)
			{	
				case 'new':						return 'Nieuw support ticket aanvragen'; break;
				case 'edit':					return 'Bewerk support ticket'; break;
				case 'answer':					return 'Beantwoord support ticket'; break;
				case 'delete':					return 'Verwijder support ticket'; break;
				
				case 'subject': 				return 'Onderwerp'; break;
				case 'sendby':	 				return 'Door'; break;
				case 'replyby':					return 'Antwoord'; break;
				case 'closed':					return 'Gesloten'; break;
				case 'date':					return 'Datum'; break;
				case 'id': 						return 'ID'; break;
				
				case 'empty': 					return 'Er zijn nog geen technische vragen...'; break;
				
				case 'username':				return 'Gebruiker'; break;
				case 'subject': 				return 'Onderwerp'; break;
				case 'message':					return 'Vraag/opmerking'; break;
				case 'date':					return 'Datum'; break;
				
				case 'deletemessage':			return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
			}
		}
	
	#	CMS userinfo
		static function cms_userinfo($item)
		{
			switch($item)
			{	
				case 'title':					return 'Gebruikers informatie'; break;
				case 'edit':					return 'Bewerk gebruikersinformatie'; break;
				
				case 'name':					return 'Naam'; break;
				case 'username':				return 'Gebruikersnaam'; break;
				case 'mail':					return 'E-mailadres'; break;
				case 'active':					return 'Actief'; break;
				case 'group':					return 'Gebruikersgroep'; break;
				case 'create_date':				return 'Datum'; break;
				
				case 'username':				return 'Gebruikersnaam'; break;
				case 'password':				return 'Wachtwoord'; break;
				case 'name':					return 'Naam'; break;
				case 'mail':					return 'E-mailadres'; break;
				case 'create_date':				return 'Datum'; break;
			}
		}

	#	CMS license
		static function cms_license($item)
		{
			switch($item)
			{	
				case 'productinfo':				return 'Manage-IT - Product of LR Design Websolutions Meerlo'; break;
				case 'createdate':				return 'Built: 25-maart-2010'; break;
				case 'version':					return 'Version: 5.10 Dutch'; break;
				
				case 'username':				return 'Gebruikersnaam'; break;
				case 'mail':					return 'E-mailadres'; break;
				case 'active':					return 'Actief'; break;
				case 'group':					return 'Gebruikersgroep'; break;
				case 'create_date':				return 'Datum'; break;
			}
		}
	
	#	CMS systemconfiguration
		static function systemconfig($item)
		{
			switch($item)
			{				
				case 'websitestat':				return 'Website Status:'; break;
				case 'offline':					return 'Website offline:'; break;
				case 'offlinemessage':			return 'Offline bericht:'; break;
				
				case 'websiteconfig':			return 'Website configuratie:'; break;
				case 'title':					return 'Website titel:'; break;
				case 'language':				return 'Standaard taal:'; break;
				case 'cmslanguage':				return 'Manage-IT taal:'; break;
				case 'template':				return 'Standaard template:'; break;
				case 'url':						return 'Website url:'; break;
				
				case 'dbconfig':				return 'Database gegevens:'; break;
				case 'dbprefix':				return 'Database Prefix:'; break;
				case 'dbname':					return 'Database naam:'; break;
				case 'dbusername':				return 'Database gebruikersnaam:'; break;
				case 'dbpassword':				return 'Database wachtwoord:'; break;
				case 'dbhost':					return 'Database host:'; break;
				
				case 'googleconfig':			return 'Google Analytics data:'; break;
				case 'googleusername':			return 'Gebruikersnaam:'; break;
				case 'googlepassword':			return 'Wachtwoord:'; break;
				case 'googleid':				return 'Profiel ID:'; break;
				
				case 'mailconfig':				return 'Standaard afzender e-mailadres:'; break;
				case 'mailaddress':				return 'E-mailadres:'; break;
				case 'fromname':				return 'Afzendernaam:'; break;
				
				case 'ftpconfig':				return 'FTP gegevens:'; break;
				case 'ftpuse':					return 'Gebruik FTP:'; break;
				case 'ftphost':					return 'Host:'; break;
				case 'ftpport':					return 'Poort:'; break;
				case 'ftpusername':				return 'Gebruikersnaam:'; break;
				case 'ftppassword':				return 'Wachtwoord:'; break;
				case 'ftproot':					return 'Root:'; break;
			}
		}
		
	#	CMS stats
		static function cms_stats($item)
		{
			switch($item)
			{				
				case 'visitersmonth':			return 'Bezoekers per maand:'; break;
				case 'month':					return 'Maand'; break;
				case 'visiters':				return 'Bezoekers'; break;
				case 'totalvisiters':			return 'Totaal aantal bezoeken:'; break;
				case 'totaluniquevisiters':		return 'Unieke bezoekers:'; break;
				
				case 'browsersummary':			return 'Overzicht browser gebruik in de maand'; break;
				case 'browsers':				return 'Browser'; break;
				case 'visiters':				return 'Bezoekers'; break;
				
				case 'countrysummary':			return 'Overzicht percentage bezoekers per land in de maand'; break;
				case 'countrys':				return 'Land'; break;
				case 'visiters':				return 'Bezoekers'; break;
				
				case 'populairsummary':			return 'Overzicht populaire pagina\'s in de maand'; break;
				case 'page':					return 'Pagina'; break;
				case 'visiters':				return 'Bezoekers'; break;
				
				case 'keywordsummary':			return 'Overzicht meest gebruikte zoekwoorden in de maand'; break;
				case 'keyword':					return 'Zoekwoord'; break;
				case 'visiters':				return 'Bezoekers'; break;
				
				case 'linksummary':				return 'Overzicht sites die linken naar `'.$_SERVER['HTTP_HOST'].'`:'; break;
				case 'webpage':					return 'Sites'; break;
				case 'visiters':				return 'Bezoekers'; break;
				
				case 'visiterssummary':			return 'Bezoekers in de maand'; break;
				case 'day':						return 'Dag'; break;
				case 'visiters':				return 'Bezoekers'; break;
				case 'uniquevisiters':			return 'Unieke bezoekers'; break;
				
				case 'totalvisiterssummary':	return 'Totaal aantal bezoeken in'; break;
				case 'totaluniquesummary':		return 'Unieke bezoekers in'; break;
			}
		}
		
	#	CMS help
		static function cms_help($item)
		{
			//empty
		}
		
	#	CMS usercontroll
		static function cms_usercontroll($item)
		{
			switch($item)
			{	
				case 'new':						return 'Nieuwe gebruiker toevoegen'; break;
				case 'edit':					return 'Bewerk gebruiker'; break;
				case 'delete':					return 'Verwijder gebruiker'; break;
				
				case 'name':					return 'Naam'; break;
				case 'group':					return 'Gebruikersgroep'; break;
				case 'active':					return 'Active'; break;
				case 'date':					return 'Datum'; break;
				case 'id':						return 'ID'; break;
				
				case 'empty':					return 'Er zijn nog geen gebruikers...'; break;
				
				case 'name':					return 'Naam'; break;
				case 'username':				return 'Gebruikersnaam'; break;
				case 'password':				return 'Wachtwoord'; break;
				case 'group':					return 'Gebruikersgroep'; break;
				case 'mail':					return 'E-mailadres'; break;
				case 'active':					return 'Active'; break;
				case 'date':					return 'Datum'; break;				
				
				case 'deletemessage':			return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
			}
		}
		
	#	CMS userpersmissions
		static function cms_userpermissions($item)
		{
			switch($item)
			{	
				case 'new':						return 'Nieuwe gebruikersgroep toevoegen'; break;
				case 'edit':					return 'Bewerk gebruikersgroep'; break;
				case 'delete':					return 'Verwijder gebruikersgroep'; break;
			
				case 'name':					return 'Gebruikersgroep'; break;
				case 'active':					return 'Active'; break;
				case 'date':					return 'Datum'; break;
				case 'id':						return 'ID'; break;
				
				case 'empty':					return 'Er zijn nog geen gebruikersgroepen...'; break;
				
				case 'name':					return 'Gebruikersgroep'; break;
				case 'permissions':				return 'Rechten'; break;
				case 'active':					return 'Active'; break;
				case 'date':					return 'Datum'; break;				
				
				case 'deletemessage':			return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;			
				
				case 'usergroups': 				return 'Gebruikersgroepen'; break;
				case 'usergroup': 				return 'Gebruikersgroep'; break;
				case 'date': 					return 'Datum'; break;
				case 'selectedgroup': 			return 'Gekozen gebruikersgroep:'; break;
			}
		}

	#	CMS modules
		static function cms_modules($item)
		{
			switch($item)
			{	
				case 'permissions':				return 'Rechten'; break;
				case 'modules':					return 'Modules'; break;
				case 'selectedmodule':			return 'Gekozen modules:'; break;
				
				case 'pagetype':				return 'Pagina type'; break;
				case 'selectedtype':			return 'Gekozen type:'; break;
				case 'select':					return 'Selecteer een pagina type...'; break;
			}
		}
	
	#	CMS webpages
		static function cms_webpages($item)
		{
			switch($item)
			{	
				case 'new':						return 'Nieuwe webpagina toevoegen'; break;
				case 'edit':					return 'Bewerk webpagina'; break;
				case 'delete':					return 'Verwijder webpagina'; break;
				
				case 'name':					return 'Pagina naam'; break;
				case 'homepage':				return 'Homepage'; break;
				case 'active':					return 'Publiceerd'; break;
				case 'date':					return 'Datum'; break;
				case 'id': 						return 'ID'; break;
				
				case 'empty': 					return 'Er zijn nog geen webpagina\'s...'; break;
				
				case 'subject':					return 'Onderwerp'; break;
				case 'title':					return 'Pagina titel'; break;
				case 'keywords':		 		return 'Zoekwoorden'; break;
				case 'description':				return 'Pagina omschrijving'; break;
				case 'template':				return 'Template'; break;
				case 'type':					return 'Pagina type'; break;
				case 'active':					return 'Publiceerd'; break;
				case 'homepage':				return 'Homepage'; break;
				case 'date':					return 'Datum'; break;
				
				case 'deletemessage':			return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
				
				case 'webpages':				return 'Webpagina\'s'; break;
				case 'selectedpage':			return 'Gekozen webpagina:'; break;
			}
		}
		
	#	CMS template
		static function cms_template($item)
		{
			switch($item)
			{	
				case 'templates':				return 'Templates'; break;
				case 'template':				return 'Template naam'; break;
				case 'selectedtemplate': 		return 'Gekozen webpagina:'; break;
			}
		}
		
	#	CMS menus
		static function cms_menus($item)
		{
			switch($item)
			{	
				case 'new':						return 'Nieuw menu toevoegen'; break;
				case 'edit':					return 'Bewerk menu'; break;
				case 'delete':					return 'Verwijder menu'; break;
				
				case 'name':		 			return 'Naam'; break;
				case 'position':				return 'Template positie'; break;
				case 'active':					return 'Publiceerd'; break;
				case 'date':					return 'Datum'; break;
				case 'id': 						return 'ID'; break;
				
				case 'empty': 					return 'Er zijn geen menu\'s...'; break;
				
				case 'name':		 			return 'Naam'; break;
				case 'position':				return 'Template positie'; break;
				case 'active':					return 'Publiceerd'; break;
				case 'date':					return 'Datum'; break;
				
				case 'deletemessage':			return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
				
				case 'subnew':					return 'Nieuw menu item toevoegen'; break;
				case 'subedit':					return 'Bewerk menu item'; break;
				case 'subdelete':				return 'Verwijder menu item'; break;
				
				case 'itemname':		 		return 'Item naam'; break;
				case 'itemposition':			return 'Positie'; break;
				case 'itemactive':				return 'Publiceerd'; break;
				case 'itemdate':				return 'Datum'; break;
				case 'itemid': 					return 'ID'; break;

				case 'emptyitems': 				return 'Er zijn geen menu items...'; break;
				
				case 'itemname':		 		return 'Item naam'; break;
				case 'type':					return 'Type'; break;
				case 'subpage':					return 'Positie'; break;
				case 'active':					return 'Publiceerd'; break;
				case 'date':					return 'Datum'; break;
				
				case 'option1':					return 'URL naar webpagina'; break;
				case 'option2':					return 'Hyperlink naar website'; break;
				case 'option3':					return 'URL naar bestand uit \'Mijn bestanden\''; break;
				
				case 'webpage':					return 'Webpagina'; break;
				case 'target':					return 'Pagina doel'; break;
				
				case 'hyperlink':				return 'Hyperlink'; break;
				case 'target':					return 'Pagina doel'; break;
				
				case 'file':					return 'Bestand'; break;
				case 'target':					return 'Pagina doel'; break;
				
				case 'firstitem':				return 'Hoofd menu-item'; break;				
			}
		}
		
	#	CMS pagetype
		static function cms_target($item)
		{
			switch($item)
			{	
				case 'target':					return 'Pagina doel'; break;
				case 'targettype':				return 'Opties'; break;
				case 'selectedtarget': 			return 'Gekozen pagina doel:'; break;
				case 'select': 					return 'Selecteer een pagina doel...'; break;
			}
		}
		
	#	CMS filemanager
		static function cms_filemanager($item)
		{
			switch($item)
			{	
				case 'upload':				return 'Nieuwe bestanden toevoegen'; break;
				case 'folder':				return 'Nieuwe map toevoegen'; break;
				case 'move':				return 'Bestanden verplaatsen'; break;
				case 'delete':				return 'Verwijder bestanden/mappen'; break;

				case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
				case 'movemessage':			return 'Druk op doorgaan om onderstaande items te verplaatsen:'; break;
				case 'foldername':			return 'Map naam'; break;
				case 'date':				return 'Aanmaak datum'; break;
				case 'webpage':				return 'Webpagina'; break;
				case 'empty': 				return 'Er zijn nog geen content pagina\'s...'; break;

				case 'filemanager':			return 'Mijn bestanden'; break;
				case 'selectedfile':		return 'Gekozen bestand:'; break;
			}
		}
	
	
		static function cms_content($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuwe content toevoegen'; break;
					case 'edit':				return 'Bewerk content'; break;
					case 'delete':				return 'Verwijder content'; break;
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'help':				return 'Help'; break;
					case message:				return 'Content'; break;
					case subject:				return 'Onderwerp'; break;
					case name:		 			return 'Content'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case 'webpage':				return 'Webpagina'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen content pagina\'s...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					
					case 'choicetemplate': 		return 'Gekozen content'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}
		
		static function cms_contact($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuwe contactgegevens toevoegen'; break;
					case 'edit':				return 'Bewerk contactgegevens'; break;
					case 'delete':				return 'Verwijder contactgegevens'; break;
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'help':				return 'Help'; break;
					case message:				return 'Naam'; break;
					case subject:				return 'Onderwerp'; break;
					case name:		 			return 'Naam'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case 'webpage':				return 'Webpagina'; break;
					
					case 'naam':				return 'Naam'; break;
					case 'adres':				return 'Adres'; break;
					case 'woonplaats':		 	return 'Woonplaats'; break;
					case 'mailadres':			return 'E-mailadres'; break;
					case 'telefoon':			return 'Telefoonnummer'; break;
					case 'website':				return 'Website'; break;
					case 'postcode':			return 'Postcode'; break;
					case 'contactpersoon':		return 'Contactpersoon'; break;
					case 'mobiel':		 		return 'Mobiel'; break;
					case 'fax':					return 'Fax'; break;
					case 'kvknr':				return 'KVK nummer'; break;
					case 'btwnr':				return 'BTW nummer'; break;
					
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen contactgegevens...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					
					case 'choicetemplate': 		return 'Gekozen content'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}

		

		
		
		

		static function cms_bib($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuwe bibliotheek toevoegen'; break;
					case 'edit':				return 'Bewerk bibliotheek'; break;
					case 'delete':				return 'Verwijder bibliotheek'; break;
					
					case 'subnew':				return 'Nieuw bibliotheek item toevoegen'; break;
					case 'subedit':				return 'Bewerk bibliotheek item'; break;
					case 'subdelete':			return 'Verwijder bibliotheek item'; break;
					
					case 'targettype':			return 'Pagin doel'; break;
					case 'choicetype':			return 'Gekozen pagina doel'; break;
					
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'help':				return 'Help'; break;
					case position:				return 'Positie'; break;
					case row:					return 'Rij'; break;
					case items:					return 'Items'; break;
					case 'link':				return '`Verder` link'; break;
					case 'files':				return 'Afbeelding'; break;
					case subpage:				return 'Bibliotheek positie'; break;
					case type:					return 'Bibliotheek-type'; break;
					case name:		 			return 'Bibliotheek naam'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen bibliotheken...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					case 'time': 				return 'Uitstellen'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}
		
		static function cms_galery($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuwe galerij toevoegen'; break;
					case 'edit':				return 'Bewerk galerij'; break;
					case 'delete':				return 'Verwijder galerij'; break;
					
					case 'subnew':				return 'Nieuw galerij item toevoegen'; break;
					case 'subedit':				return 'Bewerk galerij item'; break;
					case 'subdelete':			return 'Verwijder galerij item'; break;
					
					case 'itemsnew':			return 'Nieuwe afbeelding toevoegen'; break;
					case 'itemsedit':			return 'Bewerk afbeelding'; break;
					case 'itemsdelete':			return 'Verwijder afbeelding'; break;
					
					case 'targettype':			return 'Pagin doel'; break;
					case 'choicetype':			return 'Gekozen pagina doel'; break;
					
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'help':				return 'Help'; break;
					case position:				return 'Positie'; break;
					case row:					return 'Rij'; break;
					case items:					return 'Items'; break;
					case 'link':				return '`Verder` link'; break;
					case 'content':				return 'Tekst'; break;
					case 'location':			return 'Locatie'; break;
					case 'files':				return 'Afbeelding'; break;
					case subpage:				return 'Galerij positie'; break;
					case type:					return 'Galerij-type'; break;
					case name:		 			return 'Galerij naam'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen galerij...'; break;
					
					case 'imagename':			return 'Naam'; break;
					case 'thumb':				return 'Kleine afbeelding'; break;
					case 'image':				return 'Grootte afbeelding'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					case 'time': 				return 'Uitstellen'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}
		
		static function cms_newspage($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuwe nieuwspagina toevoegen'; break;
					case 'edit':				return 'Bewerk nieuwspagina'; break;
					case 'delete':				return 'Verwijder nieuwspagina'; break;
					
					case 'subnew':				return 'Nieuw nieuws item toevoegen'; break;
					case 'subedit':				return 'Bewerk nieuws item'; break;
					case 'subdelete':			return 'Verwijder nieuws item'; break;
					
					case 'targettype':			return 'Pagin doel'; break;
					case 'choicetype':			return 'Gekozen pagina doel'; break;
					
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'help':				return 'Help'; break;
					case webpage:				return 'Webpagina'; break;
					case items:					return 'Items per pagina'; break;
					case subpage:				return 'Menu positie'; break;
					case position:				return 'Postitie'; break;
					case name:		 			return 'Nieuwspagina'; break;
					case nameitem:		 		return 'Nieuwsitem'; break;
					case authordate:		 	return 'Datum'; break;
					case author:		 		return 'Auteur'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen nieuwspagina\'s...'; break;
					case 'emptyitems': 			return 'Er zijn nog geen nieuwsitem\'s...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					case 'time': 				return 'Uitstellen'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}

		function cms_events($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuwe agenda toevoegen'; break;
					case 'edit':				return 'Bewerk agenda'; break;
					case 'delete':				return 'Verwijder agenda'; break;
					
					case 'subnew':				return 'Nieuw agenda item toevoegen'; break;
					case 'subedit':				return 'Bewerk agenda item'; break;
					case 'subdelete':			return 'Verwijder agenda item'; break;
					
					case 'targettype':			return 'Pagin doel'; break;
					case 'choicetype':			return 'Gekozen pagina doel'; break;
					
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'help':				return 'Help'; break;
					case webpage:				return 'Webpagina'; break;
					case items:					return 'Items per pagina'; break;
					case position:				return 'Postitie'; break;
					case name:		 			return 'Agenda'; break;
					case nameitem:		 		return 'Agenda item'; break;
					case authordate:		 	return 'Datum'; break;
					case price:		 			return 'Entree prijs'; break;
					case location:		 		return 'Locatie'; break;
					case authortime:		 	return 'Tijd'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen agenda\'s...'; break;
					case 'emptyitems': 			return 'Er zijn nog geen agenda item\'s...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					case 'time': 				return 'Uitstellen'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}
		
		function cms_formulier($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuw formulier toevoegen'; break;
					case 'edit':				return 'Bewerk formulier'; break;
					case 'delete':				return 'Verwijder formulier'; break;
					
					case 'subnew':				return 'Nieuw formulier item toevoegen'; break;
					case 'subedit':				return 'Bewerk formulier item'; break;
					case 'subdelete':			return 'Verwijder formulier item'; break;
					
					case 'targettype':			return 'Pagin doel'; break;
					case 'choicetype':			return 'Gekozen pagina doel'; break;
					
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'help':				return 'Help'; break;
					case webpage:				return 'Webpagina'; break;
					case items:					return 'Items per pagina'; break;
					case position:				return 'Postitie'; break;
					case name:		 			return 'Formulier'; break;
					case nameitem:		 		return 'Formulier item'; break;
					case authordate:		 	return 'Datum'; break;
					case price:		 			return 'Entree prijs'; break;
					case location:		 		return 'Locatie'; break;
					case authortime:		 	return 'Tijd'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen formulieren...'; break;
					case 'emptyitems': 			return 'Er zijn nog geen formulier item\'s...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					case 'time': 				return 'Uitstellen'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}

		function cms_pictureshow($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuwe pictureshow toevoegen'; break;
					case 'edit':				return 'Bewerk pictureshow'; break;
					case 'delete':				return 'Verwijder pictureshow'; break;
					case 'more':				return 'Meer afbeelding tegelijk toevoegen'; break;
					
					case 'subnew':				return 'Nieuwe afbeelding toevoegen'; break;
					case 'subedit':				return 'Bewerk afbeelding'; break;
					case 'subdelete':			return 'Verwijder afbeelding'; break;
					
					case 'targettype':			return 'Pagin doel'; break;
					case 'choicetype':			return 'Gekozen pagina doel'; break;
					
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'addmessage':			return 'Druk op doorgaan om onderstaande items toe te voegen:'; break;
					case 'help':				return 'Help'; break;
					case webpage:				return 'Webpagina'; break;
					case items:					return 'Totaal aantal items'; break;
					
					case position:				return 'Postitie'; break;
					case name:		 			return 'Naam'; break;
					case nameitem:		 		return 'Agenda item'; break;
					case authordate:		 	return 'Datum'; break;
					case price:		 			return 'Entree prijs'; break;
					case files:			 		return 'Bestand'; break;
					case alt:			 		return 'Alternative tekst'; break;
					case authortime:		 	return 'Tijd'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen pictureshow\'s...'; break;
					case 'emptyitems': 			return 'Er zijn nog geen afbeeldingen...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					case 'time': 				return 'Uitstellen'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}
		
		function cms_photobook($item)
		{
			#	CMS template
				switch($item)
				{	
					case 'new':					return 'Nieuw album toevoegen'; break;
					case 'edit':				return 'Bewerk album'; break;
					case 'delete':				return 'Verwijder album'; break;
					case 'more':				return 'Meer afbeelding tegelijk toevoegen'; break;
					
					case 'subnew':				return 'Nieuwe afbeelding toevoegen'; break;
					case 'subedit':				return 'Bewerk afbeelding'; break;
					case 'subdelete':			return 'Verwijder afbeelding'; break;
					
					case 'targettype':			return 'Pagin doel'; break;
					case 'choicetype':			return 'Gekozen pagina doel'; break;
					
					case 'deletemessage':		return 'Druk op doorgaan om onderstaande items te verwijderen:'; break;
					case 'addmessage':			return 'Druk op doorgaan om onderstaande items toe te voegen:'; break;
					case 'help':				return 'Help'; break;
					case webpage:				return 'Webpagina'; break;
					case items:					return 'Totaal aantal items'; break;
					
					case position:				return 'Postitie'; break;
					case description:			return 'Omschrijving'; break;
					case name:		 			return 'Naam'; break;
					case nameitem:		 		return 'Agenda item'; break;
					case authordate:		 	return 'Datum'; break;
					case price:		 			return 'Entree prijs'; break;
					case files:			 		return 'Bestand'; break;
					case alt:			 		return 'Alternative tekst'; break;
					case authortime:		 	return 'Tijd'; break;
					case active:				return 'Publiceerd'; break;
					case 'date':				return 'Aanmaak datum'; break;
					case id: 					return 'ID'; break;
					case 'empty': 				return 'Er zijn nog geen album\'s...'; break;
					case 'emptyitems': 			return 'Er zijn nog geen afbeeldingen...'; break;
					
					case yes: 					return 'Ja'; break;
					case no:	 				return 'Nee'; break;
					case 'time': 				return 'Uitstellen'; break;
					
					case selectall:				return 'Selecteer alles'; break;
					case selectnone:			return 'Deselecteer alles'; break;
				}
		}
		
	}

	$lang = new lang();
